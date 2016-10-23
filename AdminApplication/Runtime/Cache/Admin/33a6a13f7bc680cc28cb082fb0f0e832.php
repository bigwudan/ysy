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
<?php echo ($head); ?>
<div class="container-fluid">
    <div class="row">
        <div class="col-md-2">
            <ul class="nav nav-pills nav-stacked nav-pills-stacked-example">
                <li role="presentation" class="active"><a href="#">增加对卷</a></li>
                <li role="presentation"><a href="<?php echo U("Rbac/Rbac/actionOperationRole") ?>">角色管理</a></li>
                <li role="presentation"><a href="#">增加权限</a></li>
            </ul>
        </div>
        <div class="col-md-10">
            <table class="table table-hover">
                <tr>
                    <th>起始号</th>
                    <th>卷号总数</th>
                    <th>领卷单位</th>
                    <th>截止时间</th>
                </tr>
                <?php if(is_array($ticketDataFromDb)): foreach($ticketDataFromDb as $k=>$v): ?><tr>
                        <td><?php echo ($v["id"]); ?></td>
                        <td><?php echo ($v["amount"]); ?></td>
                        <td><?php echo ($v["recvcompany"]); ?></td>
                        <td><?php echo (date("Y-m-d",$v["deadline"])); ?></td>
                    </tr><?php endforeach; endif; ?>
            </table>
            <button type="button" class="btn btn-primary" data-toggle="modal" data-target="#exampleModal" data-whatever="@mdo">增加卷号</button>
        </div>
        <div class="modal fade" id="exampleModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel">
            <form action="<?php echo U('Ticket/AllocationTicket/actionDistributeTicketToDb') ?>" method="get">
                <div class="modal-dialog" role="document">
                    <div class="modal-content">
                        <div class="modal-header">
                            <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                            <h4 class="modal-title" id="exampleModalLabel">新管理号</h4>
                        </div>
                        <div class="modal-body">
                            <form>
                                <div class="form-group">
                                    <label for="recipient-name1" class="control-label">开始卷号</label>
                                    <input name="begid" type="number" class="form-control" id="recipient-name1">
                                </div>
                                <div class="form-group">
                                    <label for="recipient-name" class="control-label">发卷总数</label>
                                    <input name="amount" type="number" class="form-control" id="recipient-name">
                                </div>
                                <div class="form-group">
                                    <label for="message-text1" class="control-label">收货单位:</label>
                                    <input name="recvcompany" class="form-control" id="message-text1">
                                </div>
                                <div class="form-group">
                                    <label for="message-text2" class="control-label">销售员:</label>
                                    <input name="saleuid" class="form-control" id="message-text2">
                                </div>
                                <div class="form-group">
                                    <label for="message-text3" class="control-label">截止时间:</label>
                                    <input name="deadline" type="date" class="form-control" id="message-text3">
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
</div>




</body>
</html>