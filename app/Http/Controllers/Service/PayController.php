<?php

namespace App\Http\Controllers\Service;

use Illuminate\Http\Request;

use App\Http\Requests;
use App\Http\Controllers\Controller;

class PayController extends Controller
{
    public function alipay(Request $request)
    {
        require_once(app_path()."/Tool/Alipay/alipay.config.php");
        require_once(app_path()."/Tool/Alipay/lib/alipay_submit.class.php");

        /**************************调用授权接口alipay.wap.trade.create.direct获取授权码token**************************/

        //返回格式
        $format = "xml";
        //必填，不需要修改

        //返回格式
        $v = "2.0";
        //必填，不需要修改

        //请求号
        $req_id = date('Ymdhis');
        //必填，须保证每次请求都是唯一

        //**req_data详细信息**

        //服务器异步通知页面路径
        $notify_url = "http://" . $_SERVER['HTTP_HOST'] . '/service/pay/ali_notity';
        //需http://格式的完整路径，不允许加?id=123这类自定义参数

        //页面跳转同步通知页面路径
        $call_back_url = "http://" . $_SERVER['HTTP_HOST'] . '/service/pay/ali_result';
        //需http://格式的完整路径，不允许加?id=123这类自定义参数
        //http://127.0.0.1:8800/WS_WAP_PAYWAP-PHP-UTF-8/call_back_url.php

        //操作中断返回地址
        $merchant_url = "http://" . $_SERVER['HTTP_HOST'] . '/service/pay/ali_merchant';
        //用户付款中途退出返回商户的地址。需http://格式的完整路径，不允许加?id=123这类自定义参数

        //卖家支付宝帐户
        $seller_email = $_POST['WIDseller_email'];
        //必填

        //商户订单号
        $out_trade_no = $_POST['WIDout_trade_no'];
        //商户网站订单系统中唯一订单号，必填

        //订单名称
        $subject = $_POST['WIDsubject'];
        //必填

        //付款金额
        $total_fee = $_POST['WIDtotal_fee'];
        //必填

        //请求业务参数详细
        $req_data = '<direct_trade_create_req><notify_url>' . $notify_url . '</notify_url><call_back_url>' . $call_back_url . '</call_back_url><seller_account_name>' . $seller_email . '</seller_account_name><out_trade_no>' . $out_trade_no . '</out_trade_no><subject>' . $subject . '</subject><total_fee>' . $total_fee . '</total_fee><merchant_url>' . $merchant_url . '</merchant_url></direct_trade_create_req>';
        //必填

        /************************************************************/

        //构造要请求的参数数组，无需改动
        $para_token = array(
        		"service" => "alipay.wap.trade.create.direct",
        		"partner" => trim($alipay_config['partner']),
        		"sec_id" => trim($alipay_config['sign_type']),
        		"format"	=> $format,
        		"v"	=> $v,
        		"req_id"	=> $req_id,
        		"req_data"	=> $req_data,
        		"_input_charset"	=> trim(strtolower($alipay_config['input_charset']))
        );

        //建立请求
        $alipaySubmit = new \AlipaySubmit($alipay_config);
        $html_text = $alipaySubmit->buildRequestHttp($para_token);

        //URLDECODE返回的信息
        $html_text = urldecode($html_text);

        //解析远程模拟提交后返回的信息
        $para_html_text = $alipaySubmit->parseResponse($html_text);

        //获取request_token
        $request_token = $para_html_text['request_token'];


        /**************************根据授权码token调用交易接口alipay.wap.auth.authAndExecute**************************/

        //业务详细
        $req_data = '<auth_and_execute_req><request_token>' . $request_token . '</request_token></auth_and_execute_req>';
        //必填

        //构造要请求的参数数组，无需改动
        $parameter = array(
        		"service" => "alipay.wap.auth.authAndExecute",
        		"partner" => trim($alipay_config['partner']),
        		"sec_id" => trim($alipay_config['sign_type']),
        		"format"	=> $format,
        		"v"	=> $v,
        		"req_id"	=> $req_id,
        		"req_data"	=> $req_data,
        		"_input_charset"	=> trim(strtolower($alipay_config['input_charset']))
        );

        //建立请求
        $alipaySubmit = new \AlipaySubmit($alipay_config);
        $html_text = $alipaySubmit->buildRequestForm($parameter, 'get', '确认');
        return $html_text;
    }

    public function aliNotify()
    {
        require_once(app_path()."/Tool/alipay/alipay.config.php");
        require_once(app_path()."/Tool/alipay/lib/alipay_notify.class.php");

        //计算得出通知验证结果
        $alipayNotify = new \AlipayNotify($alipay_config);
        $verify_result = $alipayNotify->verifyNotify();

        if($verify_result) {//验证成功
        	/////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////
        	//请在这里加上商户的业务逻辑程序代


        	//——请根据您的业务逻辑来编写程序（以下代码仅作参考）——
            //获取支付宝的通知返回参数，可参考技术文档中服务器异步通知参数列表

        	//解析notify_data
        	//注意：该功能PHP5环境及以上支持，需开通curl、SSL等PHP配置环境。建议本地调试时使用PHP开发软件
        	$doc = new \DOMDocument();
        	if ($alipay_config['sign_type'] == 'MD5') {
        		$doc->loadXML($_POST['notify_data']);
        	}

        	if ($alipay_config['sign_type'] == '0001') {
        		$doc->loadXML($alipayNotify->decrypt($_POST['notify_data']));
        	}

        	if( ! empty($doc->getElementsByTagName( "notify" )->item(0)->nodeValue) ) {
        		//商户订单号
        		$out_trade_no = $doc->getElementsByTagName( "out_trade_no" )->item(0)->nodeValue;
        		//支付宝交易号
        		$trade_no = $doc->getElementsByTagName( "trade_no" )->item(0)->nodeValue;
        		//交易状态
        		$trade_status = $doc->getElementsByTagName( "trade_status" )->item(0)->nodeValue;

        		if($trade_status == 'TRADE_FINISHED') {
        			//判断该笔订单是否在商户网站中已经做过处理
        				//如果没有做过处理，根据订单号（out_trade_no）在商户网站的订单系统中查到该笔订单的详细，并执行商户的业务程序
        				//如果有做过处理，不执行商户的业务程序

        			//注意：
        			//该种交易状态只在两种情况下出现
        			//1、开通了普通即时到账，买家付款成功后。
        			//2、开通了高级即时到账，从该笔交易成功时间算起，过了签约时的可退款时限（如：三个月以内可退款、一年以内可退款等）后。

        			//调试用，写文本函数记录程序运行情况是否正常
        			//logResult("这里写入想要调试的代码变量值，或其他运行的结果记录");

        			return "success";		//请不要修改或删除
        		}
        		else if ($trade_status == 'TRADE_SUCCESS') {
        			//判断该笔订单是否在商户网站中已经做过处理
        				//如果没有做过处理，根据订单号（out_trade_no）在商户网站的订单系统中查到该笔订单的详细，并执行商户的业务程序
        				//如果有做过处理，不执行商户的业务程序

        			//注意：
        			//该种交易状态只在一种情况下出现——开通了高级即时到账，买家付款成功后。

        			//调试用，写文本函数记录程序运行情况是否正常
        			//logResult("这里写入想要调试的代码变量值，或其他运行的结果记录");

                    // 修改用户的订单状态
                    Log::info('支付成功');
                    $order = Order::where('order_no', $out_trade_no)->first();
                    $order->status = 2;
                    $order->save();
        			return "success";		//请不要修改或删除
        		}
        	}

        	//——请根据您的业务逻辑来编写程序（以上代码仅作参考）——

        	/////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////
        }
        else {
            //验证失败
            return "fail";

            //调试用，写文本函数记录程序运行情况是否正常
            //logResult("这里写入想要调试的代码变量值，或其他运行的结果记录");
        }
    }

    public function aliResult()
    {
        require_once(app_path()."/Tool/alipay/alipay.config.php");
        require_once(app_path()."/Tool/alipay/lib/alipay_notify.class.php");

        //计算得出通知验证结果
        $alipayNotify = new \AlipayNotify($alipay_config);
        $verify_result = $alipayNotify->verifyReturn();
        if($verify_result) {//验证成功
        	/////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////
        	//请在这里加上商户的业务逻辑程序代码

        	//——请根据您的业务逻辑来编写程序（以下代码仅作参考）——
            //获取支付宝的通知返回参数，可参考技术文档中页面跳转同步通知参数列表

        	//商户订单号
        	$out_trade_no = $_GET['out_trade_no'];

        	//支付宝交易号
        	$trade_no = $_GET['trade_no'];

        	//交易状态
        	$result = $_GET['result'];


        	//判断该笔订单是否在商户网站中已经做过处理
        		//如果没有做过处理，根据订单号（out_trade_no）在商户网站的订单系统中查到该笔订单的详细，并执行商户的业务程序
        		//如果有做过处理，不执行商户的业务程序

        	return "验证成功<br />";

        	//——请根据您的业务逻辑来编写程序（以上代码仅作参考）——

        	/////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////
        }
        else {
            //验证失败
            //如要调试，请看alipay_notify.php页面的verifyReturn函数
            return "验证失败";
        }
    }

    public function aliMerchant()
    {
        return view('alipay.merchant_url');
    }

    public function wxPay(Request $request) {
    $openid = $request->session()->get('openid', '');
    if($openid == '') {
      $m3_result = new M3Result;
      $m3_result->status = 1;
      $m3_result->message = 'Session已过期, 请重新提交订单';

      return $m3_result;
    }

    return WXTool::wxPayData($request->input('name'), $request->input('order_no'), ((float)$request->input('total_price'))*100, $openid);
  }

  public function wxNotify() {
    Log::info('微信支付回调开始');
    $return_data = file_get_contents("php://input");
    Log::info('return_data: '.$return_data);

    libxml_disable_entity_loader(true);
    $data = simplexml_load_string($return_data, 'SimpleXMLElement', LIBXML_NOCDATA);

    Log::info('return_code: '.$data->return_code);
    if($data->return_code == 'SUCCESS') {
      $order = Order::where('order_no', $data->out_trade_no)->first();
      $order->status = 2;
      $order->save();

      return "<xml>
                <return_code><![CDATA[SUCCESS]]></return_code>
                <return_msg><![CDATA[OK]]></return_msg>
              </xml>";
    }

    return "<xml>
              <return_code><![CDATA[FAIL]]></return_code>
              <return_msg><![CDATA[FAIL]]></return_msg>
            </xml>";

  }
}
