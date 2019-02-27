<?php
function radixSort($arr, $maxDigit = null)
{
    if ($maxDigit === null) {
        $maxDigit = max($arr);
    }
    $counter = [];
    for ($i = 0; $i < $maxDigit; $i++) {
        for ($j = 0; $j < count($arr); $j++) {
            preg_match_all('/\d/', (string) $arr[$j], $matches);
            $numArr = $matches[0];
            $lenTmp = count($numArr);
            $bucket = array_key_exists($lenTmp - $i - 1, $numArr)
                ? intval($numArr[$lenTmp - $i - 1])
                : 0;
            if (!array_key_exists($bucket, $counter)) {
                $counter[$bucket] = [];
            }
            $counter[$bucket][] = $arr[$j];
        }
        $pos = 0;
        for ($j = 0; $j < count($counter); $j++) {
            $value = null;
            if ($counter[$j] !== null) {
                while (($value = array_shift($counter[$j])) !== null) {
                    $arr[$pos++] = $value;
                }
          }
        }
    }

    return $arr;
}