<?php if (!defined('THINK_PATH')) exit();?>
<!doctype html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width,initial-scale=1.0, minimum-scale=1.0, maximum-scale=1.0, user-scalable=no"/>

    <title>郁生源中秋礼券兑换</title>
</head>
<script src="http://apps.bdimg.com/libs/zepto/1.1.4/zepto.min.js"></script>
<style>
    *{
        padding: 0;
        margin: 0;
        border: none;
        font-family: 'Microsoft YaHei';
    }

    body{
        background-color: #D6DBC5;
        width: 100%;
        height:100%;


    }

    .container{
        width: 100%;
        height:100%;
    }
    .header img{
        margin: 0 auto;
        display: block;



    }
.input-lg {
    height: 46px;
    padding: 10px 16px;
    font-size: 18px;
    line-height: 1.3333333;
    border-radius: 6px;
}

.form-control {
    margin: 10px auto;
    display: block;
    width: 80%;
    height: 34px;
    padding: 6px 12px;
    font-size: 14px;
    line-height: 1.42857143;
    color: #555;
    background-color: #fff;
    background-image: none;
    border: 1px solid #ccc;
    border-radius: 4px;
    -webkit-box-shadow: inset 0 1px 1px rgba(0,0,0,.075);
    box-shadow: inset 0 1px 1px rgba(0,0,0,.075);
    -webkit-transition: border-color ease-in-out .15s,-webkit-box-shadow ease-in-out .15s;
    -o-transition: border-color ease-in-out .15s,box-shadow ease-in-out .15s;
    transition: border-color ease-in-out .15s,box-shadow ease-in-out .15s;
}

.btn-success {
    color: #fff;
    background-color: #5cb85c;
    border-color: #4cae4c;
}

.btn {
    display: inline-block;
    padding: 6px 12px;
    margin-bottom: 0;
    font-size: 14px;
    font-weight: 400;
    line-height: 1.42857143;
    text-align: center;
    white-space: nowrap;
    vertical-align: middle;
    -ms-touch-action: manipulation;
    touch-action: manipulation;
    cursor: pointer;
    -webkit-user-select: none;
    -moz-user-select: none;
    -ms-user-select: none;
    user-select: none;
    background-image: none;
    border: 1px solid transparent;
    border-radius: 4px;
}

.btn-danger {
    color: #fff;
    background-color: #d9534f;
    border-color: #d43f3a;
}

.button-container{

    text-align: center;


}

.button-container button{

 



}

.foot{
    margin: 10px;


}

.foot p  {

    font-size: 12px;




}
.foot img{
	width: 100%;
	height: 100%;


}
    .alert-danger {
        color: #a94442;
        background-color: #f2dede;
        border-color: #ebccd1;
    }
    .alert {
        margin: 10px auto;
        width: 80%;
        padding: 10px;

        border: 1px solid transparent;
        border-radius: 4px;
    }
</style>
<body>
    <div class="container">
        <div class="header">
            <img src="/myysy/Public/Img/loge.png">
        </div>
        <form action="<?php echo U('Ticket/Ticket/actionSucess') ?>">
        <div class="body">
            <input type="hidden"  name="token" value="<?php echo ($token); ?>">
            <input type="hidden"  name="id" value="<?php echo ($id); ?>">
            <div class="alert alert-danger" role="alert" style="display: none">
                <strong>错误:</strong><span>提货卷和验证码有错</span>
            </div>
            <input name="rec_name" class="form-control input-lg" type="text" placeholder="收件人姓名">
            <input name="rec_addr" class="form-control input-lg" type="text" placeholder="收件地址">
            <input name="rec_tel" class="form-control input-lg" type="text" placeholder="收件电话">
            <input name="remark" class="form-control input-lg" type="text" placeholder="备注">
            <div class="button-container">
                <button type="button" class="btn btn-success" style="margin-right: 40px;">提交</button>
                <button type="button" class="btn btn btn-danger">重设</button>
            </div>
        </div>
        </form>
    </div>

<script type="text/javascript">

    var check = function(){
        var rec_name = $('input[name="rec_name"]').val();
        var rec_addr = $('input[name="rec_addr"]').val();
        var rec_tel = $('input[name="rec_tel"]').val();
        if(!rec_name || !rec_addr || !rec_tel){
            $('.alert-danger').show();
            $('.alert-danger span').html('姓名,地址和电话不能为空');
            return false;
        }
        return true;
    };


    $('.btn-danger').on('click' , function(){
        $('input[name="rec_name"]').val('');
        $('input[name="rec_addr"]').val('');
        $('input[name="rec_tel"]').val('');
        $('input[name="remark"]').val('');
    });
    
$('.btn-success').on('click' , function(){
    $('.alert-danger span').html('');
    var flag = check();
    if(flag){
        $("form").submit();
    }
});


</script>

</body>
</html>