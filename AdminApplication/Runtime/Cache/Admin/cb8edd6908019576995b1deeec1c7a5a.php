<?php if (!defined('THINK_PATH')) exit();?><!doctype html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, maximum-scale=1, user-scalable=no">
    <title>Document</title>
</head>
<link href="//cdn.bootcss.com/bootstrap/3.3.5/css/bootstrap.min.css" rel="stylesheet">
<script src="//cdn.bootcss.com/jquery/1.11.3/jquery.min.js"></script>
<!--<script src="/ysy/Public/Js/bootstrap/bootstrap.min.js"></script>-->
<script src="//cdn.bootcss.com/bootstrap/3.3.5/js/bootstrap.min.js"></script>
<body>
<?php echo ($head); ?>
<div class="container-fluid">
    <div class="row">
        <div class="col-md-2">
            <ul class="nav nav-pills nav-stacked nav-pills-stacked-example">
                <li role="presentation" class="active"><a href="#">管理员管理</a></li>
                <li role="presentation"><a href="<?php echo U("Rbac/Rbac/actionOperationRole") ?>">角色管理</a></li>
                <li role="presentation"><a href="#">增加权限</a></li>
            </ul>
        </div>
        <div class="col-md-10">
            <div class="alert alert-danger alert-dismissible" style="display: none" role="alert">
                <button type="button" class="close definedclose" ><span aria-hidden="true">×</span></button>
                <h4>是否执行操作</h4>
                <p>
                    <button type="button" class="btn btn-danger">确认</button>
                    <button type="button" class="btn btn-default definedclose">取消</button>
                </p>
            </div>
            <table class="table table-hover">
                <tr>
                    <th>编号</th>
                    <th>账号</th>
                    <th>最后登录时间</th>
                    <th>最后登录IP</th>
                    <th>状态</th>
                    <th>操作</th>
                </tr>
                <?php if(is_array($userInfoDataDB)): foreach($userInfoDataDB as $k=>$v): ?><tr>
                        <td><?php echo ($v["id"]); ?></td>
                        <td><?php echo ($v["username"]); ?></td>
                        <td><?php echo (date("Y-m-d h:i:s",$v["logintime"])); ?></td>
                        <td><?php echo ($v["loginip"]); ?></td>
                        <td><?php if($v["status"] == 0): ?>正常<?php else: ?>停用<?php endif; ?></td>
                        <td>
                            <button data-id="<?php echo ($v["id"]); ?>" data-opertype="stop" type="button" class="btn btn-warning btn-xs"><?php if($v["status"] == 1): ?>启用<?php else: ?>停用<?php endif; ?></button>
                            <button data-id="<?php echo ($v["id"]); ?>" data-opertype="del" type="button" class="btn btn-danger btn-xs">删除</button>
                        </td>
                    </tr><?php endforeach; endif; ?>
            </table>
            <button type="button" class="btn btn-primary" data-toggle="modal" data-target="#exampleModal" data-whatever="@mdo">增加管理员</button>
        </div>
    </div>
    <div class="modal fade" id="exampleModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel">
        <form action="<?php echo U('Rbac/Rbac/actionOperationUserToDB') ?>" method="get">
            <div class="modal-dialog" role="document">
                <div class="modal-content">
                    <div class="modal-header">
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                        <h4 class="modal-title" id="exampleModalLabel">新管理员</h4>
                    </div>
                    <div class="modal-body">
                        <form>
                            <div class="form-group">
                                <label for="recipient-name" class="control-label">登录账号:</label>
                                <input name="username" type="text" class="form-control" id="recipient-name">
                            </div>
                            <div class="form-group">
                                <label for="message-text" class="control-label">密码:</label>
                                <input name="password" class="form-control" id="message-text">
                            </div>
                        </form>
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-default" data-dismiss="modal">取消</button>
                        <button type="submit" class="btn btn-primary">保存</button>
                    </div>
                </div>
            </div>
        </form>
    </div>
</div>
<script>

    var OperationAdmin = function(){
        var _operationUserJson = {};
        var _controlAlarmShow = function(varMode){
            if(varMode == 'show'){
                $('.alert.alert-danger').css('display','block');
                $('.alert.alert-danger').css("opacity","0");
                setTimeout(function(){
                    $('.alert.alert-danger').css({
                        "transition": "opacity 1s",
                        "-webkit-transition": "opacity 1s",
                        "-moz-transition": "opacity 1s",
                        "-o-transition": "opacity 1s",
                        "-ms-transition": "opacity 1s",
                        "opacity": "1"
                    });
                },0);
            }else{
                $('.alert.alert-danger').css({
                    "transition": "opacity .8s",
                    "-webkit-transition": "opacity .8s",
                    "-moz-transition": "opacity .8s",
                    "-o-transition": "opacity .8s",
                    "-ms-transition": "opacity .8s",
                    "opacity": "0.1"
                });
                setTimeout(function(){
                    $('.alert.alert-danger').css('display','none');
                },800);
            }
        };

        var _clickTrOperation = function(event){
            if(event.target.tagName != 'BUTTON') return false;
            _controlAlarmShow('show');
            _operationUserJson = { 'mode' : 'operationUser' , 'opertype' : event.target.getAttribute('data-opertype') , 'userid' : event.target.getAttribute('data-id')};
        };

        var _initi = function(){
            $('.table-hover tr').on('click' , _clickTrOperation);
            $('.alert.alert-danger .definedclose').on('click' , function(){
                _controlAlarmShow('hide');
                _operationUserJson = {};
            });

            $('.alert.alert-danger .btn-danger').on('click' , function(){
                _controlAlarmShow('hide');
                $.get('<?php echo U('Rbac/Rbac/actionAjaxOperationFactory') ?>' , _operationUserJson,function(responseData){
                    location.reload();
                });
            });
        }();
    }();
</script>



</body>
</html>