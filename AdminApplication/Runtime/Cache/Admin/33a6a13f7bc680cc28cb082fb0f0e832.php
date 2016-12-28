<?php if (!defined('THINK_PATH')) exit();?><!doctype html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, maximum-scale=1, user-scalable=no">
    <title>Document</title>
</head>
<link href="//cdn.bootcss.com/bootstrap/3.3.5/css/bootstrap.min.css" rel="stylesheet">
<script src="//cdn.bootcss.com/jquery/1.11.3/jquery.min.js"></script>
<!--<script src="/myysy/Public/Js/bootstrap/bootstrap.min.js"></script>-->
<script src="//cdn.bootcss.com/bootstrap/3.3.5/js/bootstrap.min.js"></script>
<body>
<style>
    .cover{
        z-index: 22;
        top: 0px;
        left: 0px;
        bottom: 0px;
        right: 0px;
        background-color: #000000;
        opacity: 0.5;
        position: fixed;
        display: none;
    }

    .spinner {
        z-index: 99999;
        top: 50%;
        left: 50%;
        width: 50px;
        height: 60px;
        text-align: center;
        font-size: 10px;
        position: absolute;
        display: none;
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
    .modal-backdrop{
        opacity: 0;
    }

    .modify{
        cursor: pointer;

    }

</style>


<div class="cover"></div>
<div class="spinner">
    <div class="rect1"></div>
    <div class="rect2"></div>
    <div class="rect3"></div>
    <div class="rect4"></div>
    <div class="rect5"></div>
</div>

<?php echo ($body['head']); ?>
<div class="container-fluid">
    <div class="row">
        <?php echo ($body['sider']); ?>
        <div class="col-md-10">
            <form class="form-inline" method="get" action="<?php echo U('/ticket/EditTicket') ?>">
                <div class="form-group form-group-sm">
                    <label for="exampleInputName2">卷号</label>
                    <input name="number" type="text" class="form-control" id="exampleInputName2" placeholder="">
                </div>
                <div class="form-group form-group-sm">
                    <label for="exampleInputName2">状态</label>
                    <select name="is_spend" class="form-control">
                        <option value="">全部</option>
                        <option value="0">未确认</option>
                        <option value="1">已确认</option>
                    </select>
                </div>
                <div class="form-group form-group-sm">
                    <label for="exampleInputName2">款式</label>
                    <select name="style" class="form-control">
                        <option value="">全部</option>
                        <option value="0">海上明月</option>
                        <option value="1">秋月明辉</option>
                    </select>
                </div>
                <div class="form-group form-group-sm">
                    <label for="exampleInputName2">姓名</label>
                    <input name="rec_name" type="text" class="form-control" id="exampleInputName2" placeholder="">
                </div>

                <div class="form-group form-group-sm">
                    <label for="exampleInputName2">地址</label>
                    <input name="rec_addr" type="text" class="form-control" id="exampleInputName2" placeholder="">
                </div>

                <div class="form-group form-group-sm">
                    <label for="exampleInputName2">电话</label>
                    <input name="rec_tel" type="text" class="form-control" id="exampleInputName2" placeholder="">
                </div>

                <button type="submit" class="btn btn-default">查询</button>
            </form>
            <table class="table">
                <!--     <caption>Optional table caption.</caption> -->
                <thead>
                <tr>
                    <th>id</th>
                    <th>卷号</th>
                    <th>款式</th>
                    <th>验证码</th>
                    <th>收货人名</th>
                    <th>收货人省</th>
                    <th>收货人地址</th>
                    <th>收货人电话</th>
                    <th>收货人备注</th>
                    <th>是否领取</th>
                    <th>物流单</th>
                    <th>客服备注</th>
                    <th>操作</th>
                </tr>
                </thead>
                <tbody>
                <?php echo ($html); ?>
                </tbody>
            </table>
            <div style="font-size: 20px">
                <?php echo ($show); ?>
            </div>
        </div>
    </div>
</div>


<!-- Modal -->
<div class="modal fade" id="myModal" tabindex="-1" role="dialog" aria-labelledby="myModalLabel">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                <h4 class="modal-title" id="myModalLabel">更新资料</h4>
            </div>
            <div class="modal-body">
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-default" data-dismiss="modal">关闭</button>
                <button type="button" class="btn btn-primary">保存</button>
            </div>
        </div>
    </div>
</div>

<script>
    var ShowOrder = function(){

        var _showOrder = function(){
            $('.cover').show();
            $('.spinner').show();
            var id = parseInt($(this).attr('data-id'));
            $.get("<?php echo U('/ticket/EditTicket/actionFactoryCenter') ?>" , {id:id , mode : 'showorder'} , function(data){
                $('#myModal').find('.modal-body').html(data);
                $('#myModal').modal();
                $('.modal-backdrop').css('opacity' , 0);
                $('.cover').hide();
                $('.spinner').hide();
            });
        };

        var _confirmOrder = function(){
            var objArr = $('#myModal [name]');
            var dataJson = {};
            $('.cover').show();
            $('.spinner').show();
            for(var num = 0 ; num < objArr.length ; num++){
                dataJson[$(objArr[num]).attr('name')] = $(objArr[num]).val();
            }
            dataJson.mode = 'uporder';
            $.get("<?php echo U('/ticket/EditTicket/actionFactoryCenter') ?>" , dataJson , function(data){
                window.location.reload();
            })
        };

        var _intit = function(){
            $('.modify').on('click' , _showOrder);
            $('#myModal .btn-primary').on('click',_confirmOrder);

        }();




    }();





</script>

</body>
</html>