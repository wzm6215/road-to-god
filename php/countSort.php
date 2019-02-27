<?php
function countingSort($arr, $maxValue = null)
{
    if ($maxValue === null) {
        $maxValue = max($arr);
    }
    for ($m = 0; $m < $maxValue + 1; $m++) {
        $bucket[] = null;
    }

    // print_r($bucket);exit;
    $arrLen = count($arr);
    for ($i = 0; $i < $arrLen; $i++) {
        if (!array_key_exists($arr[$i], $bucket)) {
            $bucket[$arr[$i]] = 0;
        }
        $bucket[$arr[$i]]++;
    }
    
    $sortedIndex = 0;
    $res = [];
    foreach ($bucket as $key => $len) {
        if ($len !== null) {
            for ($i = $len; $len > 0; $len--) {
                $res[] = $key;
            }
        }
    }

    return $res;
}

$arr = [12,23,24,12,23,24,1,2,43,14,13,25];
print_r(countingSort($arr));