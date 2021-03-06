<?php
namespace App\Http\Controllers\Service;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Tool\Validate\ValidateCode;
use App\Entity\Tempphone;
use App\Entity\Temp_email;
use App\Entity\Member;
use App\Models\M3Result;
use Mail;
use App\Models\M3Email;
use App\Tool\UUID;
/**
 * Created by PhpStorm.
 * User: admin
 * Date: 2016/6/3
 * Time: 16:58
 */
class MemberController extends Controller
{
    public function register(Request $request)
    {
        $email=$request->input('email','');
        $phone=$request->input('phone','');
        $password=$request->input('password','');
        $confirm=$request->input('confirm','');
        $phone_code=$request->input('phone_code','');
        $validate_code=$request->input('validate_code','');

        $m3_result=new M3Result;

        if($phone=='' && $email==''){
            $m3_result->status=1;
            $m3_result->message='手机号或者邮箱不能为空';
            return $m3_result->toJson();
        }
        if($password=='' || strlen($password) <6){
            $m3_result->status=2;
            $m3_result->message='密码不能少于6位';
            return $m3_result->toJson();
        }
        if($confirm=='' || strlen($confirm) <6){
            $m3_result->status=2;
            $m3_result->message='确认密码不能少于6位';
            return $m3_result->toJson();
        }
        if($password != $confirm){
            $m3_result->status=2;
            $m3_result->message='两次密码不相同';
            return $m3_result->toJson();
        }

        //手机注册
        if($phone != ''){
            if($phone_code=='' || strlen($phone_code) <6){
                $m3_result->status=5;
                $m3_result->message='手机验证码为6位';
                return $m3_result->toJson();
            }
            $tempphone=Tempphone::where('phone',$phone)->first();
            if($tempphone->code == $phone_code){
                if(time() > strtotime($tempphone->deadline)){
                    $m3_result->status=7;
                    $m3_result->message='手机验证码不正确';
                    return $m3_result->toJson();
                }
                $member=new Member;
                $member->phone=$phone;
                $member->password=md5('bk' . $password);
                $member->save();

                $m3_result->status=0;
                $m3_result->message='注册成功';
                return $m3_result->toJson();

            }else{
                $m3_result->status=7;
                $m3_result->message='手机验证码不正确';
                return $m3_result->toJson();
            }

        //邮箱注册
        }else{
            if($validate_code=='' || strlen($validate_code) !=4){
                $m3_result->status=6;
                $m3_result->message='验证码不能为4位';
                return $m3_result->toJson();
            }

            $validate_code_session=$request->session()->get('validate_code','');
            if($validate_code != $validate_code_session){
                $m3_result->status=8;
                $m3_result->message='验证码不正确';
                return $m3_result->toJson();
            }
            $member_verify=Member::where('email',$email)->first();
            if($member_verify !=null){
                $m3_result->status=9;
                $m3_result->message='该邮箱已被注册';
                return $m3_result->toJson();
            }
            $member=new Member;
            $member->email=$email;
            $member->password=md5('bk' . $password);
            $member->save();

            $uuid=UUID::create();
            $m3_email=new M3Email;
            $m3_email->to=$email;
            $m3_email->cc='dulei1618@163.com';
            $m3_email->subject='凯恩书店';
            $m3_email->content='请于24小时内点击链接完成验证,http://minshop.com/service/validate_email'
                            .'?member_id='.$member->id
                            .'&code='.$uuid;

            $temp_email=new Temp_email;
            $temp_email->member_id=$member->id;
            $temp_email->code=$uuid;
            $temp_email->deadline=date('Y-m-d H:i:s',time()+24*60*60);
            $temp_email->save();

            Mail::send('mail_register', ['m3_email' => $m3_email], function ($m) use ($m3_email) {
                //  $m->from('hello@app.com', 'Your Application');
                 $m->to($m3_email->to, '尊敬的用户')
                 ->cc($m3_email->cc)
                 ->subject($m3_email->subject);
            });

            $m3_result->status=0;
            $m3_result->message='注册成功';
            return $m3_result->toJson();
        }
    }

    public function login(Request $request)
    {
        $username=$request->get('username','');
        $password=$request->get('password','');
        $validate_code=$request->get('validate_code','');

        $m3_result=new M3Result;

        //判断验证码
        $validate_code_session=$request->session()->get('validate_code');
        if($validate_code != $validate_code_session){
            $m3_result->status=1;
            $m3_result->message='验证码不正确';
            return $m3_result->toJson();
        }

        $member=null;
        if(strpos($username, '@') == true){
            $member=Member::where('email',$username)->first();
        }else{
            $member=Member::where('phone',$username)->first();
        }

        if($member == null){
            $m3_result->status=2;
            $m3_result->message='用户不存在';
            return $m3_result->toJson();
        }else{
            if(md5('bk'.$password) != $member->password){
                $m3_result->status=3;
                $m3_result->message='密码不正确';
                return $m3_result->toJson();
            }
        }
        //将用户信息写到session中
        $request->session()->put('member',$member);

        $m3_result->status=0;
        $m3_result->message='登录';
        return $m3_result->toJson();
    }
}
