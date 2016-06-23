@extends('master')
@section('title','注册')
@section('content')
    <div class="weui_cells_title">注册方式</div>
    <div class="weui_cells weui_cells_radio">
        <label class="weui_cell weui_check_label" for="x11">
            <div class="weui_cell_bd weui_cell_primary">
                <p>手机号注册</p>
            </div>
            <div class="weui_cell_ft">
                <input type="radio" class="weui_check" name="register_type" id="x11" checked="checked">
                <span class="weui_icon_checked"></span>
            </div>
        </label>
        <label class="weui_cell weui_check_label" for="x12">
            <div class="weui_cell_bd weui_cell_primary">
                <p>邮箱注册</p>
            </div>
            <div class="weui_cell_ft">
                <input type="radio" class="weui_check" name="register_type" id="x12">
                <span class="weui_icon_checked"></span>
            </div>
        </label>
    </div>
    <div class="weui_cells weui_cells_form">
        <div class="weui_cell">
            <div class="weui_cell_hd"><label class="weui_label">手机号</label></div>
            <div class="weui_cell_bd weui_cell_primary">
                <input class="weui_input" type="number" placeholder="" name="phone"/>
            </div>
        </div>
        <div class="weui_cell">
            <div class="weui_cell_hd"><label class="weui_label">密码</label></div>
            <div class="weui_cell_bd weui_cell_primary">
                <input class="weui_input" type="password" placeholder="不少于6位" name='passwd_phone'/>
            </div>
        </div>
        <div class="weui_cell">
            <div class="weui_cell_hd"><label class="weui_label">确认密码</label></div>
            <div class="weui_cell_bd weui_cell_primary">
                <input class="weui_input" type="password" placeholder="不少于6位" name='passwd_phone_cfm'/>
            </div>
        </div>

        <div class="weui_cell">
            <div class="weui_cell_hd"><label class="weui_label">手机验证码</label></div>
            <div class="weui_cell_bd weui_cell_primary">
                <input class="weui_input" type="number" placeholder="" name='phone_code'/>
            </div>
            <p class="bk_important bk_phone_code_send">发送验证码</p>
            <div class="weui_cell_ft">
            </div>
        </div>
    </div>
    <div class="weui_cells weui_cells_form" style="display: none;">
        <div class="weui_cell">
            <div class="weui_cell_hd"><label class="weui_label">邮箱</label></div>
            <div class="weui_cell_bd weui_cell_primary">
                <input class="weui_input" type="text" placeholder="" name='email'/>
            </div>
        </div>
        <div class="weui_cell">
            <div class="weui_cell_hd"><label class="weui_label">密码</label></div>
            <div class="weui_cell_bd weui_cell_primary">
                <input class="weui_input" type="password" placeholder="不少于6位" name='passwd_email'>
            </div>
        </div>
        <div class="weui_cell">
            <div class="weui_cell_hd"><label class="weui_label">确认密码</label></div>
            <div class="weui_cell_bd weui_cell_primary">
                <input class="weui_input" type="password" placeholder="不少于6位" name='passwd_email_cfm'/>
            </div>
        </div>
        <div class="weui_cell weui_vcode">
            <div class="weui_cell_hd"><label class="weui_label">验证码</label></div>
            <div class="weui_cell_bd weui_cell_primary">
                <input class="weui_input" type="text" placeholder="请输入验证码" name='validate_code'/>
            </div>
            <div class="weui_cell_ft">
                <img src="/service/validate_code/create" class="bk_validate_code"/>
            </div>
        </div>
    </div>
    <div class="weui_cells_tips"></div>
    <div class="weui_btn_area">
        <a class="weui_btn weui_btn_primary" href="javascript:" onclick="onRegisterClick();">注册</a>
    </div>
    <a href="/login" class="bk_bottom_tips bk_important">已有帐号? 去登录</a>
@endsection
@section('my-js')
    <!-- 用于处理验证码点击切换和手机注册和邮箱注册的切换 -->
    <script>
        $('.bk_validate_code').click(function(){
            $(this).attr('src','/service/validate_code/create?random='+Math.random());
        });
        $('#x12').next().hide();
        $("input:radio[name=register_type]").click(function(){
            $("input:radio[name=register_type]").attr('checked',false);
            $(this).attr('checked',true);
            if($(this).attr('id')=='x11'){
                $('#x11').next().show();
                $('#x12').next().hide();
                $('.weui_cells_form').eq(0).show();
                $('.weui_cells_form').eq(1).hide();
            }else{
                $('#x11').next().hide();
                $('#x12').next().show();
                $('.weui_cells_form').eq(0).hide();
                $('.weui_cells_form').eq(1).show();
            }
        });
    </script>

    <!-- 用于处理手机号码的验证 -->
    <script>
        //用于判断是否可以发送
        var enable=true;
        $('.bk_phone_code_send').click(function(){
            if(enable==false){
                return;
            }
            enable=false;
            //更改字体样式
            $(this).removeClass('bk_important');
            $(this).addClass('bk_summary');
            var num=60;
            var interval=window.setInterval(function(){
                $('.bk_phone_code_send').html(--num+'s 后重新发送');
                if(num==0){
                    $(this).removeClass('bk_summary');
                    $(this).addClass('bk_important');
                    enable=true;
                    window.clearInterval(interval);
                    $('.bk_phone_code_send').html('重新发送');
                }
            },1000);

            var phone=$('input[name=phone]').val();
            //手机号码不能为空
            if(phone==''){
                $('.bk_toptips').show();
                $('.bk_toptips').html('请输入手机号');
                setTimeout(function(){
                    $('.bk_toptips').hide();
                },2000);
                return;
            }
            //手机号码格式验证
            if(phone.length != 11 || phone[0] != '1'){
                $('.bk_toptips').show();
                $('.bk_toptips').html('手机号码格式不正确');
                setTimeout(function(){
                    $('.bk_toptips').hide();
                },2000);
                return;
            }
            $.ajax({
                url:'service/validate_code/send',
                type:'POST',
                dateType:'json',
                cache:false,
                data:{phone:phone, _token: "{{csrf_token()}}"},
                success:function(data){
                    if(data==null){
                        $('.bk_toptips').show();
                        $('.bk_toptips span').html('服务器错误');
                        return;
                    }
                    if(data.status!=0){
                        $('.bk_toptips').show();
                        $('.bk_toptips').html(data.message);
                        setTimeout(function(){
                            $('.bk_toptips').hide();
                        },2000);
                        return;
                    }
                    $('.bk_toptips').show();
                    $('.bk_toptips').html('发送成功');
                    setTimeout(function(){
                        $('.bk_toptips').hide();
                    },2000);
                },
                error:function(xhr,status,error){
                    console.log(xhr);
                    console.log(status);
                    console.log(error);
                }
            });
        });
    </script>
    <script>
        function onRegisterClick(){
            $('input:radio[name=register_type]').each(function(index,el){
                if($(this).attr('checked')=='checked'){
                    var email='';
                    var phone='';
                    var password='';
                    var confirm='';
                    var phone_code='';
                    var validate_code='';

                    var id=$(this).attr('id');
                    if(id=='x11'){
                        phone=$('input[name=phone]').val();
                        password=$('input[name=passwd_phone]').val();
                        confirm=$('input[name=passwd_phone_cfm]').val();
                        phone_code=$('input[name=phone_code]').val();
                        if(verifyPhone(phone,password,confirm,phone_code)==false){
                            return;
                        }
                    }else if(id=='x12'){
                        email=$('input[name=email]').val();
                        password=$('input[name=passwd_email]').val();
                        confirm=$('input[name=passwd_email_cfm]').val();
                        validate_code=$('input[name=validate_code]').val();
                        if(verifyEmail(email,password,confirm,validate_code)==false){
                            return;
                        }
                    }

                    $.ajax({
                        type:'POST',
                        url:'/service/register',
                        dataType:'json',
                        cache:false,
                        data:{phone:phone,email:email,password:password,confirm:confirm,phone_code:phone_code,validate_code:validate_code, _token: "{{csrf_token()}}"},
                        success:function(data){
                            if(data==null){
                                $('.bk_toptips').show();
                                $('.bk_toptips span').html('服务器错误');
                                setTimeout(function(){
                                    $('.bk_toptips').hide();
                                },2000);
                                return;
                            }
                            if(data.status!=0){
                                $('.bk_toptips').show();
                                $('.bk_toptips span').html(data.message);
                                setTimeout(function(){
                                    $('.bk_toptips').hide();
                                },2000);
                                return;
                            }
                            $('.bk_toptips').show();
                            $('.bk_toptips span').html('注册成功');
                            setTimeout(function(){
                                $('.bk_toptips').hide();
                            },2000);
                        },
                        error:function(xhr,status,error){
                            console.log(xhr);
                            console.log(status);
                            console.log(error);
                        }
                    });
                }
            });
        }
        function verifyPhone(phone,password,confirm,phone_code){
            //手机号不能为空、
            if(phone==''){
                $('.bk_toptips').show();
                $('.bk_toptips span').html('请输入手机号');
                setTimeout(function(){
                    $('.bk_toptips').hide();
                },2000);
                return false;
            }
            //手机号码格式
            if(phone.length!=11 || phone[0]!='1'){
                $('.bk_toptips').show();
                $('.bk_toptips span').html('手机号码格式不正确');
                setTimeout(function(){
                    $('.bk_toptips').hide();
                },2000);
                return false;
            }
            //密码和确认密码不能为空
            if(password=='' || confirm==''){
                $('.bk_toptips').show();
                $('.bk_toptips span').html('密码不能为空');
                setTimeout(function(){
                    $('.bk_toptips').hide();
                },2000);
                return false;
            }
            // alert(password.length);
            //密码格式
            if(password.length < 6 || confirm.length < 6){
                $('.bk_toptips').show();
                $('.bk_toptips span').html('密码长度不能小于6位');
                setTimeout(function(){
                    $('.bk_toptips').hide();
                },2000);
                return false;
            }
            //密码和确认密码是否相等
            if(password!=confirm){
                $('.bk_toptips').show();
                $('.bk_toptips span').html('两次密码不相同');
                setTimeout(function(){
                    $('.bk_toptips').hide();
                },2000);
                return false;
            }
            //手机验证码不能为空
            if(phone_code==''){
                $('.bk_toptips').show();
                $('.bk_toptips span').html('手机验证码不能为空');
                setTimeout(function(){
                    $('.bk_toptips').hide();
                },2000);
                return false;
            }
            //手机验证码的格式
            if(phone_code.length != 6){
                $('.bk_toptips').show();
                $('.bk_toptips span').html('手机验证码为6位');
                setTimeout(function(){
                    $('.bk_toptips').hide();
                },2000);
                return false;
            }
            return true;
        }

        function verifyEmail(email,password,confirm,validate_code){
            //邮箱不能为空
            if(email==''){
                $('.bk_toptips').show();
                $('.bk_toptips span').html('请输入邮箱');
                setTimeout(function(){
                    $('.bk_toptips').hide();
                },2000);
                return false;
            }
            //邮箱格式
            if(email.indexOf('@')=='-1' || email.indexOf('.')=='-1'){
                $('.bk_toptips').show();
                $('.bk_toptips span').html('邮箱格式不正确');
                setTimeout(function(){
                    $('.bk_toptips').hide();
                },2000);
                return false;
            }
            //密码和确认密码不能为空
            if(password=='' || confirm==''){
                $('.bk_toptips').show();
                $('.bk_toptips span').html('密码不能为空');
                setTimeout(function(){
                    $('.bk_toptips').hide();
                },2000);
                return false;
            }
            //密码格式

            if(password.length<6 || confirm.length<6){
                $('.bk_toptips').show();
                $('.bk_toptips span').html('密码长度不能小于6位');
                setTimeout(function(){
                    $('.bk_toptips').hide();
                },2000);
                return false;
            }
            //两次密码是否相同
            if(password != confirm){
                $('.bk_toptips').show();
                $('.bk_toptips span').html('两次密码不相同');
                setTimeout(function(){
                    $('.bk_toptips').hide();
                },2000);
                return false;
            }
            //验证码不能为空
            if(validate_code==''){
                $('.bk_toptips').show();
                $('.bk_toptips span').html('验证码不能为空');
                setTimeout(function(){
                    $('.bk_toptips').hide();
                },2000);
                return false;
            }
            //验证码格式
            if(validate_code.length != 4){
                $('.bk_toptips').show();
                $('.bk_toptips span').html('验证码必须为4位');
                setTimeout(function(){
                    $('.bk_toptips').hide();
                },2000);
                return false;
            }
            return true;
        }
    </script>
@endsection
