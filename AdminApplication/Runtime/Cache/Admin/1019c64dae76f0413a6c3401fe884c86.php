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
            <div><a  type="button" class="btn btn-info addgoods-a">新增商品</a></div>
            <table class="table table-condensed checkin-table">
                <thead>
                <tr>
                    <th>商品id</th>
                    <th>规格</th>
                    <th>名称</th>
                    <th>库存</th>
                    <th>操作</th>
                </tr>
                </thead>
                <tbody>

                <?php if(is_array($formatList)): foreach($formatList as $k=>$vo): ?><tr>
                        <td><?php echo ($vo["goods_id"]); ?></td>
                        <td><?php echo ($vo["format_name"]); ?></td>
                        <td><?php echo ($vo["goods_name"]); ?></td>
                        <td><?php echo ($vo["goods_num"]); ?></td>
                        <td>
                            <a href="<?php echo U('stockandsale/Checkin/actionEditCheckIn') ?>?checkin=<?php echo ($vo["checkin_id"]); ?>" class="btn btn-danger">修改</a>
                        </td>
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


<div class="modal fade in"  id="exampleModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                    <h4 class="modal-title" id="exampleModalLabel">新加商品</h4>
                </div>
                <div class="modal-body">
                    <form class="form-horizontal">
                        <div class="form-group">
                            <label for="inputEmail3" class="col-sm-2 control-label">规格</label>
                            <div class="col-sm-10">
                                <select name="format_id" class="form-control">
                                    <?php if(is_array($formatList)): foreach($formatList as $k=>$v): ?><option value="<?php echo ($v["format_id"]); ?>"><?php echo ($v["format_name"]); ?></option><?php endforeach; endif; ?>
                                </select>
                            </div>
                        </div>
                        <div class="form-group">
                            <label  class="col-sm-2 control-label">商品名称</label>
                            <div class="col-sm-10">
                                <input name="goods_name" class="form-control">
                            </div>
                        </div>
                        <div class="form-group">
                            <label  class="col-sm-2 control-label">备注</label>
                            <div class="col-sm-10">
                                <input name="remark" class="form-control">
                            </div>
                        </div>

                    </form>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-default" data-dismiss="modal">取消</button>
                    <button type="submit" class="btn btn-primary">保存</button>
                </div>
            </div>
        </div>

</div>

<div style="display: none" class="modal-backdrop fade in"></div>
<script>
    var ManageGoodsList = function(){




        var _initi = function(){

            $('.addgoods-a').on('click' , function(){
                $('.modal').show();
                $('.modal-backdrop').show();
            });


            $('.modal-dialog .btn-default').on('click' , function(){
                $('.modal').hide();
                $('.modal-backdrop').hide();

            });

            $('.modal-dialog .close').on('click' , function(){
                $('.modal').hide();
                $('.modal-backdrop').hide();
            });

            $('.modal-dialog .btn-primary').on('click' , function(){
                $('.modal').hide();
                var url = '<?php echo U('stockandsale/ManageGoods/actionRequestService') ?>';
                var formatid = $('select[name="format_id"]').val();
                var goodsname = $('input[name="goods_name"]').val();
                var remark = $('input[name="remark"]').val();
                $.get(url , {type:'editgoods',formatid:formatid,goodsname:goodsname,remark:remark} , function(data){
                    var url = '<?php echo U('stockandsale/ManageGoods') ?>';
                    var responseJson = JSON.parse(data);
                    if(responseJson.error === 0){
                        window.location.href = url;
                    }else{
                        $('.modal-backdrop').hide();
                        alert('更新失败');
                    }
                });
            })

        }();


    }();



</script>


</body>
</html>