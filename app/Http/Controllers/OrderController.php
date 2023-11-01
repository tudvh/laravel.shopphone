<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Carbon\Carbon;
use Illuminate\Support\Facades\Auth;

use App\Helper\CartHelper;
use App\Models\Order;
use App\Models\OrderDetail;

class OrderController extends Controller
{
    public function __construct()
    {
        $this->middleware('cus');
    }

    public function checkout(CartHelper $cart)
    {
        $user = Auth::guard('cus')->user();

        return view('site.checkout', compact('cart', 'user'));
    }

    public function postCheckout(Request $req, CartHelper $cart)
    {
        if (!$cart->getTotalQuantity()) {
            return redirect()->back()->with('error', 'Giỏ hàng trống. Vui lòng thêm sản phẩm vào giỏ hàng trước khi thanh toán!');
        }

        $this->validate($req, [
            'name' => 'required',
            'phone_number' => 'required|regex:/^[0-9]{10,15}$/',
            'ward_id' => 'required',
            'address' => 'required',
            'pay_method' => 'required'
        ], [
            'name.required' => 'Họ và tên không được để trống.',
            'phone_number.required' => 'Số điện thoại không được để trống.',
            'phone_number.regex' => 'Hãy nhập đúng số điện thoại của bạn.',
            'ward_id.required' => 'Hãy chọn Phường/Xã.',
            'address.required' => 'Địa chỉ không được để trống.',
            'pay_method.required' => 'Hãy chọn phương thức thanh toán',
        ]);

        $note = Carbon::now()->addHours(7)->format('H:i:s d-m-Y') . ': Order has been created;';

        $order = Order::create([
            'user_id' => Auth::guard('cus')->user()->id,
            'name' => $req->name,
            'phone_number' => $req->phone_number,
            'ward_id' => $req->ward_id,
            'address' => $req->address,
            'pay_method' => $req->pay_method,
            'ship_fee' => $req->ship_fee,
            'note' => $note
        ]);

        if ($order) {
            foreach ($cart->getItems() as $item) {

                OrderDetail::create([
                    'order_id' => $order->id,
                    'product_id' => $item['id'],
                    'quantity' => $item['quantity'],
                    'price' => $item['price'],
                    'sale_price' => $item['salePrice']
                ]);
            }

            $cart->clear();

            return redirect()->route('home.checkout.success');
        } else {

            return redirect()->back()->with('error', 'Có lỗi xảy ra. Vui lòng đợi ít phút và thử lại!');
        }
    }

    public function checkoutSuccess()
    {
        return view('site.checkoutSuccess');
    }

    public function viewOrder(Request $req)
    {
        $type = $req['type'] ? $req['type'] : 'all';
        $userID = Auth::guard('cus')->user()->id;

        $listOrder = Order::where('user_id', $userID);
        if ($type != 'all') {
            $listOrder = $listOrder->where('status', $type);
        }
        $listOrder = $listOrder->orderBy('created_at', 'desc')->get();

        return view('site.myOrders', compact('listOrder', 'type'));
    }
}
