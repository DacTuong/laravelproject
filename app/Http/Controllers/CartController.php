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
            ->with('category', $category)
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
        $cart = Session::get('cart', []);

        // Biến đếm số lượng sản phẩm
        $cart_quantity = count($cart);

        // Hiển thị số lượng sản phẩm trong giỏ hàng
        echo $cart_quantity;
    }


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

    public function cart_message()
    {
        $cart = Session::get('cart', []);
        $total_price = Session::get('total_price', []);

        $cart_quantity = count($cart);
        $message_cart = '   <div class="cart-message">
                                        <img src="https://web.nvnstatic.net/tp/T0199/img/empty_cart.png?v=7" alt="">
                                        <p>Không có sản phẩm trong giỏ hàng của bạn</p>
                                    </div>';


        if ($cart_quantity > 0) {
            $message_cart = '
                          <div class="cart-view">
                                        <div class="title_cart_hea">
                                            Giỏ hàng
                                        </div>
                                        <div class="cart-body">';
            foreach ($cart as  $value) {

                $value_name = $value['tensp'];
                $value_color = $value['color'];
                $value_price = number_format($value['gia'], 0, ',', '.') . '₫';
                $imagePath = asset('uploads/product/' . $value['image']);
                $pathLink = url('/detail-product' . '/' .  $value['masp']);
                $message_cart .= '
                                            <div class="info hover-cart-item">
                                                <div class="row" style="margin: 0;">
                                                    <div class="col-md-3 imageProduct col-3">
                                                        <img src="' . $imagePath . '"
                                                            alt="">
                                                    </div>
                                                    <div class="col-md-8 cartInfo col-8">
                                                        <div class="cart_item_detail">
                                                            <a class="cart_item_name" href="' . $pathLink . '">' .  $value_name . '</a>
                                                            <br>
                                                            <span>
                                                                ' . $value_color . '
                                                            </span>
                                                        </div>
                                                        <div class="cart_item_price">
                                                            <span class="cart_qty">' . $value['soluong'] . '</span>
                                                            <span class="cart_price">' . $value_price . '</span>
                                                        </div>
                                                    </div>
                                                    <div class="col-sm-1 col-1 ">
                                                        <button class="remove_cart_sub" data-remove="' . $value['session_id'] . '"
                                                        title="Xóa"
                                                        >X</button>
                                                    </div>
                                                </div>

                                            </div>
                                        ';
            }

            $message_cart .= '    
                </div>
                                      <div class="cart-footer">
                                            <div class="subtotal">
                                                <div class="cart__subtotal">
                                                    <div>
                                                        Tổng tiền:
                                                    </div>
                                                    <div>
                                                        <span>
                                                            ' . number_format($total_price, 0, ',', '.') . '₫' . '
                                                        </span>
                                                    </div>
                                                </div>
                                            </div>
                                            <div>
                                                <a class="checkout-link" href="' . url('/checkout') . '" title="Thanh toán"> Thanh toán</a>
                                            </div>
                                        </div>

                                    </div>        

            
            ';
        }
        echo $message_cart;
    }
}
