<?php
/**
 * 股票最大收益
 * 使用贪心策略，假设第 i 轮进行卖出操作，买入操作价格应该在 i 之前并且价格最低。
 */
function maxProfit($price) {
    $len = count($price);
    if ($len <= 1) {
        return $price;
    }
    $maxProfit    = 0;
    $sellingPrice = $price[0];
    for ($i = 1; $i < $len; $i++) {
        $sellingPrice = $sellingPrice > $price[$i] ? $price[$i] : $sellingPrice;
        $maxProfit    = $maxProfit > $price[$i] - $sellingPrice ? $maxProfit : $price[$i] - $sellingPrice;
    }
    return $maxProfit;
}

$price = [21,10,45,656,343,655,121,454,1,432,55,121,212,11,34,45,11,3,4,1,243];
//print_r(maxProfit($price));

/**
 * 题目描述
 * 让小朋友们围成一个大圈。然后，随机指定一个数 m，让编号为 0 的小朋友开始报数。每次喊到 m-1 的那个小朋友要出列唱首歌，然后可以在礼品箱中任意的挑选礼物，并且不再回到圈中，从他的下一个小朋友开始，继续 0...m-1 报数 .... 这样下去 .... 直到剩下最后一个小朋友，可以不用表演。
 * 
 * 解题思路
 * 约瑟夫环，圆圈长度为 n 的解可以看成长度为 n-1 的解再加上报数的长度 m。因为是圆圈，所以最后需要对 n 取余。
 */
function LastRemaining_Solution($n, $m) {
    if ($n == 0)     /* 特殊输入的处理 */
        return -1;
    if ($n == 1)     /* 递归返回条件 */
        return 0;
    return (LastRemaining_Solution($n - 1, $m) + $m) % $n;
}

print_r(LastRemaining_Solution(10, 9));






