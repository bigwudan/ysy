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
            <div>
                <a  type="button" class="btn btn-info addgoods-a">新增商品</a>
                <a  type="button" class="btn btn-info addformat-a">新增商品规格</a>
            </div>
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

                <?php if(is_array($goodsList)): foreach($goodsList as $k=>$vo): ?><tr>
                        <td><?php echo ($vo["goods_id"]); ?></td>
                        <td><?php echo ($vo["format_name"]); ?></td>
                        <td><?php echo ($vo["goods_name"]); ?></td>
                        <td><?php echo ($vo["goods_num"]); ?></td>
                        <td>
                            <a data-formatid="<?php echo ($vo["format_id"]); ?>" data-id="<?php echo ($vo["goods_id"]); ?>" href="javascrip:void(0)" class="btn btn-danger editgoods">修改</a>
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

<div class="modal fade in"  id="editgoods" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                <h4 class="modal-title" id="exampleModalLabel"><span class="title-span">新加商品</span></h4>
            </div>
            <div class="modal-body">
                <form class="form-horizontal editgoods-form">

                    <input name="goodsinfo_type" value="editgoods" type="hidden" >
                    <input name="goodsinfo_goodsid" value="0" type="hidden" >

                    <div class="form-group">
                        <label for="inputEmail3" class="col-sm-2 control-label"><span class="text1-span">规格</span></label>
                        <div class="col-sm-10">
                            <select name="format_select" class="form-control">
                                <?php if(is_array($formatArr)): foreach($formatArr as $k=>$v): ?><option value="<?php echo ($v["format_id"]); ?>"><?php echo str_pad('',$v['level'],"--"); echo ($v["format_name"]); ?></option><?php endforeach; endif; ?>

                            </select>
                        </div>
                    </div>
                    <div class="form-group">
                        <label  class="col-sm-2 control-label"><span class="text2-span">商品名称</span></label>
                        <div class="col-sm-10">
                            <input name="goodsinfo_name" class="form-control">
                        </div>
                    </div>

                    <div class="form-group">
                        <label  class="col-sm-2 control-label"><span class="text2-span">库存</span></label>
                        <div class="col-sm-10">
                            <input name="goodsinfo_num" class="form-control">
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


<div class="modal fade in"  id="exampleModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                    <h4 class="modal-title" id="exampleModalLabel"><span class="title-span">新加商品</span></h4>
                </div>
                <div class="modal-body">
                    <form class="form-horizontal">

                        <input name="type" value="addgoods" type="hidden" >

                        <div class="form-group">
                            <label for="inputEmail3" class="col-sm-2 control-label"><span class="text1-span">规格</span></label>
                            <div class="col-sm-10">
                                <select name="format_id" class="form-control">
                                    <?php if(is_array($formatArr)): foreach($formatArr as $k=>$v): ?><option value="<?php echo ($v["format_id"]); ?>"><?php echo str_pad('',$v['level'],"--"); echo ($v["format_name"]); ?></option><?php endforeach; endif; ?>
                                </select>
                            </div>
                        </div>
                        <div class="form-group">
                            <label  class="col-sm-2 control-label"><span class="text2-span">商品名称</span></label>
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

        var _stats = 'beg';


        var _initi = function(){


            $('.checkin-table .editgoods').on('click' , function(){
                $('.modal-backdrop').show();
                var goodsid = $(this).attr('data-id');
                var type = 'getgoodinfo';
                var url = '<?php echo U('stockandsale/ManageGoods/actionRequestService') ?>';
                $.get(url , {type:type,goodsid:goodsid} , function(data){
                    _stats = 'editgoods';

                    $('input[name="goodsinfo_goodsid"]').val(goodsid);

                    try{
                        var goodsinfoJson = JSON.parse(data);
                        $('select[name="format_select"] option').each(function(){
                            if($(this).val() == goodsinfoJson.format_id){
                                $(this).prop('selected' , true);
                            }
                        });
                        $('input[name="goodsinfo_name"]').val(goodsinfoJson.goods_name);
                        $('input[name="goodsinfo_num"]').val(goodsinfoJson.goods_num);
                        $('#editgoods').show();
                    }catch(e){
                        alert('异常错误');
                    }
                });
            });

            $('.addgoods-a').on('click' , function(){


                $('.title-span').text('新增商品');
                $('.text1-span').text('规格');
                $('.text2-span').text('商品名称');
                $('input[name="type"]').val('addgoods');

                $('.modal#exampleModal').show();
                $('.modal-backdrop').show();
            });

            $('.addformat-a').on('click' , function(){
                $('.title-span').text('新增规格');
                $('.text1-span').text('父级规格');
                $('.text2-span').text('规格名称');
                $('input[name="type"]').val('addformat');
                $('.modal#exampleModal').show();
                $('.modal-backdrop').show();
            });



            $('.modal-dialog .btn-default').on('click' , function(){
                $('.modal#exampleModal').hide();
                $('.modal-backdrop').hide();

            });

            $('.modal-dialog .close').on('click' , function(){
                $('.modal#exampleModal').hide();
                $('.modal-backdrop').hide();
            });

            $('.modal-dialog .btn-primary').on('click' , function(){
                $('.modal#exampleModal').hide();
                $('#editgoods').hide();
                var url = '<?php echo U('stockandsale/ManageGoods/actionRequestService') ?>';
                if(_stats == 'editgoods'){
                    var requestJson = {
                        type : 'submitgoods',
                        formatid : $('select[name="format_select"]').val(),
                        goodsid : $('input[name="goodsinfo_goodsid"]').val(),
                        goodsname : $('input[name="goodsinfo_name"]').val(),
                        goodsnum : $('input[name="goodsinfo_num"]').val()
                    };
                    $.get(url , requestJson , function(data){
                        var url = '<?php echo U('stockandsale/ManagePacks') ?>';
                        window.location.href = url;
                    });
                    return false;

                }else{
                    var formatid = $('select[name="format_id"]').val();
                    var goodsname = $('input[name="goods_name"]').val();
                    var remark = $('input[name="remark"]').val();
                    var type = $('input[name="type"]').val();
                    $.get(url , {type:type,formatid:formatid,goodsname:goodsname,remark:remark } , function(data){
                        var url = '<?php echo U('stockandsale/ManageGoods') ?>';
                        var responseJson = JSON.parse(data);
                        if(responseJson.error === 0){
                            window.location.href = url;
                        }else{
                            $('.modal-backdrop').hide();
                            alert('更新失败');
                        }
                    });

                }



            })

        }();


    }();



</script>


</body>
</html>