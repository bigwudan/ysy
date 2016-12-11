<?php if (!defined('THINK_PATH')) exit();?><!doctype html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, maximum-scale=1, user-scalable=no">
    <title>Document</title>
</head>
<link href="//cdn.bootcss.com/bootstrap/3.3.5/css/bootstrap.min.css" rel="stylesheet">
<script src="//cdn.bootcss.com/jquery/1.11.3/jquery.min.js"></script>
<script src="/myysy/Public/Js/jquery-ui-1.10.3.min.js"></script>
<script src="//cdn.bootcss.com/bootstrap/3.3.5/js/bootstrap.min.js"></script>
<body>
<?php echo ($body['head']); ?>
<div class="container-fluid">
    <div class="row">
        <?php echo ($body['sider']); ?>
        <div class="col-md-10">

        </div>
    </div>

</div>
<script>
    $(function() {
        $( "#sortable" ).sortable({
            handle: ".btn",
            forcePlaceholderSize: true,
            zIndex: 999999
        });
        $( "#sortable" ).disableSelection();
    });
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