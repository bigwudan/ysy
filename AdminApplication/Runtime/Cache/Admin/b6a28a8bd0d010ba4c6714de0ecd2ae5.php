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

            <table class="table table-condensed checkin-table">
                <thead>
                <tr>
                    <th>id</th>
                    <th>名称</th>

                    <th>操作</th>
                </tr>
                </thead>
                <tbody>

                <?php if(is_array($formatList)): foreach($formatList as $k=>$vo): ?><tr>
                        <td><?php echo ($vo["format_id"]); ?></td>
                        <td><?php echo str_repeat('|--' , $vo['level']); echo ($vo["format_name"]); ?></td>
                        <td>
                            <a data-formatname="<?php echo ($vo["format_name"]); ?>" data-formatid="<?php echo ($vo["format_id"]); ?>" href="javascrip:void(0)" class="btn btn-danger editgoods">修改</a>
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
                <h4 class="modal-title" id="exampleModalLabel"><span class="title-span">修改规格</span></h4>
            </div>
            <div class="modal-body">
                <form class="form-horizontal editgoods-form">
                    <input name="format_id" value="0" type="hidden" >

                    <div class="form-group">
                        <label  class="col-sm-2 control-label"><span class="text2-span">规格名称</span></label>
                        <div class="col-sm-10">
                            <input name="format_name" class="form-control">
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


                $('input[name="format_id"]').val($(this).attr('data-formatid'));
                $('input[name="format_name"]').val($(this).attr('data-formatname'));
                $('#editgoods').show();

                $('.modal-backdrop').show();

            });



            $('.modal-dialog .btn-default').on('click' , function(){
                $('.modal#exampleModal').hide();
                $('#editgoods').hide();
                $('.modal-backdrop').hide();

            });

            $('.modal-dialog .close').on('click' , function(){

                $('.modal#exampleModal').hide();
                $('#editgoods').hide();
                $('.modal-backdrop').hide();
            });

            $('.modal-dialog .btn-primary').on('click' , function(){
                var formatId = $('input[name="format_id"]').val();
                var formatName = $('input[name="format_name"]').val();

                $('.modal#exampleModal').hide();
                $('#editgoods').hide();
                var url = '<?php echo U('stockandsale/ManageFormat/actionRequestService') ?>';
                $.get(url,{id:formatId , name:formatName},function(responseData){
                    window.location.href = '<?php echo U('stockandsale/ManageFormat') ?>';
                    console.log(responseData);

                });


            })

        }();


    }();



</script>


</body>
</html>