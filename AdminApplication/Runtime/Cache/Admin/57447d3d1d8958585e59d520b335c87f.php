<?php if (!defined('THINK_PATH')) exit();?><!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Document</title>
</head>
<script src="http://cdn.hcharts.cn/jquery/jquery-1.8.3.min.js"></script>
<script src="http://cdn.hcharts.cn/highcharts/highcharts.js"></script>


<body>

<div id="container" style="min-width:400px;height:400px;"></div>

<script>
    var jsonData = <?php echo ($jsonData); ?>;

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
    // create the chart
    $('#container').highcharts({
        chart: {

        },
        xAxis:{
            title:{
                text:'XXXX年X月X日'
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

//        series: [{
//            name:'客户每月销售量',
//            data: [[1464739200000,10] , [1467331200000 , 20] , [1470009600000 , 30]]
//        },
//        {
//            name:'客xxx',
//            data: [[1464739200000,10] , [1467331200000 , 20] , [1470009600000 , 30]]
//        },
//        ]
        series:newList
    });


</script>


</body>
</html>