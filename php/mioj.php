<?php
/**
 * Created by PhpStorm.
 * User: wzm
 * Date: 19-2-27
 * Time: 上午9:48
 */

/**
 * 给出三个队列 s1，s2，s3 ，判断 s3 是否是由 s1 和 s2 交叉得来。
 * 如：s1 为 aabcc ， s2 为 dbbca。 当 s3 为 aadbbcbcac 时，返回 true
 * （即将 s1 拆成三部分： aa，bc，c 分别插入 s2 对应位置） 否则返回 false。
 */
function solution($line) {
    // 在此处理单行数据

    // 返回处理后的结果
    // return $ans;
    $arr  = explode(',', $line);
    $s1   = $arr[0];
    $s2   = $arr[1];
    $s3   = $arr[2];
    $len1 = strlen($s1);
    $len2 = strlen($s2);
    $len3 = strlen($s3);

    if ($len3 != $len1 + $len2) {
        return 'false';
    }
    $i1 = 0;
    $i2 = 0;

    for ($i3 = 0; $i3 < $len3; $i3++) {
        $res = false;
        if ($i1 < $len1 && $s1[$i1] == $s3[$i3] && $i2 < $len2 && $s2[$i2] == $s3[$i3]) {
            $case1 = solution(substr($s1, $i1 + 1) . ',' . substr($s2, $i2) . ',' . substr($s3, $i3 + 1));
            $case2 = solution(substr($s1, $i1) . ',' . substr($s2, $i2 + 1) . ',' . substr($s3, $i3 + 1));
            if ($case1 == 'true' || $case2 == 'true') {
                return 'true';
            }
            return 'false';
        }
        if ($i1 < $len1 && $s1[$i1] == $s3[$i3]) {
            $i1++;
            $res = true;
            continue;
        }
        if ($i2 < $len2 && $s2[$i2] == $s3[$i3]) {
            $i2++;
            $res = true;
            continue;
        }
        if (!$res) {
            return 'false';
        }
    }
    return 'true';
}

function solution1($line)
{
    // 在此处理单行数据
    $arr  = explode(',', $line);
    // 返回处理后的结果
    // return $ans;
    $len = count($arr);
    for ($i = 0;$i < $len; $i++) {
        while ($arr[$i] != $i + 1 && $arr[$i] > 0 && $arr[$i] <= $len) {
            if ($arr[$arr[$i] - 1] == $arr[$i]) {
                $arr[$i] = 0;
                break;
            }
            $temp = $arr[$arr[$i] - 1];
            $arr[$arr[$i] - 1] = $arr[$i];
            $arr[$i] = $temp;
        }
    }
    for ($i = 0; $i < $len && $arr[$i] == $i + 1; $i++);

    return $i + 1;
}

/**
 * 移除 K 位得到最小值
 * 有一行由 N 个数字组成的数字字符串，字符串所表示的数是一正整数。移除字符串中的 K 个数字，使剩下的数字是所有可能中最小的。
 *
 */
function solution2($line) {
    // 在此处理单行数据
    $arr  = explode(' ', $line);
    // 返回处理后的结果
    // return $ans;
    $string = $arr[0];
    $k      = $arr[1];
    for ($i = 0; $i < $k; $i++) {
        $hasCut = false;
        for ($j = 0; $j < strlen($string) - 1; $j++) {
            $a = $string[$j];
            $b = $string[$j + 1];
            if ($a > $b) {
                $string = substr($string, 0, $j) . substr($string, $j + 1, strlen($string));
                $hasCut = true;
                break;
            }
        }
        if (!$hasCut) {
            $string = substr($string, 0, strlen($string) -1);
        }
        //去掉左边的0
        $string = ltrim($string, '0');
    }
    if (strlen($string) == 0) {
        return '0';
    }
    return $string;
}

/**
 * 爬楼梯
 * 在你面前有一个n阶的楼梯，你一步只能上1阶或2阶。 请问计算出你可以采用多少种不同的方式爬完这个楼梯。
 */
function solution3($line) {
    $arr[0] = 1;
    $arr[1] = 1;
    for ($i = 2; $i <= $line; $i++) {
        $arr[$i] = $arr[$i - 1] + $arr[$i - 2];
    }
    return $arr[$line];
}

/**
 * 构建短字符串
 * 给定任意一个较短的子串，和另一个较长的字符串，判断短的字符串是否能够由长字符串中的字符组合出来，且长串中的每个字符只能用一次。
 */
function solution4($line) {
    $arr   = explode(' ', $line);
    $short = $arr[0];
    $long  = $arr[1];
    $temp  = '';
    for ($i = 0; $i < strlen($short); $i++) {
        for ($j = 0; $j < strlen($long); $j++) {
            if ($short[$i] == $long[$j]) {
                $long = substr($long, 0, $j) . substr($long, $j + 1, strlen($long));
                $temp .= $short[$i];
            }
        }
    }
    if ($temp == $short) {
        return 'true';
    }
    return 'false';
}

/**
 * 找出可能的合的组合
 *
 *给出一组不重复的正整数，从这组数中找出所有可能的组合使其加合等于一个目标正整数 M，如：
 * 一组数为 1, 2, 3，目标数为 4，那么可能的加合组合为： 1, 1, 1, 1 1, 1, 2 1, 2, 1 1, 3 2, 1, 1 2, 2 3, 1
 * 注意相同的组合数字顺序不同也算一种，所以这个例子的结果是 7 种。
 *
 * 输入样例
 * 1,2,3 4
 */
function solution5($line) {
    $arr = explode(' ', $line);
    $a2  = explode(',', $arr[0]);
}

/**
 * 出现频率最高的前 K 个元素
 *
 *有一个不为空且仅包含正整数的数组，找出其中出现频率最高的前 K 个数，时间复杂度必须在 O(n log n) 以内。
 *
 * 输入样例
 * 1,1,1,2,2,3 2
 */
function solution6($line) {
    $arr    = explode(' ', $line);
    $target = explode(',', $arr[0]);
    $k      = $arr[1];
    $temp   = [];
    for ($i = 0; $i < count($target); $i++) {
        if (isset($temp[$target[$i]])) {
            $temp[$target[$i]] = $temp[$target[$i]] + 1;
        } else {
            $temp[$target[$i]] = 1;
        }
    }
    $queue = new SplPriorityQueue();
    foreach ($temp as $key => $value) {
        $queue->insert($key, $value);
    }
    $res = [];
    for ($j = 0; $j < $k; $j++) {
        $res[] = $queue->current();
        $queue->next();
    }
    return implode(',', $res);
}

/**
 * 在一个有序的经过旋转的数组里查找一个数
 *
 * 假设一个有序的数组，经过未知次数的旋转（例如0 1 2 4 5 6 7 被旋转成 4 5 6 7 0 1 2），从中查找一个目标值，如果存在，返回其下标，不存在，返回-1。
 * 注：假设数组无重复数字
 *
 * 输入样例
 * 4,5,6,7,0,1,2 6
 */
function solution7($line) {

}

/**
 * 和为零的三元组
 * 给出一个整数数组, 数组中是否存在任意 3 个数 a, b, c 满足 a + b + c = 0?
 * 找出数组中所有满足以上条件的三元组，最后输出这些三元组的个数（包含相同元素的三元组只计算一次）。
 *
 * 输入样例
 * -1,0,1,2,-1,-4
 */
function solution8($line) {
    $arr = explode(',', $line);
    sort($arr);
    $len = count($arr);
    $list = [];
    for ($i = 0; $i < $len - 2; $i++) {
        if ($i > 0 && $arr[$i - 1] == $arr[$i]) {
            continue;
        }
        $a    = $arr[$i];
        $low  = $i + 1;
        $high = $len -1;
        while ($low < $high) {
            $b = $arr[$low];
            $c = $arr[$high];

            $temp = [];
            if ($a + $b + $c == 0) {
                $temp[] = $a;
                $temp[] = $b;
                $temp[] = $c;
                $list[] = $temp;
                while ($low < $len - 1 && $arr[$low] == $arr[$low + 1]) {
                    $low++;
                }
                while ($high > 0 && $arr[$high] == $arr[$high - 1]) {
                    $high--;
                }
                $low++;
                $high--;
            } else if ($a + $b + $c > 0) {
                while ($high > 0 && $arr[$high] == $arr[$high - 1]) {
                    $high--;
                }
                $high--;
            } else {
                while ($low < $len - 1 && $arr[$low] == $arr[$low + 1]) {
                    $low++;
                }
                $low++;
            }
        }
    }
    return count($list);
}

/**
 * 实现一个算法，可以进行任意非负整数的加减乘除组合四则运算。
 * 请注意运算符的优先级。
 */

function solution16($line) {

}

/**
 * 实现一个算法，可以将小写数字转换成大写数字。
 */

function solution17($line) {
//https://blog.csdn.net/liubingzhao/article/details/53448928
}

$test = '-1,0,1,2,-1,-4';
$res = solution8($test);
var_dump($res);

