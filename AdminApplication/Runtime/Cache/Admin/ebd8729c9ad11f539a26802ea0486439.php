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
                <div><a href="<?php echo U('stockandsale/Checkin/actionEditCheckIn') ?>" type="button" class="btn btn-info">新增入库单</a></div>
                <table class="table table-condensed approveorder-table">
                    <thead>
                    <tr>
                        <th>订单号</th>
                        <th>时间</th>
                        <th>姓名</th>
                        <th>状态</th>
                        <th>操作</th>
                    </tr>
                    </thead>
                    <tbody>

                    <?php if(is_array($dataListFromDb)): foreach($dataListFromDb as $k=>$v): ?><tr>
                            <td><?php echo ($v["order_id"]); ?></td>
                            <td><?php echo date("Y-m-d" , $v['addtime']); ?></td>
                            <td><?php echo ($v["order_realname"]); ?></td>

                            <td>
                                <?php switch($v['status']): case "leader": ?>销售主管审批<?php break;?>
                                    <?php case "chiefleader": ?>销售经理审批<?php break;?>
                                    <?php case "storehouse": ?>库管审批<?php break;?>
                                    <?php case "complete": ?>审批通过<?php break;?>
                                    <?php case "cancel": ?>撤销<?php break;?>
                                    <?php case "retreat": ?>退回<?php break; endswitch;?>

                            </td>
                            <td>
                                <a data-id="<?php echo ($v["order_id"]); ?>" href="javascript:void(0)" class="btn btn-danger">审批</a>
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



<!-- Modal -->
<div class="modal" id="myModal" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" style="position: relative">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                <h4 class="modal-title" id="myModalLabel">订单</h4>
            </div>
            <div class="modal-body">
                <!--<h3>订单基础信息</h3>-->
                <!--<p>姓名:wudan</p>-->
                <!--<p>地址:wudan</p>-->
                <!--<p>电话:wudan</p>-->
                <!--<p>数量:wudan</p>-->
                <!--<p>要求送到时间:wudan</p>-->
                <!--<p>配送方式:wudan</p>-->
                <!--<p>业务员:wudan</p>-->
                <!--<hr>-->
                <!--<h3>订单详情信息</h3>-->
                <!--<h4>订单1</h4>-->
                <!--<p>商品名称:11</p>-->
                <!--<p>单价:11</p>-->
                <!--<p>数量:11</p>-->

                <!--<h4>订单2</h4>-->
                <!--<p>商品名称:11</p>-->
                <!--<p>单价:11</p>-->
                <!--<p>数量:11</p>-->

                <!--<hr>-->
                <!--<h3>审批日志</h3>-->
                <!--<p>同意 审批人：xxx 备注:xxx</p>-->
                <!--<p>同意 审批人：xxx 备注:xxx</p>-->
                <!--<p>同意 审批人：xxx 备注:xxx</p>-->
                <!--<hr>-->
                <!--<h3>审批</h3>-->
                <!--<form>-->


                    <!--<div class="form-group">-->
                        <!--<label class="radio-inline">-->
                            <!--<input type="radio" name="inlineRadioOptions" id="inlineRadio1" value="option1"> 同意-->
                        <!--</label>-->
                        <!--<label class="radio-inline">-->
                            <!--<input type="radio" name="inlineRadioOptions" id="inlineRadio2" value="option2"> 拒绝-->
                        <!--</label>-->
                        <!--<label class="radio-inline">-->
                            <!--<input type="radio" name="inlineRadioOptions" id="inlineRadio3" value="option3"> 撤销-->
                        <!--</label>-->

                    <!--</div>-->
                    <!--<div class="form-group">-->
                        <!--<label for="message-text" class="control-label">备注:</label>-->
                        <!--<textarea class="form-control" id="message-text"></textarea>-->
                    <!--</div>-->
                <!--</form>-->

            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-default submit-btn" data-dismiss="modal">提交</button>
                <button type="button" class="btn btn-primary return-btn">返回</button>
            </div>
        </div>
    </div>
</div>


<script>
    var ApproveOrder = function(){

        var _approveRequestAjax = function(varId){
            $.get('<?php echo U('stockandsale/ApproveOrder/actionRequestService') ?>' , {'type':'show' , 'orderid' : varId} , function(data){

                $('.modal-body').html(data);

            })

        };


        var _initi = function(){
            $('.approveorder-table').on('click' , function(event){
                var obj = $(event.target);
                if(obj.hasClass('btn-danger')){
                    $('#myModal').show();
                    var id= obj.attr('data-id');
                    _approveRequestAjax(id);
                }
            });

            $('.return-btn').on('click' , function(){

                $('#myModal').hide();
            });

            $('.submit-btn').on('click' , function(){

                var id = $('input[name="id"]').val();
                var approveType = $('input[name="approvetype"]:checked').val();
                var remark = $('textarea[name="remark"]').val();
                var expressNum = $('input[name="expressnum"]').val();
                var expressTime = $('input[name="expresstime"]').val();

                var datajson = {
                    'type' : 'submit',
                    'approvetype' : approveType,
                    'remark' : remark,
                    'expressnum' : expressNum,
                    'expresstime' : expressTime,
                    'id' : id



                };

                $.get('<?php echo U('stockandsale/ApproveOrder/actionRequestService') ?>' , datajson , function(data){

                    console.log(data);

                });

            });

        }();


    }();



</script>


</body>
</html>