<?php
function buildMaxHeap(&$arr)
{
    $len = count($arr);
    for ($i = floor($len / 2); $i >= 0; $i--) {
        heapify($arr, $i, $len);
        print_r($arr);
    }
}

function heapify(&$arr, $i, $len)
{
    $left    = 2 * $i + 1;
    $right   = 2 * $i + 2;
    $largest = $i;

    if ($left < $len && $arr[$left] > $arr[$largest]) {
        $largest = $left;
    }

    if ($right < $len && $arr[$right] > $arr[$largest]) {
        $largest = $right;
    }

    if ($largest != $i) {
        swap($arr, $i, $largest);
        heapify($arr, $largest, $len);
    }
}

function swap(&$arr, $i, $j)
{
    $temp    = $arr[$i];
    $arr[$i] = $arr[$j];
    $arr[$j] = $temp;
}

function heapSort($arr) {
    $len = count($arr);
    buildMaxHeap($arr);
    //print_r($arr);exit;
    for ($i = count($arr) - 1; $i > 0; $i--) {
        swap($arr, 0, $i);
        $len--;
        heapify($arr, 0, $len);
    }
    return $arr;
}

$arr = [12,23,24,1,2,43,14,13,25];
print_r(heapSort($arr));