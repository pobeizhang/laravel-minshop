<?php
namespace App\Http\Controllers\View;
use App\Http\Controllers\Controller;

/**
 * Created by PhpStorm.
 * User: admin
 * Date: 2016/6/3
 * Time: 16:58
 */
class MemberController extends Controller
{
    //登录
    public function toLogin()
    {
        return view('/login');
    }
    //注册
    public function toRegister()
    {
        return view('/register');
    }
}
