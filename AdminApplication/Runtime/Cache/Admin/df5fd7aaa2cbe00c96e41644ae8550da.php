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

<div class="container-fluid">
    <div class="row">
        <?php echo ($body['sider']); ?>
        <div class="col-md-10">
            <form id="checkin-form" class="form-horizontal">
            <div class="form-group">
                <label for="inputEmail3" class="col-sm-2 control-label">名称</label>
                <div class="col-sm-10">
                    <input name="packagename" value="<?php echo ($goodsPackeageFromDb[0]['packagename']); ?>"  class="form-control" id="inputEmail3" placeholder="名称">
                </div>
            </div>

            <div class="form-group">
                <label for="inputEmail3" class="col-sm-2 control-label">备注</label>
                <div class="col-sm-10">
                    <textarea name="remark"  class="form-control" rows="3"><?php echo ($goodsPackeageFromDb[0]['remark']); ?></textarea>
                </div>
            </div>

            <div class="form-group">
                <label for="inputEmail3" class="col-sm-2 control-label">订单价格</label>
                <div class="col-sm-10">
                    <div class="row">
                        <div class="input-group">
                            <?php if(is_array($orderType)): foreach($orderType as $k=>$vo): ?><div class="input-group">
                                    <span class="input-group-addon"><?php echo ($vo[0]); ?></span>
                                    <input type="text" name="packageprice-<?php echo ($k); ?>" class="form-control" value="<?php echo ($goodsPackeagePriceFromDb[$k]['price']); ?>" >
                                </div><?php endforeach; endif; ?>
                        </div>
                    </div>

                </div>
            </div>

                <div class="form-group">
                    <label for="inputEmail3" class="col-sm-2 control-label">商品组合</label>
                    <div class="col-sm-10">
                        <div class="row">
                            <table class="table goods-table packinfo-table">
                                <thead>
                                <tr>
                                    <th>商品名</th>
                                    <th>数量</th>
                                    <th>操作</th>
                                </tr>
                                </thead>
                                <tbody>

                                </tbody>
                            </table>
                        </div>

                    </div>

                    <label for="inputEmail3" class="col-sm-2 control-label">包装组合</label>
                    <div class="col-sm-10">
                        <div class="row">
                            <table class="table pack-table packinfo-table">
                                <thead>
                                <tr>
                                    <th>包装名称</th>
                                    <th>数量</th>
                                    <th>操作</th>
                                </tr>
                                </thead>
                                <tbody>

                                </tbody>
                            </table>
                        </div>

                    </div>


                </div>


            </form>
            <a class="btn btn-success checkin-btn" >提交</a>
        </div>
    </div>
</div>

<script>
var GoodsPackage = function(){
    var _goodsJson = <?php echo ($goodsJson); ?>;
    var _goodsPackeageJson = <?php echo ($goodsPackeageJson); ?>;
    var _packageId = <?php echo ($packageId); ?>;


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
    var _assemGoods = function(varFormType){
        var html = '';
        var formatOfSelectHtml = _assembSelectHtml('goods' , _goodsJson[varFormType] , null);
        html = '<tr>' +
                '<td>'+formatOfSelectHtml+'</td>' +

                '<td><input class="form-control" name="num[]"></td>' +

                '<td><a data-type="'+varFormType+'" class="btn btn-info" href="#" >增加</a> <a class="btn btn-danger" href="#" >删除</a></td>' +
                '</tr>';
        $('.'+varFormType+'-table tbody').append(html);
    };


    var _goodsPackeageHtml = function(varType){
        var html = '';
        var packInfoList = _goodsPackeageJson[varType];


        for(var k in packInfoList){
            if(packInfoList.hasOwnProperty(k)){
                var formatOfSelectHtml = _assembSelectHtml('goods' , _goodsJson[varType] , packInfoList[k]['goods_id']);
                html += '<tr>' +
                '<td>'+formatOfSelectHtml+'</td>' +

                '<td><input value="'+packInfoList[k]['num']+'" class="form-control" name="num[]"></td>' +

                '<td><a class="btn btn-info" href="#" >增加</a> <a class="btn btn-danger" href="#" >删除</a></td>' +
                '</tr>';
            }
        }
        $('.'+varType+'-table tbody').append(html);
    };

    var _initi = function(){

        if(_goodsPackeageJson){
            if(_goodsPackeageJson['goods']){
                _goodsPackeageHtml('goods')
            }else{
                _assemGoods('goods');
            }

            if(_goodsPackeageJson['pack']){
                _goodsPackeageHtml('pack')
            }else{
                _assemGoods('pack');
            }


        }else{
            _assemGoods('goods');
            _assemGoods('pack');
        }



        $('.packinfo-table tbody').on('click' , function(event){
            var targetObj = $(event.target);
            if(targetObj.hasClass('btn-info')){
                _assemGoods(targetObj.attr('data-type'));
            }else if(targetObj.hasClass('btn-danger')){
                targetObj.parent().parent().remove();
            }
        });

        $('.checkin-btn').on('click' , function(){
            var dataStrFromForm = $("form").serializeArray();
            var url = '<?php echo U('stockandsale/Goodspackage/actionRequestService') ?>';
            $.get(url , {type:'package' , packageid : _packageId ,data:dataStrFromForm} , function(data){
                window.location.href = '<?php echo U('stockandsale/Goodspackage') ?>';
            });

        });

    }();


}();


</script>


</body>
</html>