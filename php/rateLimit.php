<?php
namespace Api\Lib;

/**
 * 限流控制
 */
class RateLimit
{
    private $minNum = 60;    //单个用户每分访问数
    private $dayNum = 10000; //单个用户每天总的访问量

    public function minLimit($uid)
    {
        $minNumKey = $uid . '_minNum';
        $dayNumKey = $uid . '_dayNum';
        $resMin    = $this->getRedis($minNumKey, $this->minNum, 60);
        $resDay    = $this->getRedis($minNumKey, $this->minNum, 86400);
        if (!$resMin['status'] || !$resDay['status']) {
            exit($resMin['msg'] . $resDay['msg']);
        }
    }

    public function getRedis($key, $initNum, $expire)
    {
        $nowtime  = time();
        $result   = ['status' => true, 'msg' => ''];
        $redisObj = $this->di->get('redis');
        $redis->watch($key);
        $limitVal = $redis->get($key);
        if ($limitVal) {
            $limitVal = json_decode($limitVal, true);
            $newNum   = min($initNum, ($limitVal['num'] - 1) + (($initNum / $expire) * ($nowtime - $limitVal['time'])));
            if ($newNum > 0) {
                $redisVal = json_encode(['num' => $newNum, 'time' => time()]);
            } else {
                return ['status' => false, 'msg' => '当前时刻令牌消耗完！'];
            }
        } else {
            $redisVal = json_encode(['num' => $initNum, 'time' => time()]);
        }
        $redis->multi();
        $redis->set($key, $redisVal);
        $rob_result = $redis->exec();
        if (!$rob_result) {
            $result = ['status' => false, 'msg' => '访问频次过多！'];
        }
        return $result;
    }
}