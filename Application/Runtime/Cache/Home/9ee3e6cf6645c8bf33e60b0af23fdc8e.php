<?php if (!defined('THINK_PATH')) exit();?><!DOCTYPE html>
<!-- saved from url=(0051)http://weixin.epet.com/dingtalkstamp/editstamp.html -->
<html><head><meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
    <meta charset="utf-8">
    <title>
    </title>
    <meta name="viewport" content="initial-scale=1, maximum-scale=1, user-scalable=no, minimal-ui">

    <!--<script src="/myysy/Public/Js/bootstrap/bootstrap.min.js"></script>-->

    <link rel="stylesheet" type="text/css" href="/myysy/Public/Css/ticket/check.css">
    <script src="http://libs.baidu.com/jquery/1.9.1/jquery.min.js"></script>

</head>
<body>

<style>
    .shadow{position:fixed; width:100%;height:100%; background:#000; opacity:0.7; z-index:9; top:0; left:0}
    .pop-up{width:75%; background:#FFF; border-radius:5px; z-index:99; position:fixed;margin:auto;left:0; right:0; top:0; bottom:0;}
    .pop-up2{width:75%; background:#FFF; border-radius:5px; z-index:99; position:fixed;top: 26%;left: 13%;}
    .name-list{margin:5px 0; text-align: center;width: 90%; font-size: 14px;}
    .name-list li.name-select{color: #498ee0;}
    .pop-box{display:table; width:100%; height:100%}
    .off-btn{width:46%;height:35px; border-radius:25px;}
    .btn-box{margin-top:20px; padding:0 15px;}
    .btn-box a{font-size:16px; display:block; line-height:35px;}
    .yes-btn{background:#498ee0;}
    .cancel-btn{background:#c6c6c6}
    .remark-area{width: 86%; resize: none;height: 130px;outline: none;overflow-y: scroll;font-size: 14px;padding: 5px;margin: 0 auto;display: block;border: solid 1px #dedede;line-height: 20px;}
    .approver-input{width: 86%; height: 35px;outline: none;padding: 5px;font-size: 14px;display: block;border: solid 1px #dedede;margin: 0 auto;}
    .table-cell{display:table-cell; vertical-align:middle;}
    .pop-remark{height: 260px;}
    .pull-left{float: left}
    .pull-right{float: right}
</style>
<div class="spinner">
    <div class="rect1"></div>
    <div class="rect2"></div>
    <div class="rect3"></div>
    <div class="rect4"></div>
    <div class="rect5"></div>
</div>
<form method="get" action="<?php echo U('/home/ticket/ticket/actionSubmit') ?>">
    <input type="hidden" name="token" value="<?php echo ($token); ?>">
    <div class="mt10 bgfff pad10 w100 clearfix">
        <div class="rela">
            <p class="ft14 c666 fl width85 mr5">卷号</p>
            <input type="ticketnum" name="filename" id="" value="" class="dib ft13 c666 fl inputborder" placeholder="（必填）">
        </div>
    </div>
    <div class="mt10 bgfff pad10 w100 clearfix">
        <div class="rela">
            <p class="ft14 c666 fl width85 mr5">姓名</p>
            <input type="customername" name="filename" id="" value="" class="dib ft13 c666 fl inputborder" placeholder="（必填）">
        </div>
    </div>
    <div class="mt10 bgfff pad10 w100 clearfix">
        <div class="rela">
            <p class="ft14 c666 fl width85 mr5">地址</p>
            <input type="customeraddress" name="filename" id="" value="" class="dib ft13 c666 fl inputborder" placeholder="（必填）">
        </div>
    </div>
    <div class="mt10 bgfff pad10 w100 clearfix">
        <div class="rela">
            <p class="ft14 c666 fl width85 mr5">电话</p>
            <input type="number" name="customerphone" id="" value="" class="dib ft13 c666 fl inputborder" placeholder="（必填）">
        </div>
    </div>
    <a class="round5 mt15 ft14 tj-btn ct ftc db mb20 submit-a">提 交</a>
</form>

<style>
    .asymmetric-radius {
        width:100px;
        /* you can add backround style by yourself */
        height: 30px;
        line-height: 30px;
        text-align:center;
        font-size: 14px;
        border-radius: 30px / 90px;
        background:rgba(0,0,0,0.2);
        color: white;
        position: absolute;
        top: 10%;
        margin-left: 35%;
        transition: opacity 5s;
    }
    .asymmetric-radius-opacity{
        opacity: 0;
    }
    .spinner {
        z-index: 99999;
        top: 10%;
        left: 45%;
        width: 50px;
        height: 60px;
        text-align: center;
        font-size: 10px;
        position: absolute;
        display: block;
    }

    .spinner > div {
        background-color: #67CF22;
        height: 100%;
        width: 6px;
        display: inline-block;

        -webkit-animation: stretchdelay 1.2s infinite ease-in-out;
        animation: stretchdelay 1.2s infinite ease-in-out;
    }

    .spinner .rect2 {
        -webkit-animation-delay: -1.1s;
        animation-delay: -1.1s;
    }

    .spinner .rect3 {
        -webkit-animation-delay: -1.0s;
        animation-delay: -1.0s;
    }

    .spinner .rect4 {
        -webkit-animation-delay: -0.9s;
        animation-delay: -0.9s;
    }

    .spinner .rect5 {
        -webkit-animation-delay: -0.8s;
        animation-delay: -0.8s;
    }

    @-webkit-keyframes stretchdelay {
        0%, 40%, 100% { -webkit-transform: scaleY(0.4) }
        20% { -webkit-transform: scaleY(1.0) }
    }

    @keyframes stretchdelay {
        0%, 40%, 100% {
            transform: scaleY(0.4);
            -webkit-transform: scaleY(0.4);
        }  20% {
               transform: scaleY(1.0);
               -webkit-transform: scaleY(1.0);
           }
    }


</style>
<div class="alarm-asymmetric asymmetric-radius">卷号不能为空</div>
<script>
    var MyUpFile = function(){
        var alarmFun = function(){
            console.log('11111');
            setTimeout(function(){
                $('.alarm-asymmetric').addClass('asymmetric-radius-opacity');
                setTimeout(function(){
                    $('.alarm-asymmetric').hide();
                },500);
            },2000);
        };
        return {
            alarmFun1:alarmFun
        }
    }();
</script>

</body></html>