<?php
class Concurrency
{
    /**
     * @todo: 获取当前时间 毫秒级
     */
    public function microtime_float()
    {
        list($usec, $sec) = explode(" ", microtime());
        return ((float)$usec + (float)$sec);
    } 	

    public function run()
    {
        $start = $this->microtime_float();	
        $len   = 10;
        $i     = 0;
        while ($i < $len) {
            $pids[$i] = pcntl_fork();   //创建子进程
            if($pids[$i] == 0){
                $pid = posix_getpid(); //获取进程id
                $this->task($i);       //子进程执行代码
                exit(0);
            }
            $i++;
        }
        //等待进程关闭
        for ($i = 0; $i < $len; $i++) {
            pcntl_waitpid($pids[$i], $status, WUNTRACED);
            if(pcntl_wifexited($status)) {
                //进程完成退出
            }
        }
        $end = $this->microtime_float();
        echo "\n执行时间", $end-$start;
    }

    public function task($task_id)
    {
        // if($task_id == 0) {
        //     echo $task_id."\n";
        //     sleep(2);  //模拟任务执行时间 2s
        //     echo '2222'."\n";
        // } else {
        //     echo $task_id."\n";
        //     sleep(3); //模拟任务执行时间 3s
        //     echo '3333'."\n";
        // }
        $start_memory = memory_get_usage();
        $fp = fopen('./test.txt','r');
        $i  = 0;
        // while(!feof($fp)) {
        //     $c = fgets($fp);
        //     $end_memory = memory_get_usage();
        //     $use_memory = $end_memory - $start_memory;
        //     $use_memory = $use_memory/1024/1024;
        //     echo $use_memory . '---' . $task_id . '---' . $i . '---' . $c . "\n";
        //     $i+=1000;
        // }
        if($task_id == 0) {
            while(!feof($fp)) {
                $c = fgets($fp);
                $end_memory = memory_get_usage();
                $use_memory = $end_memory - $start_memory;
                $use_memory = $use_memory/1024/1024;
                echo $use_memory . '---' . $task_id . '---' . $i . '---' . $c . "\n";
                $i+=1000;
            }
        }
    }

    public function splitFile ($file) {
        $i    = 0;                                   //分割的块编号    
        $fp   = fopen($file,"rb");                   //要分割的文件    
        $file = fopen("split_hash.txt","a");         //记录分割的信息的文本文件，实际生产环境存在redis更合适   
        while(!feof($fp)){    
            $handle = fopen("hadoop.{$i}.sql","wb");    
            fwrite($handle,fread($fp,5242880));      //切割的块大小 5m  
            fwrite($file,"hadoop.{$i}.sql\r\n");    
            fclose($handle);    
            unset($handle);    
            $i++;    
        }    
        fclose ($fp);    
        fclose ($file);
    }
}

$con = new Concurrency();
$con->run();