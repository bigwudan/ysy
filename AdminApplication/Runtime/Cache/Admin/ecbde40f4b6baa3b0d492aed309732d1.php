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
<script src="http://cdn.hcharts.cn/highcharts/highcharts.js"></script>
<body>

<style>

    .select-type{
        display: inline-block;
        height: 34px;


    }


</style>

<?php echo ($body['head']); ?>
<div class="container-fluid">
    <div class="row">
        <?php echo ($body['sider']); ?>
        <div class="col-md-10">
            <button name="btn-input" type="button" class="btn btn-info pull-right">搜索</button>
            <div class="btn-group" data-toggle="buttons">
                <?php if(is_array($goodStyle)): foreach($goodStyle as $k=>$vo): ?><label class="btn btn-primary">
                        <input name="goodstyle" value="<?php echo ($vo['goodsstyle']); ?>"  type="checkbox" autocomplete="off" ><?php echo ($vo['goodsname']); ?>-<?php echo ($vo['goodsstyle']); ?>
                    </label><?php endforeach; endif; ?>
            </div>
            <select name="type" class="select-type">
                <option value="1">销量</option>
                <option value="0">销售额</option>
            </select>

            <div id="container" style="min-width:400px;height:400px;"></div>
        </div>
    </div>

</div>
<script>
    var MyGoodStyle = function(){
        var initi = function(){
            $('button[name="btn-input"]').on('click' , function(){
                var styleList = [];
                $('input[name="goodstyle"]:checked').each(function(){
                    styleList.push($(this).val());
                });


                styleList = JSON.stringify(styleList);
                var type = $('select[name="type"]').val();
                $.get('<?php echo U('Statistics/Goodsstylestatistics/goodStyleAjax') ?>', {data:styleList,type:type} ,function(data){
                    var jsonData = JSON.parse(data);
                    var newList = [];
                    var num = 0;
                    for(var k in jsonData){
                        if(jsonData.hasOwnProperty(k)){
                            var tmpList = [];
                            for(var k1 in jsonData[k]){
                                if(jsonData[k].hasOwnProperty(k1)){
                                    var tmpK1List = k1.split('-');
                                    tmpK1List = Date.UTC(tmpK1List[0],tmpK1List[1]-1,1);
                                    tmpList.push([tmpK1List , jsonData[k][k1]]);
                                }
                            }
                            num ++;
                            newList.push({name:k,data:tmpList});
                        }
                    }
                    if(type == 1){
                        $('#container').highcharts({
                            title: {
                                text: '商品规格'
                            },
                            xAxis:{
                                title:{
                                    text:''
                                },
                                tickInterval:30*24 * 3600 * 1000,
                                type: 'datetime',
                                dateTimeLabelFormats:{
                                    millisecond:"%H:%M:%S.%L",
                                    second:"%H:%M:%S",
                                    minute:"%H:%M",
                                    hour:"%H:%M",
                                    day:"%m月%d日",
                                    week:"w-%m-%d",
                                    month:"%Y-%m",
                                    year:"%Y"
                                }
                            },
                            yAxis:{
                                title:{
                                    text:'销量'
                                },
                            } ,
                            tooltip:{
                                dateTimeLabelFormats:{
                                    millisecond:"%H:%M:%S.%L",
                                    second:"%H:%M:%S",
                                    minute:"%H:%M",
                                    hour:"4%H:4%M",
                                    day:"%Y-%m-%d",
                                    week:"%m-%d",
                                    month:"%Y-%m",
                                    year:"%Y"
                                }
                            },
                            series:newList
                        });
                    }else{
                        $('#container').highcharts({
                            title: {
                                text: '商品规格'
                            },
                            xAxis:{
                                title:{
                                    text:''
                                },
                                tickInterval:30*24 * 3600 * 1000,
                                type: 'datetime',
                                dateTimeLabelFormats:{
                                    millisecond:"%H:%M:%S.%L",
                                    second:"%H:%M:%S",
                                    minute:"%H:%M",
                                    hour:"%H:%M",
                                    day:"%m月%d日",
                                    week:"w-%m-%d",
                                    month:"%Y-%m",
                                    year:"%Y"
                                }
                            },
                            yAxis:{
                                title:{
                                    text:'销量额'
                                },
                            } ,
                            tooltip:{
                                dateTimeLabelFormats:{
                                    millisecond:"%H:%M:%S.%L",
                                    second:"%H:%M:%S",
                                    minute:"%H:%M",
                                    hour:"4%H:4%M",
                                    day:"%Y-%m-%d",
                                    week:"%m-%d",
                                    month:"%Y-%m",
                                    year:"%Y"
                                }
                            },
                            series:newList
                        });
                    }
                });
            });

        }();

    }();

</script>



</body>
</html>