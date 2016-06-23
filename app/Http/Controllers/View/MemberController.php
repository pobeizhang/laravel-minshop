<?php
namespace App\Http\Controllers\View;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
/**
 * Created by PhpStorm.
 * User: admin
 * Date: 2016/6/3
 * Time: 16:58
 */
class MemberController extends Controller
{
    //登录
    public function toLogin(Request $request)
    {
        $return_url=$request->input('return_url','');
        return view('login')->with('return_url',urldecode($return_url));
    }
    //注册
    public function toRegister()
    {
        return view('/register');
    }
}
