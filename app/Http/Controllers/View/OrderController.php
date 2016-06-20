<?php

namespace App\Http\Controllers\View;

use Illuminate\Http\Request;

use App\Http\Requests;
use App\Http\Controllers\Controller;
use App\Entity\Cart_item;
use App\Entity\Product;
use App\Entity\Order;
use App\Entity\Order_item;
use App\Models\BKWXJsConfig;
use App\Tool\WXpay\WXTool;

class OrderController extends Controller
{
    public function toOrderCommit(Request $request)
    {
        $product_ids = $request->input('product_ids', '');
        $product_ids_arr=($product_ids != null ? explode(',', $product_ids) : array());
        $member=$request->session()->get('member','');
        $cart_items=Cart_item::where('member_id',$member->id)->whereIn('product_id',$product_ids_arr)->get();
        $cart_items_arr=array();
        $total_price=0;

        $order = new Order;
        $order->member_id = $member->id;
        $order->save();

        $name='';
        foreach ($cart_items as $cart_item) {
            $cart_item->product=Product::find($cart_item->product_id);
            if($cart_item->product !=null){
                $name .= ('《'.$cart_item->product->name.'》');
                $total_price+=$cart_item->count*$cart_item->product->price;
                array_push($cart_items_arr, $cart_item);

                $order_item = new OrderItem;
                $order_item->order_id = $order->id;
                $order_item->product_id = $cart_item->product_id;
                $order_item->count = $cart_item->count;
                $order_item->pdt_snapshot = json_encode($cart_item->product);
                $order_item->save();
            }
        }

        CartItem::whereIn('id', $cart_items_ids_arr)->delete();

        $order->name = $name;
        $order->total_price = $total_price;
        $order->order_no = 'E'.time().''.$order->id;
        $order->save();

        // JSSDK 相关
        $access_token = WXTool::getAccessToken();
        $jsapi_ticket = WXTool::getJsApiTicket($access_token);
        $noncestr = WXTool::createNonceStr();
        $timestamp = time();
        $url = 'http://' . $_SERVER['HTTP_HOST'] . $_SERVER['PHP_SELF'];
        // 签名
        $signature = WXTool::signature($jsapi_ticket, $noncestr, $timestamp, $url);
        // 返回微信参数
        $bk_wx_js_config = new BKWXJsConfig;
        $bk_wx_js_config->appId = config('wx_config.APPID');
        $bk_wx_js_config->timestamp = $timestamp;
        $bk_wx_js_config->nonceStr = $noncestr;
        $bk_wx_js_config->signature = $signature;

        // return $total_price;
        return view('order_commit')->with('cart_items',$cart_items_arr)
                                    ->with('total_price',$total_price)
                                    ->with('bk_wx_js_config', $bk_wx_js_config);
    }

    public function toOrderList(Request $request)
    {
        $member=$request->session()->get('member','');
        $orders=Order::where('member_id',$member->id)->get();
        foreach ($orders as $order) {
            $order_items=Order_item::where('order_id',$order->id)->get();
            $order->order_items=$order_items;
            foreach ($order_items as $order_item) {
                $order_item->product=json_decode($order_item->pdt_snapshot);
            }
        }
        return $orders;
        return view('order_list')->with('orders',$orders);
    }
}
