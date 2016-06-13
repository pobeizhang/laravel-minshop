<?php
namespace App\Http\Controllers\Service;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Tool\Validate\ValidateCode;
use App\Tool\SMS\SendTemplateSMS;
use App\Entity\Tempphone;
use App\Entity\Temp_email;
use App\Entity\Member;
use App\Models\M3Result;
/**
 * Created by PhpStorm.
 * User: admin
 * Date: 2016/6/3
 * Time: 15:39
 */

class ValidateController extends Controller
{
    //生成验证码
    public function create(Request $request)
    {
        $validate=new ValidateCode();
        $request->session()->put('validate_code',$validate->getCode());
        return $validate->doimg();
    }

    public function sendSMS(Request $request)
    {
        $m3_result=new M3Result();
        $phone=$request->input('phone','');
        if($phone==''){
            $m3_result->status=1;
            $m3_result->message='手机号不能为空';
            return $m3_result->toJson();
        }

        $SendTemplateSMS=new SendTemplateSMS();
        $code='';
        $charset='0123456789';
        $_len=strlen($charset);
        for($i=0;$i<6;$i++){
            $code.=$charset[mt_rand(0,$_len-1)];
        }
       $m3_result=$SendTemplateSMS->sendTemplateSMS($phone, array($code, 60), 1);
       if($m3_result->status==0){
           //将手机验证码压入数据库
           $tempphone=Tempphone::where('phone',$phone)->first();
           if($tempphone==null){
               $tempphone=new Tempphone();
           }

           $tempphone->phone=$phone;
           $tempphone->code=$code;
           $tempphone->deadline=date('Y-m-d H:i:s',time()+60*60);
           $tempphone->save();
       }
        return $m3_result->toJson();
    }

    public function validateEmail(Request $request)
    {
        $member_id=$request->input('member_id','');
        $code=$request->input('code','');
        if($member_id=='' || $code==''){
            return '验证异常';
        }
        $tempEmail=Temp_email::where('member_id',$member_id)->first();
        if($tempEmail==null){
            return '验证异常';
        }
        if($code==$tempEmail->code){
            if(time() > strtotime($tempEmail->deadline)){
                return '该链接已失效';
            }
            $member=Member::find($member_id);
            $member->active=1;
            $member->save();

            return redirect('/login');
        }else{
            return '该链接已失效';
        }

    }
}
