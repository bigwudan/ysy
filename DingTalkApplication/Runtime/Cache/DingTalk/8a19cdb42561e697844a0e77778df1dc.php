<?php if (!defined('THINK_PATH')) exit();?><!doctype html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width,initial-scale=1,user-scalable=0">
    <title>Document</title>
    <link rel="stylesheet" type="text/css" href="/myysy/Public/Dingtalk/Css/weui.css"/>
    <script src="/myysy/Public/Dingtalk/Js/zepto.min.js" type="text/javascript" charset="utf-8"></script>
</head>
<body>
<div class="page__bd">


    <form action="<?php echo U('Login/LoginByHtml/actionSubmit') ?>" method="get">

        <div class="weui-cells weui-cells_form">
            <div class="weui-cell">
                <div class="weui-cell__hd"><label class="weui-label">用户名称</label></div>
                <div class="weui-cell__bd">
                    <input name="loginname" class="weui-input" type="text" pattern="" placeholder="请输入用户名称">
                </div>
            </div>

            <div class="weui-cell">
                <div class="weui-cell__hd"><label class="weui-label">密码</label></div>
                <div class="weui-cell__bd">
                    <input name="loginpassword" class="weui-input" type="password" pattern="" placeholder="请输入密码">
                </div>
            </div>
            <div class="weui-btn-area">
                <a class="weui-btn weui-btn_primary" href="javascript:" id="showTooltips">确定</a>
            </div>
        </div>


    </form>

    <script>

        $('.weui-btn_primary').on('click' , function(){

            $('form').submit();

        });



    </script>

</div>
</body>
</html>