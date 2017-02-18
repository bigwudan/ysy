<?php if (!defined('THINK_PATH')) exit();?><!DOCTYPE html>
<html>
<head>
	<meta charset="UTF-8">
	<meta name="viewport" content="width=device-width,initial-scale=1,minimum-scale=1,maximum-scale=1,user-scalable=no" />
	<link rel="stylesheet" type="text/css" href="/myysy/Public/Dingtalk/Css/Dingtalkapprovecenter/approve.css"/>
	<script src="/myysy/Public/Dingtalk/Js/zepto.min.js" type="text/javascript" charset="utf-8"></script>
	<title></title>
</head>
<body>
<div class="main">
	<div class="clearfix tab-top">
		<p class="fl w50 ftc pt10 pb10 tabblue">我发起的</p>
		<!--<p class="fr w50 ftc pt10 pb10">我已审批的</p>-->
	</div>
	<div class="tab-box bgfff">
		<?php if(is_array($approveList)): foreach($approveList as $k=>$v): ?><div class="tabone pl10">
				<a href="<?php echo U('ApproveCenter/ApproveCenter/actionApproveInfo'); ?>?id=<?php echo ($v['order_id']); ?>&type=show" class="bbt pt10 pb10 pr10 clearfix block">
					<div class="fl ell-width">
						<p class="ellipsis ft14"><?php echo ($v['order_realname']); ?>的申请</p>
						<p class="c999 ft12"><?php echo (date("Y-m-d H:i:s",$v['addtime'])); ?></p>
					</div>
					<p class="fr orange ft16 pt10">
						<?php switch($v['status']): case "leader": ?>销售主管审批<?php break;?>
							<?php case "chiefleader": ?>销售经理审批<?php break;?>
							<?php case "cancel": ?>撤销<?php break;?>
							<?php case "retreat": ?>退回<?php break; endswitch;?>
					</p>
				</a>
			</div><?php endforeach; endif; ?>

	</div>
</div>
</body>
<script type="text/javascript">
	$(".tab-top p").bind('tap',function(){
		$(this).addClass("tabblue").siblings().removeClass('tabblue');
		var index=$(".tab-top p").index(this);
		$(".tab-box .tabone").eq(index).show().siblings().hide();
	})
</script>
</html>