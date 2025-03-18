<?php

namespace App\Http\Controllers;

use App\Models\ActicleModel;
use App\Models\BannerModel;
use App\Models\ReviewModel;
use Illuminate\Http\Request;

use Illuminate\Support\Facades\Session;

use App\Models\Brand;
use App\Models\CateActicleModel;
use App\Models\Category;
use App\Models\FavoriteModel;
use App\Models\OrderProduct;
use App\Models\User;
use App\Models\Product;



session_start();

use Illuminate\Support\Facades\Redirect;

class HomeController extends Controller
{
    public function index(Request $request)
    {
        $brand = Brand::get();
        $category = Category::get();
        $list_product =  Product::with(['category', 'brand'])
            ->where('product_status', 1);


        $banners = BannerModel::all();


        // Lọc theo giá
        if ($request->has('sort_by')) {
            if ($request->get('sort_by') == 'giam_dan') {
                $list_product->orderBy('sale_price', 'desc');
            } elseif ($request->get('sort_by') == 'tang_dan') {
                $list_product->orderBy('sale_price', 'asc');
            }
        }

        // Lọc theo RAM
        if ($request->has('filter_mobile_ram')) {
            // Chuyển giá trị thành mảng
            $ramFilters = explode(',', $request->get('filter_mobile_ram'));

            // Áp dụng các điều kiện lọc
            $list_product->where(function ($query) use ($ramFilters) {
                foreach ($ramFilters as $ramFilter) {
                    switch ($ramFilter) {
                        case '<4':
                            $query->orWhere('ram', '<', 4);
                            break;
                        case '4gb_8gb':
                            $query->orWhereBetween('ram', [4, 8]);
                            break;
                        case '8gb_12gb':
                            $query->orWhereBetween('ram', [8, 12]);
                            break;
                        case '>12gb':
                            $query->orWhere('ram', '>', 12);
                            break;
                    }
                }
            });
        }

        if ($request->has('filter_price')) {
            // Chuyển giá trị thành mảng
            $filterPrices = explode(',', $request->get('filter_price'));

            // Áp dụng các điều kiện lọc
            $list_product->where(function ($query) use ($filterPrices) {
                foreach ($filterPrices as $filterPrice) {
                    switch ($filterPrice) {
                        case '1000000-5000000':
                            $query->orWhereBetween('sale_price', [1000000, 5000000]);
                            break;
                        case '5000000-10000000':
                            $query->orWhereBetween('sale_price', [5000000, 10000000]);
                            break;
                        case '10000000-15000000':
                            $query->orWhereBetween('sale_price', [10000000, 15000000]);
                            break;
                        case '15000000-20000000':
                            $query->orWhereBetween('sale_price', [15000000, 20000000]);
                            break;
                        case '20000000-25000000':
                            $query->orWhereBetween('sale_price', [20000000, 25000000]);
                            break;
                        case '25000000-30000000':
                            $query->orWhereBetween('sale_price', [25000000, 30000000]);
                            break;
                        case '>30000000':
                            $query->orWhere('sale_price', '>', 30000000);
                            break;
                    }
                }
            });
        }


        // Lọc theo loại điện thoại
        if ($request->has('filter_mobile')) {
            $filterMobiles = explode(',', $request->get('filter_mobile'));
            $list_product->whereIn('categories_product_id', $filterMobiles);
        }

        if ($request->has('filter_refresh_rates')) {
            $filterRefresh = $request->get('filter_refresh_rates');
            if ($filterRefresh === '60-120hz') {
                $list_product->whereBetween('refresh_rate', [60, 120]);
            } else {
                $filterValues = explode(',', $filterRefresh);
                $list_product->whereIn('refresh_rate', $filterValues);
            }
        }


        // Lấy danh sách sản phẩm sau khi lọc
        $products = $list_product->get();

        return view('user.home')
            ->with('products', $products)
            ->with('banners', $banners)
            ->with('brands', $brand)
            ->with('categorys', $category)

        ;
    }

    public function detail_product($product_id)
    {
        $brand = Brand::get();
        $category = Category::get();
        $banners = BannerModel::all();
        $detail_product = Product::with(['category', 'brand',])->where('tbl_phones.product_id', $product_id)
            ->first();



        $product_price = $detail_product->sale_price;

        $model_product = $detail_product->model_product;
        $varian = $detail_product->varian_product;

        $colors = Product::where('varian_product', $varian)
            ->where('model_product', $model_product)
            ->get();



        $storage = request()->query('storage');
        if ($storage) {
            $storage_product = Product::with(['category', 'brand',])->where('model_product', $model_product)
                ->where('varian_product', $storage)->first();

            $colors_product = Product::with(['category', 'brand',])->where('model_product', $model_product)
                ->where('varian_product', $storage)->get();
            if ($storage_product) {
                $detail_product = $storage_product;
            };

            if ($colors_product) {
                $colors = $colors_product;
            };
        }



        $similar_product = Product::whereBetween('sale_price', [$product_price - 100, $product_price + 100, $product_price])
            ->where('product_id', '!=', $product_id)
            ->get();

        $list_varian = Product::where('model_product', $model_product)
            ->select('varian_product')
            ->groupBy('varian_product')
            ->orderByRaw('CAST(varian_product AS UNSIGNED) ASC') // Sắp xếp từ thấp đến cao
            ->get();

        $sku = request()->query('sku');
        if ($sku) {
            $sku_product = Product::with(['category', 'brand',])->where('tbl_phones.product_id', $sku)->first();
            if ($sku_product) {
                $detail_product = $sku_product;
            }
        }
        return view('user.product.detail_product')
            ->with('product_detail', $detail_product)
            ->with('brands', $brand)
            ->with('categorys', $category)
            ->with('similars', $similar_product)
            ->with('varians', $list_varian)
            ->with('colors', $colors)
            ->with('banners', $banners)
            ->with('sku', $sku)
        ;
    }

    public function search(Request $request)
    {
        $brand = Brand::get();
        $category = Category::get();
        $banners = BannerModel::all();
        $keyword = $request->keywords_search;

        $search_product = Product::with(['category', 'brand'])
            ->where('product_name', 'like', '%' . $keyword . '%')
            ->where('product_status', 1)
            ->get();

        return view('user.product.search')
            ->with('search_product', $search_product)
            ->with('brands', $brand)
            ->with('categorys', $category)
            ->with('banners', $banners)

        ;
    }
    public function review_product($product_id)
    {
        $brand = Brand::get();
        $category = Category::get();
        $banners = BannerModel::all();

        $get_product = Product::with(['category', 'brand'])
            ->where('tbl_phones.product_id', $product_id)->first();

        return view('user.product.review_product')
            ->with('product_infor', $get_product)
            ->with('brands', $brand)
            ->with('categorys', $category)
            ->with('banners', $banners)
        ;
    }

    public function favorite_toggle(Request $request)
    {
        $product_favorite = $request->all();
        $id_user = Session::get('id_customer');
        $product_favorite_id = $product_favorite['product_id'];
        // Kiểm tra người dùng đã đăng nhập hay chưa
        if (!$id_user) {
            return response()->json(['status' => 'error', 'message' => 'Vui lòng đăng nhập hoặc đăng ký để thêm vào yêu thích']);
        }
        $favorite = FavoriteModel::where("favorite_phone_id", $product_favorite_id)
            ->where("favorite_user_id", $id_user)->first();
        if ($favorite) {
            $favorite->delete();
        } else {
            $new_favorite = new FavoriteModel();
            $new_favorite->favorite_phone_id = $product_favorite_id;
            $new_favorite->favorite_user_id = $id_user;
            $new_favorite->save();
        }
    }

    public function check_favorite($product_id)
    {
        // $product_favorite = $request->all();
        $id_user = Session::get('id_customer');


        $isFavorite = FavoriteModel::where("favorite_phone_id", $product_id)
            ->where("favorite_user_id", $id_user)->exists();
        $output = '';
        if ($isFavorite) {
            $output .= '<i class="fa-solid fa-heart"></i>';
        } else {
            $output .= '<i class="fa-regular fa-heart"></i>';
        }
        echo $output;
    }
    public function get_review_cmt_min($product_id)
    {
        $review_cmt = ReviewModel::with(['name_customer'])
            ->where('id_phone_review', $product_id)
            ->orderBy('id_review', 'desc')
            ->limit(5)->get();
        return response()->json($review_cmt);
    }
    public function get_review_cmt_all($product_id)
    {
        $review_cmt = ReviewModel::with(['name_customer'])
            ->where('id_phone_review', $product_id)
            ->orderBy('id_review', 'desc')
            ->get();
        return response()->json($review_cmt);
    }



    public function average_start($product_id)
    {
        $review_product = ReviewModel::where('id_phone_review', $product_id)->get();
        $average_point_product = $review_product->avg('rating');
        $count_review = $review_product->count() . ' đánh giá';


        return response()->json([
            'average' => round($average_point_product, 1),
            'total_reviews' => $count_review,
        ]);
    }

    public function send_review(Request $request)
    {
        $dataReview = $request->all();
        $id_user = Session::get('id_customer');

        $text = $dataReview['review'];

        $product_review_id = $dataReview['id_product'];
        $rating = $dataReview['rating'];
        if (!$id_user) {
            return response()->json(['status' => 'error', 'message' => 'Vui lòng đăng nhập hoặc đăng ký để thêm vào yêu thích']);
        }

        // Bỏ ghi chú và xử lý thêm đánh giá
        $review = ReviewModel::where("id_phone_review", $product_review_id)
            ->where("id_user_review", $id_user)->first();

        if ($review) {
            return response()->json(['status' => 'error', 'message' => 'Bạn đã đánh giá sản phẩm này trước đó!']);
        } else {
            $add_review = new ReviewModel();
            $add_review->id_phone_review = $product_review_id;
            $add_review->id_user_review = $id_user;
            $add_review->review_text = $text;
            $add_review->rating = $rating;
            $add_review->save();

            return response()->json(['status' => 'success', 'message' => 'Đánh giá của bạn đã được gửi!']);
        }
    }


    public function count_with_star($product_id)
    {
        $reviews = ReviewModel::where('id_phone_review', $product_id)->get();
        $reviews_total = $reviews->count();

        // Lấy dữ liệu thực tế từ cơ sở dữ liệu
        $ratings_count = ReviewModel::where('id_phone_review', $product_id)
            ->groupBy('rating')
            ->selectRaw('rating, COUNT(*) as count')
            ->orderBy('rating', 'desc')
            ->get()
            ->keyBy('rating'); // Sử dụng keyBy để dễ dàng kiểm tra các mức đánh giá

        // Đảm bảo tất cả các mức đánh giá từ 1 đến 5 đều có
        $ratings_array = [];
        for ($i = 1; $i <= 5; $i++) {
            if (isset($ratings_count[$i])) {
                // Nếu mức đánh giá tồn tại, sử dụng giá trị từ database
                $count = $ratings_count[$i]->count;
            } else {
                // Nếu không tồn tại, gán count = 0
                $count = 0;
            }

            // Tính phần trăm
            $percentage = $reviews_total > 0 ? round(($count / $reviews_total) * 100, 2) : 0;

            $ratings_array[] = [
                'rating' => $i,
                'count' => $count,
                'percentage' => $percentage,
            ];
        }

        return response()->json([
            'total_reviews' => $reviews_total,
            'ratings_count' => $ratings_array
        ]);
    }

    public function filter_reviews_min(Request $request)
    {
        $dataFilterReview = $request->all();
        $id_filter = $dataFilterReview['id_product'];
        $star_filter = $dataFilterReview['filter_start'];

        if ($star_filter == 0) {
            $review_cmt = ReviewModel::with(['name_customer'])
                ->where('id_phone_review', $id_filter)
                ->orderBy('id_review', 'desc')
                ->limit(5)->get();
            return response()->json($review_cmt);
        } else {
            $review_cmt = ReviewModel::with(['name_customer'])
                ->where('id_phone_review', $id_filter)->where('rating', $star_filter)
                ->orderBy('id_review', 'desc')
                ->limit(5)->get();
            return response()->json($review_cmt);
        }
    }


    public function filter_reviews(Request $request)
    {
        $dataFilterReview = $request->all();
        $id_filter = $dataFilterReview['id_product'];
        $star_filter = $dataFilterReview['filter_start'];

        if ($star_filter == 0) {
            $review_cmt = ReviewModel::with(['name_customer'])
                ->where('id_phone_review', $id_filter)
                ->orderBy('id_review', 'desc')
                ->limit(5)->get();
            return response()->json($review_cmt);
        } else {
            $review_cmt = ReviewModel::with(['name_customer'])
                ->where('id_phone_review', $id_filter)->where('rating', $star_filter)
                ->orderBy('id_review', 'desc')
                ->get();
            return response()->json($review_cmt);
        }
    }
    public function delete_favorite(Request $request)
    {
        $product_favorite = $request->all();
        $id_user = Session::get('id_customer');
        $product_favorite_id = $product_favorite['product_id'];

        // Bỏ ghi chú và xử lý thêm đánh giá
        $favorite = FavoriteModel::where("favorite_phone_id", $product_favorite_id)
            ->where("favorite_user_id", $id_user)->first();
        $favorite->delete();
    }



    public function thong_tin_ca_nhan()
    {
        $brand = Brand::get();
        $category = Category::get();
        $avg_amount = 0;


        $id_user_session = Session::get('id_customer');
        $output = "Hiện chưa có địa chỉ";
        $information_customer = User::where('id_user', $id_user_session)->first();

        $history_order = OrderProduct::where('id_customer', $id_user_session)
            ->with(['shippingAddress', 'orderDetail'])->paginate(10);
        $order_count = $history_order->count();
        $total_amount = OrderProduct::where('id_customer', $id_user_session)->sum('order_total');


        if ($total_amount > 0) {
            $avg_amount = $total_amount / $order_count;
        }
        return view('user.profile.personal_infor')->with('brands', $brand)
            ->with('categorys', $category)
            ->with('inforcustomer', $information_customer)
            ->with('historys', $history_order)
            ->with('ordercount', $order_count)
            ->with('totalamount', $total_amount)
            ->with('avgamount', $avg_amount)

        ;
    }


    public function wishlist()
    {
        $brand = Brand::get();
        $category = Category::get();
        $banners = BannerModel::all();

        $id_user_session = Session::get('id_customer');
        $favorite = FavoriteModel::with(['user_favorite', 'product_favorite'])->where("favorite_user_id", $id_user_session)->get();
        return view('user.product.wishlist')
            ->with('brands', $brand)
            ->with("categorys", $category)
            ->with('favorites', $favorite)
            ->with('banners', $banners)

        ;
    }

    public function data_wishlist()
    {
        $id_user_session = Session::get('id_customer');
        $products = FavoriteModel::with(['user_favorite', 'product_favorite'])
            ->where("favorite_user_id", $id_user_session)->get();
        $output = '';
        foreach ($products as $product) {

            $productFavorite = $product->product_favorite; // Simplify access to related product

            $oldPrice = $productFavorite->old_price ?? 0;
            $salePrice = $productFavorite->sale_price;
            $brandName = $productFavorite->brand_name;
            $imagePath = asset('uploads/product/' . $productFavorite->product_image);
            $detailLink = url('/detail-product' . '/' .  $productFavorite->id);

            $percentDiscount = $oldPrice > 0 ? ceil((($oldPrice - $salePrice) / $oldPrice) * 100) : 0;
            $oldPriceText = '';
            if ($oldPrice > 0) {
                $oldPriceText .= '<span class="productinfo__price-old">' . number_format($oldPrice, 0, ',', '.') . 'đ</span>';
            }
            $pecent = '';
            if ($oldPrice > 0) {
                $pecent .= '<div class="product__price--percent">
                            <p class="product__price--percent-detail">' . $percentDiscount . '%</p>
                        </div>';
            }

            $output .= '
    <div class="col-lg-3 col-md-3 col-sm-12 col-12" style="padding-bottom: 12px;">
        <div class="product-content">
            <div class="thumbnail-product-img">
                <img class="home-product-img" src="' . $imagePath . '" alt="" />
            </div>

            <h5 class="productinfo__name">
                <a class="link-product" href="' . $detailLink . '">' . $productFavorite->product_name . '
                </a>
            </h5>
            <div class="productinfo__price">
                <span class="productinfo__price-current">
                    ' . number_format($salePrice, 0, ',', '.') . '
                </span>
                ' . $oldPriceText . '
            </div>
            <span> ' . $brandName . ' </span>
            <div class="action-buttons">
                <form>
                    <input type="hidden" name="_token" value="' . csrf_token() . '">
                    <input type="hidden" value="' . $product->favorite_phone_id . '"
                        class="product_id_' . $product->favorite_phone_id . '">
                    <input type="hidden" value="' . $productFavorite->product_name . '"
                        class="product_name_' . $product->favorite_phone_id . '">
                    <input type="hidden" value="' . $productFavorite->product_image . '"
                        class="product_image_' . $product->favorite_phone_id . '">
                    <input type="hidden" value="' . $salePrice . '"
                        class="product_price_' . $product->favorite_phone_id . '">
                    <input type="hidden" value="' . $productFavorite->color . '"
                        class="product_color_' . $product->favorite_phone_id . '">
                    <input type="hidden" value="1" class="cart_product_qty_' . $product->favorite_phone_id . '">
                    <button type="button" class="add-to-cart" data-id_product="' . $product->favorite_phone_id . '"
                        name="add-to-cart"><i class="fa-solid fa-cart-shopping"></i></button>
                    <button type="button" class="delete-favorite" data-id_product="' . $product->favorite_phone_id . '"
                        name="delete-favorite">X</button>
                </form>
            </div>
        </div>
    </div>';
        }
        if ($products->count() > 0) {
            echo $output;
        } else {
            echo '<span>Hiện không có sản phẩm yêu thích nào</span>';
        }
    }

    public function setting()
    {

        $brand = Brand::get();
        $category = Category::get();
        $id_user_session = Session::get('id_customer');


        $informations = User::where('id_user', $id_user_session)->first();
        return view('user.profile.setting')->with('brands', $brand)
            ->with('categorys', $category)
            ->with('informations', $informations)

        ;
    }

    public function change_password(Request $request)
    {
        $dataChangpass = $request->all();
        $old_pass = $dataChangpass['old_pass'];
        $new_pass = $dataChangpass['new_pass'];
        $id_user_session = Session::get('id_customer');
        $dataUser = User::where('id_user', $id_user_session)
            ->first();
        if ($dataUser->password_user = $old_pass) {
            $dataUser->password_user = $new_pass;
            $dataUser->save();
            return response()->json(['success' => true, 'message' => 'Đổi mật khẩu thành công!']);
        } else {
            return response()->json(['success' => false, 'message' => 'Mật khẩu cũ không chính xác!']);
        }
    }
}