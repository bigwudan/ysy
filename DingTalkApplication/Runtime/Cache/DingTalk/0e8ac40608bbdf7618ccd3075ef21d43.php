<?php if (!defined('THINK_PATH')) exit();?><!DOCTYPE html>
<html>
	<head>
		<meta charset="UTF-8">
		<meta name="viewport" content="width=device-width,initial-scale=1,minimum-scale=1,maximum-scale=1,user-scalable=no" />
		<link rel="stylesheet" type="text/css" href="/myysy/Public/Dingtalk/Css/Dingtalkapprovecenter/approve.css"/>

        <link rel="stylesheet" type="text/css" href="/myysy/Public/Dingtalk/Css/weui.css"/>
        <title></title>
	</head>
	<script src="/myysy/Public/Dingtalk/Js/zepto.min.js" type="text/javascript" charset="utf-8"></script>
	<body>

		<div class="main operation-div hide">
			<!--<textarea name="" placeholder="请输入同意/不同意理由" rows="" cols="" class="pad15 ft14 c333 w100 block bbt" ></textarea>-->
            <form id="approve">
                <input value="<?php echo ($orderBase['orderId']); ?>" name="orderid"  type="hidden">
                <input value="" name="approvetype" type="hidden">

                <div class="weui-cells__title">审批意见</div>
                <div class="weui-cells weui-cells_form">
                    <div class="weui-cell">
                        <div class="weui-cell__bd">
                            <textarea name="remark" class="weui-textarea" placeholder="请输入文本" rows="3"></textarea>
                            <div class="weui-textarea-counter"><span>0</span>/200</div>
                        </div>
                    </div>
                </div>
            </form>

		</div>

		<div class="main applyinfo">
			<div class="pl10 bgfff bbt">
				<a href="" class="bbt pt10 pb10 pr10 clearfix block">
					<div class="fl ell-width">
						<p class="ellipsis ft15"><?php echo ($orderBase['realname']); ?>的申请</p>
						<p class="c999 ft12"><?php echo (date("Y-m-d H:i:s",$orderBase['addtime'])); ?></p>
					</div>
					<p class="fr orange ft16 pt10">
						<?php switch($orderBase['status']): case "leader": ?>销售主管审批<?php break;?>
							<?php case "chiefleader": ?>销售经理审批<?php break;?>
							<?php case "cancel": ?>撤销<?php break;?>
							<?php case "retreat": ?>退回<?php break; endswitch;?>
					</p>
				</a>
				<div class="pt10 pb10 pr10">
					<?php if(is_array($orderInfo)): foreach($orderInfo as $k=>$v): ?><div class="clearfix mb5">
							<p class="c949f dib fl ft14">(<?php echo ($k+1); ?>)订单明细</p>

						</div>
						<div class="clearfix mb5">
							<p class="c949f dib fl ft14">名称：</p>
							<p class="ft14 information"><?php echo ($v['packagename']); ?></p>
						</div>
						<div class="clearfix mb5">
							<p class="c949f dib fl ft14">订单类型：</p>
							<p class="ft14 information"> <?php echo ($orderType[$v['ordertype']]); ?></p>
						</div>

						<div class="clearfix mb5">
							<p class="c949f dib fl ft14">价格：</p>
							<p class="ft14 information"> <?php echo ($v['price']); ?></p>
						</div>
						<div class="clearfix mb5">
							<p class="c949f dib fl ft14">数量：</p>
							<p class="ft14 information"><?php echo ($v['num']); ?></p>
						</div><?php endforeach; endif; ?>
				</div>
			</div>
			<div class="pl20 mb60">
				<!--<div class="bleft rela pt15 pr20 pl15">-->
					<!--<img src="/myysy/Public/Dingtalk/Img/Dingtalkapprovecenter/aply2.png" width="20px" height="20px" class="typeico abs"/>-->
					<!--<div class="b-all round5 bgfff pad10 clearfix">-->
						<!--<img src="/myysy/Public/Dingtalk/Img/Dingtalkapprovecenter/aply2.png" width="50px" height="50px" class="fl dib round30"/>-->
						<!--<div class="ml60">-->
							<!--<p class="ft15 mt5">黄思琪</p>-->
							<!--<p class="cgreen ft14">发起申请</p>-->
						<!--</div>-->
					<!--</div>-->
				<!--</div>-->
				<!--<div class="bleft rela pt15 pr20 pl15">-->
					<!--<img src="/myysy/Public/Dingtalk/Img/Dingtalkapprovecenter/aply2.png" width="20px" height="20px" class="typeico abs"/>-->
					<!--<div class="b-all round5 bgfff pad10 clearfix">-->
						<!--<img src="/myysy/Public/Dingtalk/Img/Dingtalkapprovecenter/aply2.png" width="50px" height="50px" class="fl dib round30"/>-->
						<!--<div class="ml60">-->
							<!--<p class="ft15 mt5">黄思琪</p>-->
							<!--<p class="cred ft14">已拒绝<span class="c999">(留言留言留言留言留言留言留言留言留言留言)</span></p>-->
						<!--</div>-->
					<!--</div>-->
				<!--</div>-->
				<?php if(is_array($log)): foreach($log as $k=>$v): ?><div class="bleft rela pt15 pr20 pl15">
						<img src="/myysy/Public/Dingtalk/Img/Dingtalkapprovecenter/aply2.png" width="20px" height="20px" class="typeico abs"/>
						<div class="b-all round5 bgfff pad10 clearfix">
							<img src="/myysy/Public/Dingtalk/Img/Dingtalkapprovecenter/aply2.png" width="50px" height="50px" class="fl dib round30"/>
							<div class="ml60">
								<p class="ft15 mt5"><?php echo ($v['realname']); ?></p>
								<p class="cred ft14">
									<?php switch($v['nodename']): case "cancel": ?>撤销<?php break;?>
										<?php case "retreat": ?>退回<?php break;?>
										<?php default: ?>同意<?php endswitch;?>
									<span class="c999">(<?php echo ($v['remark']); ?>)</span>
								</p>
							</div>
						</div>
					</div><?php endforeach; endif; ?>
			</div>
		</div>



		<?php if($type == 'show' ): else: ?>
			<div class="weui-navbar" style="position: fixed;bottom: 0;top:auto">
				<div data-type="agree" class="weui-navbar__item">同意</div>
				<div data-type="disagree" class="weui-navbar__item">拒绝</div>
				<div data-type="cancel" class="weui-navbar__item">撤销</div>
			</div><?php endif; ?>




	<script>


        var ApproveInfo = function(){
            var _showApprove = function(type){
                var showBarHtml = '<div data-type="agree" class="weui-navbar__item">同意</div><div data-type="disagree" class="weui-navbar__item">拒绝</div><div data-type="cancel" class="weui-navbar__item">撤销</div>';
                var hideBarHtml = '<div data-type="submit" class="weui-navbar__item">提交</div><div data-type="return" class="weui-navbar__item">返回</div>';
                if(type == 'show'){
                    $('.operation-div').show();
                    $('.applyinfo').hide();
                    $('.weui-navbar').html(hideBarHtml);
                }else{
                    $('.operation-div').hide();
                    $('.applyinfo').show();
                    $('.weui-navbar').html(showBarHtml);
                }
            };

            var _sumbitApprove = function(){
                var id = $('input[name="orderid"]').val();
                var approvetype = $('input[name="approvetype"]').val();
                var remark = $('textarea[name="remark"]').val();
                $.get('<?php echo U('ApproveCenter/ApproveCenter/actionApproveService') ?>',{id:id , approvetype : approvetype , remark :  remark},function(responseData){

                    console.log(responseData);

                });

                console.log(dataStrFromForm);

            };

            var _initi = function(){
                $('.weui-navbar').on('click' , function(ev){
                    var dataOfType = $(ev.target).attr('data-type');
                    if(dataOfType == 'agree' || dataOfType == 'disagree' || dataOfType == 'cancel'){
                        $('input[name="approvetype"]').val(dataOfType);
                        _showApprove('show');
                    }else if(dataOfType == 'return'){
                        _showApprove('hide');
                    }else if(dataOfType == 'submit'){
                        _sumbitApprove();
                    }
                });
            }();
        }();




	</script>

	</body>
</html>