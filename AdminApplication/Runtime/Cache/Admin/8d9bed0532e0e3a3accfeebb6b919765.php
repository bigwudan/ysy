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
            <select name="goodsname">
            <?php if(is_array($goodsname)): foreach($goodsname as $k=>$vo): ?><option value="<?php echo ($vo['goodsname']); ?>"><?php echo ($vo['goodsname']); ?></option><?php endforeach; endif; ?>
            </select>
            <button name="btn-input" type="button" class="btn btn-info pull-right">搜索</button>
            <div id="container" style="min-width:400px;height:400px;"></div>
        </div>
    </div>

</div>
<script>
    var chart = Highcharts.chart('container', {
        chart: {
            type: 'column'
        },
        title: {
            text: '销售排名'
        },

        xAxis: {
            categories: ['Apples', 'Bananas', 'Oranges']
        },
        yAxis: {
        },
        series: [{
            name:'wudan',
            data: [2, 3, 4]
        }]
    });

    var testFun = function(){

        chart.series[0].update({
            name:'1111',
            data: [11, 55, 88]
        });

        //chart.series[0].setData([7, 8, 9,10]);
    };

    var MyChart = function(){


        var _research = function(){
            var goodsName = $('select[name="goodsname"]').val();

            var url = '<?php echo U('Statistics/Singlegoodstatistics/actionAjaxFactory') ?>';

            $.get(url , {mode:1,data:goodsName} , function(data){
                var dataJson = JSON.parse(data);
                var category = [];
                var seriesData = [];
                for(var k in dataJson){
                    if(dataJson.hasOwnProperty(k)){
                        category.push(dataJson[k].customername);
                        seriesData.push(parseInt(dataJson[k].goodsum));
                    }
                }

                console.log(seriesData);

                chart.xAxis[0].setCategories(category);

                chart.series[0].update({
                    name:goodsName,
                    data: seriesData
                });

            });


        };

        var _initi = function(){
            $('.pull-right').on('click' , _research)

        }();


    }();



</script>



</body>
</html>