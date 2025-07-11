<?php

namespace App\Http\Controllers;

use App\Models\Coupons;
use App\Models\OrderDetail;
use App\Models\OrderProduct;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\App;
use App\Models\Brand;
use App\Models\Product;
use App\Models\Category;
use App\Models\BannerModel;
use App\Models\SantisticalModel;
use Illuminate\Support\Facades\Session;
use Carbon\Carbon;
use App\Models\CateActicleModel;
use Illuminate\Support\Facades\Redirect;


class OrderController extends Controller
{

    public function AuthLoginCustomer()
    {
        $id_customer = Session::get('id_customer');
        if ($id_customer) {
            return Redirect::to('user.home'); // cần return
        } else {
            return Redirect::to('login-index')->send();
        }
    }
    // ADMIN

    public function print_order($order_code)
    {
        $pdf = App::make('dompdf.wrapper');
        $pdf->loadHTML($this->print_order_convert($order_code));
        return $pdf->stream();
    }

    public function print_order_convert($order_code)
    {
        // Khởi tạo biến đếm số lượng sản phẩm
        $order_count_quantity = 0;
        $summary_product = 0;
        $summary_order = 0;
        // Lấy thông tin chi tiết đơn hàng
        $data_detailOrder = OrderDetail::where('order_code', $order_code)->get();

        foreach ($data_detailOrder as $detailOrder) {
            $order_count_quantity += $detailOrder['product_sale_quantity'];
            $order_price_product =  $detailOrder['product_price'];
            $order_quantity_sale = $detailOrder['product_sale_quantity'];
            $summary_product = $order_price_product * $order_quantity_sale;
            $summary_order += $summary_product;
        }

        // Lấy thông tin vận chuyển của đơn hàng
        $order_ship = OrderProduct::with([
            'shippingAddress.province',
            'shippingAddress.districts',
            'shippingAddress.wards'
        ])->where('order_code', $order_code)->first();
        $order_ship->order_status;

        if ($order_ship->order_status == 1) {
            $status = 'Đơn hàng đang xữ lý';
        } elseif ($order_ship->order_status == 2) {
            $status = 'Đơn hàng đã xữ lý';
        } else {
            $status = 'Đơn hàng đã hủy';
        }
        // Kiểm tra xem đơn hàng có tồn tại không
        if (!$order_ship) {
            return "Đơn hàng không tồn tại.";
        }

        // Lấy coupon giảm giá nếu có
        $find_coupon = $order_ship->discount_coupon_id;
        $discount_amount = 0; // Mặc định không có giảm giá

        if ($find_coupon) {
            $check_coupon = Coupons::where('id_coupon', $find_coupon)->first();

            if ($check_coupon) {
                if ($check_coupon->coupon_type == 'fixed') {
                    // Giảm giá theo số tiền cố định
                    $discount_amount = number_format($check_coupon->discount, 0, ',', '.') . ' VNĐ';
                } else {
                    // Giảm giá theo phần trăm
                    $discount_amount = $check_coupon->discount . ' %';
                }
            }
        }

        return view('admin.order.view_pdf')
            ->with('detailOrder', $data_detailOrder)
            ->with('orderShip', $order_ship)
            ->with('orderCount', $order_count_quantity)
            ->with('orderStatus', $status)
            ->with('discountAmount', $discount_amount)
            ->with('summaryProduct', $summary_product)
            ->with('summaryOrder', $summary_order);
    }
    public function order_view(Request $request)
    {
        $ls_dataOrder = OrderProduct::with(['shippingAddress']);
        if ($request->has('order_code')) {
            if ($request->get('order_code')) {
                $ls_dataOrder->where('order_code', 'LIKE', '%' . $request->get('order_code') . '%');
            }
        }

        if ($request->has('order_date')) {
            if ($request->get('order_date')) {

                $ls_dataOrder->whereDate('created_at', $request->get('order_date'));
            }
        }

        if ($request->has('order_status')) {
            if ($request->get('order_status')) {

                $ls_dataOrder->where('order_status', $request->get('order_status'));
            }
        }

        $history = $ls_dataOrder->get();

        return view('admin.order.order_view')->with('lsOrder', $history);
    }
    public function view_detail($order_code)
    {
        $order_count_quantity = 0;

        // Lấy thông tin ở bảng order detail
        $order_infomation = OrderDetail::with('phone')->where('order_code', $order_code)->get();
        // Lấy thông tin ở bảng order detail

        foreach ($order_infomation as $detailOrder) {
            $order_count_quantity += $detailOrder['product_sale_quantity'];
        }
        // Lấy thông tin ở bảng order
        $order_history = OrderProduct::with([
            'shippingAddress.province',
            'shippingAddress.districts',
            'shippingAddress.wards',
        ])
            ->where('order_code', $order_code)->first();
        // Lấy thông tin ở bảng order detail

        // Lấy giá trị của discount_coupon_id, mặc định là 0 nếu null
        $find_coupon = $order_history->discount_coupon_id;
        $coupon = Coupons::where('id_coupon', $find_coupon)->first();
        if ($coupon) {
            if ($coupon->coupon_type == 'fixed') {
                // Giảm giá theo số tiền cố định
                $discount =
                    number_format($coupon->discount_amount, 0, ',', '.') . ' VNĐ';
            } else {
                // Giảm giá theo phần trăm
                $discount = $coupon->discount_amount . ' %';
            }
            $code = $coupon->coupon_code;
        } else {
            // Nếu không tìm thấy coupon
            $discount = 0 . ' VNĐ'; // Không có giảm giá
        }

        if ($order_history->order_status == 3) {
            $order_status = 'Đã hủy';
        } elseif ($order_history->order_status == 2) {
            $order_status = 'Đã xác nhận';
        } else {
            $order_status = 'Đơn hàng mới';
        }


        return view('admin.order.order_detail')
            ->with("order_historys", $order_history) //Thông tin ở bảng order
            ->with('orderCount', $order_count_quantity)
            ->with("order_infomations", $order_infomation)   // Thông tin ở bảng order detail
            ->with("orderStatus", $order_status)
            ->with("code_coupon", $coupon)
            ->with("discount_price", $discount)
            ->with("code_coupon", $code)
        ;
    }


    public function update_status_order(Request $request)
    {
        $data = $request->all();
        $orderCode = $data['ordercode'];
        $orderReason = $data['orderreason'];
        $orderStatus = $data['orderstatus'];
        $orderItem = $data['orderitem'];
        $order_update = OrderProduct::where('order_code', $orderCode)->first();

        $orderStatusText = '';

        if ($orderStatus == 3) {
            $orderStatusText = 'Đã hủy';
            $order_update->order_status = 3;
            $order_update->order_cancellation_reason = $orderReason;
            $order_update->save();
        } elseif ($orderStatus == 2) {
            $orderStatusText = 'Đã xác nhận';
            $order_update->order_status = 2;
            $order_details = OrderDetail::with('phone')
                ->where('order_code', $orderCode)->get();
            $profit_order = 0;
            $count_item = 0;
            foreach ($order_details as $order_detail) {
                $profit_order =
                    ($order_detail->product_price - $order_detail->phone->purchase_price)
                    * $order_detail->product_sale_quantity;
                $count_item += $order_detail->product_sale_quantity;
            }

            // Cập nhật tất cả đơn hàng đã xác nhật
        }
        $order_update->save();


        foreach ($order_details as $oderDetail) {
            $product = Product::find($oderDetail->order_phone_id);
            $product->product_quantity -= $oderDetail->product_sale_quantity;
            $product->sold =  $product->sold + $oderDetail->product_sale_quantity;
            $product->save();
        }

        if ($orderStatus == 2) {


            $currentDate = Carbon::now()->format('Y-m-d');
            $santistical = SantisticalModel::where('order_date', $currentDate)->first();
            $totalOrder =
                OrderProduct::where('order_code', $orderCode)->value('order_total');


            if ($santistical) {
                $santistical->order_date = $currentDate;
                $santistical->total_price_orders =  $santistical->total_price_orders + $totalOrder;
                $santistical->profit =  $santistical->profit + $profit_order;
                $santistical->quantity_sale_products = $santistical->quantity_sale_products + $count_item;
                $santistical->total_orders = $santistical->total_orders + 1;
                $santistical->save();
            } else {
                $santistical_new = new SantisticalModel();
                $santistical_new->order_date = $currentDate;
                $santistical_new->total_price_orders = $totalOrder;
                $santistical_new->profit = $profit_order;
                $santistical_new->quantity_sale_products = $count_item;
                $santistical_new->total_orders = 1;
                $santistical_new->save();
            }
        }
        return response()->json([
            'message' => 'Cập nhật thành công',
            'orderStatusText' => $orderStatusText,
        ]);
    }


    // USER

    public function history_order(Request $request)
    {
        $this->AuthLoginCustomer();
        $brand = Brand::get();
        $category = Category::get();
        $banners = BannerModel::all();
        $id_user = Session::get('id_customer');

        $orders = OrderProduct::with(['shippingAddress'])->where('id_customer', $id_user);

        if ($request->has('order_code')) {
            if ($request->get('order_code')) {
                $orders->where('order_code', 'LIKE', '%' . $request->get('order_code') . '%');
            }
        }

        if ($request->has('order_date')) {
            if ($request->get('order_date')) {

                $orders->whereDate('created_at', $request->get('order_date'));
            }
        }

        if ($request->has('order_status')) {
            if ($request->get('order_status')) {

                $orders->where('order_status', $request->get('order_status'));
            }
        }

        $history = $orders->get();


        return view('user.shopping.history_order')
            ->with('brands', $brand)
            ->with("category", $category)
            ->with("historys", $history)
            ->with('banners', $banners)

        ;
    }

    public function view_history($order_code)
    {
        $this->AuthLoginCustomer();
        $brand = Brand::get();
        $category = Category::get();
        $banners = BannerModel::all();
        $order_count_quantity = 0;
        $grand_total = 0;

        // Lấy thông tin ở bảng order detail
        $order_infomation = OrderDetail::where('order_code', $order_code)->get();
        // Lấy thông tin ở bảng order detail

        foreach ($order_infomation as $detailOrder) {
            $order_count_quantity += $detailOrder['product_sale_quantity'];
            $total_price_product = $detailOrder['product_sale_quantity'] * $detailOrder['product_price'];
            $grand_total += $total_price_product;
        }
        // Lấy thông tin ở bảng order
        $order_history = OrderProduct::with([
            'shippingAddress.province',
            'shippingAddress.districts',
            'shippingAddress.wards',
        ])
            ->where('order_code', $order_code)->first();
        // Lấy thông tin ở bảng order detail

        // Lấy giá trị của discount_coupon_id, mặc định là 0 nếu null
        $find_coupon = $order_history->discount_coupon_id;
        $coupon = Coupons::where('id_coupon', $find_coupon)->first();
        if ($coupon) {
            if ($coupon->coupon_type == 'fixed') {
                // Giảm giá theo số tiền cố định
                $discount =
                    number_format($coupon->discount_amount, 0, ',', '.') . ' VNĐ';
            } else {
                // Giảm giá theo phần trăm
                $discount = $coupon->discount_amount . ' %';
            }
        } else {
            // Nếu không tìm thấy coupon
            $discount = 0 . ' VNĐ'; // Không có giảm giá
        }

        if ($order_history->order_status == 3) {
            $order_status = 'Đã hủy';
        } elseif ($order_history->order_status == 2) {
            $order_status = 'Đã xác nhận';
        } else {
            $order_status = 'Đơn hàng mới';
        }
        return view('user.shopping.view_history_order')
            ->with('brands', $brand)
            ->with("category", $category)
            ->with("order_historys", $order_history) //Thông tin ở bảng order
            ->with('orderCount', $order_count_quantity)
            ->with("order_infomations", $order_infomation)   // Thông tin ở bảng order detail
            ->with("orderStatus", $order_status)
            ->with("code_coupon", $coupon)
            ->with("discount_price", $discount)
            ->with("grandTotal", $grand_total)
            ->with('banners', $banners)
        ;
    }


    public function getInforOrder(Request $request)
    {
        $this->AuthLoginCustomer();
        $data = $request->all();
        $orderCode = $data['order_code'];

        $order_get = OrderProduct::where('order_code', $orderCode)->first();
        $orderStatus = $order_get->order_status;
        $orderReason = $order_get->order_cancellation_reason;

        $orderStatusText = '';

        if ($order_get->order_status == 3) {
            $orderStatusText = 'Đã hủy';
        } elseif ($order_get->order_status == 2) {
            $orderStatusText = 'Đã xác nhận';
        } else {
            $orderStatusText = 'Đơn hàng mới';
        }
        // Trả về phản hồi JSON mà không lưu vào CSDL
        return response()->json([
            'message' => 'Đơn hàng đã được cập nhật.',
            'orderStatus' => $orderStatus,
            'orderStatusText' => $orderStatusText, // Trả về tên trạng thái
            'orderReason' => $orderReason
        ]);
    }


    public function cancel_order(Request $request)
    {
        $this->AuthLoginCustomer();
        $data = $request->all();
        $orderCode = $data['order_code'];
        $cancelReason = $data['cancel_reason'];
        $id_user = Session::get('id_customer');
        $order = OrderProduct::where('order_code', $orderCode)
            ->where('id_customer', $id_user)
            ->first();
        $order->order_status = 3;
        $order->order_cancellation_reason = $cancelReason;
        $order->save();
    }
}
