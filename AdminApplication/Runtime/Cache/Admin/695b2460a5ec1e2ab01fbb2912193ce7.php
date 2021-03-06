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
                    <th>规格</th>
                    <th>商品</th>
                    <th>数量</th>
                    <th>单件毛重</th>
                    <th>入库重量</th>
                    <th>操作</th>
                </tr>
                </thead>
                <tbody>
                </tbody>
            </table>
            <a class="btn btn-success checkin-btn">提交</a>
        </div>
    </div>
</div>
</form>
<script>
    var CheckIn = function(){
        var goodsJson = <?php echo ($dataListFromService['goods']); ?>;
        var checkId = <?php echo ($checkId); ?>;
        var checkInJson = <?php echo ($checkInJson); ?>;
        var dataOfFormat = <?php echo ($dataOfFormat); ?>;

        var _assembSelectHtml = function( nameVal , dataList , selectedVal){
            var html = '';
            for(var k in dataList){
                if(dataList.hasOwnProperty(k)){
                    var tmpSelect = dataList[k][nameVal+'_id'] == selectedVal ? 'selected' : '';
                    html += '<option '+tmpSelect+' value="'+dataList[k][nameVal+'_id']+'">'+dataList[k][nameVal+'_name']+'</option>';
                }
            }
            html ='<select class="form-control" name="'+nameVal+'_id[]">'+html+'</select>';
            return html;
        };

        var _assembFormatSelectHtml = function(nameVal , dataList , selectedVal){
            var html = '';
            for(var k in dataOfFormat){
                if(dataOfFormat.hasOwnProperty(k)){
                    var str = new Array(dataOfFormat[k]['level']).join("--");
                    html += '<option   value="'+dataOfFormat[k]['format_id']+'">'+str+dataOfFormat[k]['format_name']+'</option>';
                }
            }
            html ='<select onchange="CheckIn.selectFormatOnChange(this)" class="form-control formatselect" >'+html+'</select>';
            return html;
        };

        var _assemCheckInGoods = function(){
            var html = '';
            var formatOfSelectHtml = _assembSelectHtml('goods' , goodsJson , null);
            var assembFormatSelectHtml = _assembFormatSelectHtml();
            html = '<tr>' +
                    '<td>'+assembFormatSelectHtml+'</td>' +
                    '<td>'+formatOfSelectHtml+'</td>' +
                    '<td><input class="form-control" name="goodsnum[]"></td>' +
                    '<td><input class="form-control" name="grossweight[]"></td>' +
                    '<td><input class="form-control" name="weight[]"></td>' +
                    '<td><a class="btn btn-info" href="#" >增加</a> <a class="btn btn-danger" href="#" >删除</a></td>' +
                    '</tr>';
            $('.checkin-table tbody').append(html);
        };

        var _selectFormatOnChange = function(obj){
            var formatId = $(obj).val();
            var url = '<?php echo U('stockandsale/Checkin/actionRequestService') ?>';
            $.get(url , {type:'selectformat',formatid:formatId} , function(data){
                var subObj = $(obj).parents('tr').find('select[name="goods_id[]"]');
                try{
                    var goodsList = JSON.parse(data);
                    var html = '';
                    for(var k in goodsList){
                        if(goodsList.hasOwnProperty(k)){
                            html += '<option  value="'+goodsList[k]['goods_id']+'">'+goodsList[k]['goods_name']+'</option>';
                        }
                    }

                }catch (e){
                    alert('系统错误');
                }
                subObj.html(html);
            });
        };

        var _editByCheckIn = function(){
            var html = '';
            for(var k in checkInJson){
                if(checkInJson.hasOwnProperty(k)){
                    var tmpFormatOfSelectHtml = _assembSelectHtml('goods' , goodsJson , checkInJson[k]['goods_id']);
                    var assembFormatSelectHtml = _assembFormatSelectHtml();
                    html += '<tr>' +
                            '<td>'+assembFormatSelectHtml+'</td>' +
                            '<td>'+tmpFormatOfSelectHtml+'</td>' +
                            '<td><input class="form-control" value="'+checkInJson[k]['goodsnum']+'" name="goodsnum[]"></td>' +
                            '<td><input class="form-control" value="'+checkInJson[k]['grossweight']+'" name="grossweight[]"></td>' +
                            '<td><input class="form-control" value="'+checkInJson[k]['weight']+'" name="weight[]"></td>' +
                            '<td><a class="btn btn-info" href="#" >增加</a> <a class="btn btn-danger" href="#" >删除</a></td>' +
                            '</tr>';
                }
            }
            $('.checkin-table tbody').append(html);
        };
        var _initi = function(){
            if(checkId == 0){
                _assemCheckInGoods();
            }else{
                _editByCheckIn();
            }
            $('.checkin-table tbody').on('click' , function(event){
                var targetObj = $(event.target);
                if(targetObj.hasClass('btn-info')){
                    _assemCheckInGoods();
                }else if(targetObj.hasClass('btn-danger')){
                    targetObj.parent().parent().remove();
                }
            });
            $('.checkin-btn').on('click' , function(){
                var dataStrFromForm = $("form").serializeArray();
                var url = '<?php echo U('stockandsale/Checkin/actionRequestService') ?>';
                $.get(url , {type:'checkin',checkin:checkId,data:dataStrFromForm} , function(data){
                    var url = '<?php echo U('stockandsale/Checkin') ?>';
                    window.location.href = url;
                });
            });
        }();

        return {

            selectFormatOnChange : _selectFormatOnChange

        }
    }();



</script>


</body>
</html>