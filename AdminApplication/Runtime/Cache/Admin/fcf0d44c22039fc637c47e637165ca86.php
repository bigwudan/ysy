<?php if (!defined('THINK_PATH')) exit();?><!doctype html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, maximum-scale=1, user-scalable=no">
    <title>Document</title>
</head>
<link href="//cdn.bootcss.com/bootstrap/3.3.5/css/bootstrap.min.css" rel="stylesheet">
<script src="//cdn.bootcss.com/jquery/1.11.3/jquery.min.js"></script>

<script src="//cdn.bootcss.com/bootstrap/3.3.5/js/bootstrap.min.js"></script>

<body>


<?php echo ($body['head']); ?>
<form id="checkin-form">
<div class="container-fluid">



    <div class="row">


        <?php echo ($body['sider']); ?>
        <div class="col-md-10">
            <div><a href="<?php echo U('stockandsale/Goodspackage/actionEditGoodsPackage') ?>" type="button" class="btn btn-info">新增组合商品</a></div>
            <table class="table table-condensed checkin-table">
                <thead>
                <tr>
                    <th>组合商品编号</th>
                    <th>名称</th>
                    <th>时间</th>
                    <th>操作</th>
                </tr>
                </thead>
                <tbody>

                <?php if(is_array($goodsPackList)): foreach($goodsPackList as $k=>$vo): ?><tr>
                        <td><?php echo ($vo["id"]); ?></td>
                        <td><?php echo ($vo["packagename"]); ?></td>
                        <td><?php echo date("Y-m-d" , $vo['addtime']); ?></td>
                        <td><a href="<?php echo U('stockandsale/Goodspackage/actionEditGoodsPackage') ?>?packageid=<?php echo ($vo["id"]); ?>" class="btn btn-danger">修改</a></td>
                    </tr><?php endforeach; endif; ?>
                </tbody>
            </table>
            <div style="font-size: 20px">
                <?php echo ($showPage); ?>
            </div>
        </div>
    </div>
</div>
</form>
<script>
    var CheckInList = function(){

        var _initi = function(){


        }();


    }();



</script>


</body>
</html>