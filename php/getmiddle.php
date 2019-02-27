<?php
//模拟一个大数组。 
$arr = [];
for($i = 0;$i < 100001; $i++){
     $arr[$i] = rand(1, 9900001);
}

$arr = [1,2,3,4,5,6,7,8,9,10,11,12,13,14,15,16,17];
$middleLen = floor(count($arr) / 2);
$middle    = getMiddle($arr, $middleLen);
echo $middle . PHP_EOL;


function getMiddle($arr , $middleLen)
{ 
    //求出中位数。
    $base = $arr[$middleLen];
    if (count($arr) == 1) { 
        return $base;
    }

    $l_arr = [];
    $r_arr = [];

    for($i =1;$i < sizeof($arr);$i++) {
        if ($arr[$i] < $base) { 
            $l_arr[]= $arr[$i];
        } else {
            //小于的往左边放，大于的往右边放。
            $r_arr[]= $arr[$i];
        }
    }

    if (sizeof($l_arr) == $middleLen -1){
        return $base;
    } else if (sizeof($l_arr) > $middleLen -1){ 
        //左边数组过大
        return getMiddle($l_arr , $middleLen);
    } else {  
        //右边更大.
        $middleLen =  $middleLen - sizeof($l_arr);
        return getMiddle($r_arr , $middleLen);
    }

}