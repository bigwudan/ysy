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

	<div id="loadingToast" style="opacity: 0; display: none;">
		<div class="weui-mask_transparent"></div>
		<div class="weui-toast">
			<!--<i class="weui-loading weui-icon_toast"></i>-->
			<!--<i class="weui-icon-cancel font84"></i>-->
			<i class="weui-loading weui-icon_toast"></i>
			<p class="weui-toast__content">数据加载中</p>
		</div>
	</div>

		<div class="main">
			<div class="clearfix tab-top">
				<p class="fl w50 ftc pt10 pb10 tabblue">待我审批的</p>
				<!--<p class="fr w50 ftc pt10 pb10">我已审批的</p>-->
			</div>
			<div class="tab-box bgfff">
				<?php if(is_array($approveList)): foreach($approveList as $k=>$v): ?><div class="tabone pl10">
						<a href="<?php echo U('ApproveCenter/ApproveCenter/actionApproveInfo'); ?>?id=<?php echo ($v['order_id']); ?>" class="bbt pt10 pb10 pr10 clearfix block">
							<div class="fl ell-width">
								<p class="ellipsis ft14"><?php echo ($v['order_realname']); ?>的申请</p>
								<p class="c999 ft12"><?php echo (date("Y-m-d H:i:s",$v['addtime'])); ?></p>
							</div>
							<p class="fr orange ft16 pt10">
								<?php switch($v['status']): case "leader": ?>销售主管审批<?php break;?>
									<?php case "chiefleader": ?>销售经理审批<?php break;?>
									<?php case "storehouse": ?>库管审批<?php break;?>
									<?php case "complete": ?>审批通过<?php break;?>
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
		});
		//提示框
		var _promptBox = function(varType , varMsg){
			if(varType == 'showLoading'){
				$('#loadingToast i').attr('class','weui-loading weui-icon_toast');
				$('#loadingToast .weui-toast__content').html('加载中');
				$('#loadingToast').css({'opacity':1 , 'display':'block'});
			}else if(varType == 'hide'){
				$('#loadingToast').css({'opacity':0 , 'display':'none'});
				$('#loadingToast i').attr('class','weui-loading weui-icon_toast');
				$('#loadingToast .weui-toast__content').html('加载中');
			}else if(varType == 'warm'){
				$('#loadingToast i').attr('class' , 'weui-icon-cancel font84');
				$('#loadingToast .weui-toast__content').html(varMsg);
			}

		};


		var WaitOfMyApprove = function(){
			var _curPage = 0; //
			var _pageFun = function(){

				if($('.tabone').length <= 10 ){
					return true;
				}else{
					var selectJson = {
						type:'showwaitofmyapprove',
						pagenum : _curPage
					};
					var href="<?php echo U('ApproveCenter/ApproveCenter/actionRequestService'); ?>";
					_promptBox('showLoading');
					$.get(href , selectJson , function(response){
						_curPage += 10;
						$('.tab-box').append(response);
						_promptBox('hide');
					});
					//$('.tab-box').append('<11>');
				}
			};

			var _intit = function(){
				$(window).scroll(function(){
					var totalheight = parseFloat($(window).height()) + parseFloat($(window).scrollTop());
					if(($(document).height()) <= totalheight) {
						WaitOfMyApprove();
					}
				});

			}();

			return {

				test:_pageFun
			}


		}();



	</script>
</html>