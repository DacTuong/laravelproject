<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use Illuminate\Support\Facades\Session;
use App\Models\Brand;
use App\Models\Category;
use App\Models\Coupons;
use App\Models\BannerModel;
use App\Models\Product;
use Illuminate\Support\Facades\Redirect;
use App\Models\CateActicleModel;

session_start();
class CartController extends Controller
{

    public function index()
    {
        // $shipping_fee = 25000;
        $brand = Brand::get();
        $category = Category::get();
        $banners = BannerModel::all();


        return view('user.shopping.cart')->with('brands', $brand)
            ->with('categorys', $category)
            ->with('banners', $banners)


        ;
    }

    public function addToCart(Request $request)
    {
        $productData = $request->all();
        $product_name = $productData['cart_product_name'];
        $product_price = $productData['cart_product_price'];
        $id_product = $productData['cart_product_id'];
        $product_image = $productData['cart_product_image'];
        $product_color = $productData['cart_product_color'];

        $session_id = substr(md5(microtime()), rand(0, 26), 5);
        $cart = Session::get('cart');

        $soluong = 1;
        $is_vaiable = false;

        if (!empty($cart)) {
            foreach ($cart as $key => $val) {
                if ($val['masp'] == $id_product) {
                    $is_vaiable = true;
                    $new_qty = $cart[$key]['soluong'] += $soluong;
                    $cart[$key]['soluong'] = $new_qty;
                    $cart[$key]['total'] = $cart[$key]['soluong'] * $cart[$key]['gia'];
                    break;
                }
            }
        }

        if (!$is_vaiable) {
            $cart[] = array(
                'session_id' => $session_id,
                'masp' => $id_product,
                'image' => $product_image,
                'soluong' => $soluong,
                'tensp' => $product_name,
                'gia' => $product_price,
                'color' => $product_color,
                'total' => $soluong * $product_price,
            );
        }

        // Tính toán total_price
        $total_price = 0;
        foreach ($cart as $item) {
            $total_price += $item['total'];
        }
        Session::put('cart', $cart);
        Session::put('total_price', $total_price);
        Session::save();
    }


    public function count_cart()
    {
        $cartQuantity = Session::get('cart');

        // Hoặc bạn có thể sử dụng model để lấy dữ liệu
        $quantity = 0;
        foreach ($cartQuantity as $item) {
            $quantity += $item['soluong'];
        }

        $output = '';
        $output = $quantity;
        echo $output;
    }

    // public function increaseProduct($product_id)
    // {
    //     $cart = Session::get('cart');

    //     $soluong = 1;
    //     if ($cart == true) {
    //         foreach ($cart as $key => $val) {
    //             if ($val['masp'] == $product_id) {
    //                 $cart[$key]['soluong'] += $soluong;

    //                 $cart[$key]['total'] = $cart[$key]['soluong'] * $cart[$key]['gia'];
    //                 break;
    //             }
    //         }
    //     }
    //     Session::put('cart', $cart);

    //     $total_price = 0;
    //     foreach ($cart as $item) {
    //         $total_price += $item['total'];
    //     }
    //     Session::put('total_price', $total_price);
    //     Session::save();
    //     return Redirect::to('cart');
    // }

    // public function decreaseProduct($product_id)
    // {
    //     $cart = Session::get('cart');
    //     $soluong = 1;
    //     if ($cart == true) {
    //         foreach ($cart as $key => $val) {
    //             if ($val['masp'] == $product_id) {
    //                 $new_qty = $cart[$key]['soluong'] -= $soluong;
    //                 if ($new_qty < 1) {
    //                     $new_qty = 1;
    //                     return redirect()->back()->with('message', 'You can add min than 1 of this product to the cart');
    //                 }
    //                 $cart[$key]['soluong'] = $new_qty;

    //                 $cart[$key]['total'] = $cart[$key]['soluong'] * $cart[$key]['gia'];
    //                 break;
    //             }
    //         }
    //     }
    //     Session::put('cart', $cart);
    //     $total_price = 0;
    //     foreach ($cart as $item) {
    //         $total_price += $item['total'];
    //     }
    //     Session::put('total_price', $total_price);

    //     Session::save();

    //     return Redirect::to('cart');
    // }

    public function delete($session_id)
    {
        $cart = Session::get('cart');

        if ($cart == true) {
            foreach ($cart as $key => $value) {

                if ($value['session_id'] == $session_id) {
                    unset($cart[$key]);
                }
            }
            Session::put('cart', $cart);
            $total_price = 0;
            foreach ($cart as $item) {
                $total_price += $item['total'];
            }
            Session::put('total_price', $total_price);
        }
        return redirect()->back()->with('message', 'You can remove than 1 of this product to the cart');
    }

    public function delete_all_cart()
    {
        $cart = Session::get('cart');
        if ($cart == true) {
            Session::forget('cart');
            Session::forget('coupon');
            Session::forget('total_price');
        }
        return Redirect::to('cart');
    }

    public function check_coupon(Request $request)
    {
        $data = $request->all();
        $id_user = Session::get('id_customer');

        $coupon = Coupons::where('coupon_code', $data['code_coupon'])->where('coupon_status', 1)->first();

        if ($coupon) {
            $cou[] = array(
                'coupon_id' => $coupon->id_coupon,
                'coupon_code' => $coupon->coupon_code,
                'coupon_type' => $coupon->coupon_type,
                'discount' => $coupon->discount_amount,
            );
            Session::put('coupon', $cou);



            Session::save();

            $extist_id = explode(',', $coupon->customer_id);
            if (in_array($id_user, $extist_id)) {
                echo 'Bạn đã sử dụng mã giảm giá này rồi';
            } else {
                if ($coupon->customer_id) {
                    $coupon->customer_id .= ',' . $id_user;
                } else {
                    $coupon->customer_id = $id_user;
                }
                $coupon->coupon_qty = $coupon->coupon_qty - 1;
                // Session::forget('final_total');
                $coupon->save();
                echo 'Dùng mã giảm giá thành công';
            }
        }
        return Redirect::to('cart');
    }

    public function delete_coupon()
    {
        // Lấy thông tin mã giảm giá từ session
        $coupon_session = Session::get('coupon');
        $id_customer = Session::get('id_customer');

        if ($coupon_session && $id_customer) {
            foreach ($coupon_session as $coupon) {
                // Truy vấn mã giảm giá từ cơ sở dữ liệu theo coupon_code
                $coupon_data = Coupons::where('coupon_code', $coupon['coupon_code'])->first();

                if ($coupon_data) {
                    // Lấy danh sách ID khách hàng hiện tại
                    $exist_ids = explode(',', $coupon_data->customer_id);

                    // Xóa id_customer khỏi danh sách
                    $updated_ids = array_diff($exist_ids, [$id_customer]);
                    $coupon_data->customer_id = implode(',', $updated_ids);
                    $coupon_data->coupon_qty = $coupon_data->coupon_qty + 1;
                    // Lưu lại thay đổi vào cơ sở dữ liệu
                    $coupon_data->save();
                }
            }
            // Xóa toàn bộ session coupon
            Session::forget('coupon');
        }

        // Chuyển hướng lại giỏ hàng
        return Redirect::to('cart');
    }

    public function update_quantity_cart(Request $request)
    {
        $quantity = $request->input('quantity');
        $masp = $request->input('masp');

        // Xử lý dữ liệu (ví dụ: cập nhật vào cơ sở dữ liệu)
        // Bạn có thể thêm logic lưu dữ liệu vào bảng sản phẩm của mình
        $product = Product::find($masp);
        $find_quantity = $product->product_quantity;
        if ($quantity > $find_quantity) {
            return response()->json([
                'status' => 'error',
                'message' => 'Bạn đã vượt quá số lượng sản phẩm đang có của chúng tôi.',
            ]);
            // return redirect()->back()->with('message', 'Bạn đã mua quá số lượng mà chúng tôi có');
        }

        $cart = Session::get('cart');
        if ($cart == true) {
            foreach ($cart as $key => $val) {
                if ($val['masp'] == $masp) {
                    $new_qty = $cart[$key]['soluong'] = $quantity;
                    if ($new_qty < 1) {
                        $new_qty = 1;
                        // return redirect()->back()->with('message', 'You can add min than 1 of this product to the cart');
                        return response()->json([
                            'status' => 'error',
                            'message' => 'Bạn không thể nhập số nhỏ hơn 0.',
                        ]);
                    }
                    $cart[$key]['soluong'] = $new_qty;

                    $cart[$key]['total'] = $cart[$key]['soluong'] * $cart[$key]['gia'];
                    break;
                }
            }
        }
        Session::put('cart', $cart);
        $total_price = 0;
        foreach ($cart as $item) {
            $total_price += $item['total'];
        }
        Session::put('total_price', $total_price);

        Session::save();

        return response()->json([
            'status' => 'success',
            'message' => 'Dữ liệu đã được cập nhật',

        ]);
    }
}