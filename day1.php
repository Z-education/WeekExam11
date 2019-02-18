<?php

/*
 * 编写一个程序，实现1+2+3+...+100的和：普通算法
 * @param intval $man 求从1加到max的和
 */
function sumnm($max){
    $sum = 0;   //1
    
    for($i = 1; $i <= $max; $i++){
        $sum += $i; //设置的循环次数为 n，那么这个算法循环的总次数就是n
    }
    return $sum; //1
}
/*
 * 递归算法
 * 递归：函数内部调用函数本身，就是递归调用
 */
function sumnm2($max, $i = 1, $sum = 0){
    if($i > $max){
        return $sum;
    }else{
        $sum += $i;
        $i++;
        return sumnm2($max, $i, $sum);
    }
}

//时间复杂度：根据输入的数据的大小增长而增长的量级，用 O(); 这个算法循环了n次，那么这个算法的时间复杂度就是 O(n)
// 1+1+n = 2+n = n ：在时间复杂度的计算中，常数是被忽略掉的
//空间复杂度：根据数据的数据的大小增长而增长的空间占用的量级；也用O()来表示
//三个变量：($max + $sum + $i) = 1+1+1 = 3 = 1; 这个复杂度就是为 O(1)
function sumnm3($max){
    $arr = range(1, $max);
    return array_sum($arr);
}
//echo sumnm3(100);


function jc($n){
    $sum = $n; //1
    for($i = 1; $i < $n; $i++){
        $sum *= ($n - $i); // n-1
    }
    return $sum; //1
}
//时间复杂度：1 + n -1 + 1 = 1 + n = n = O(n);

function hw1($str){
    $rev = '';
    for($i = strlen($str) - 1; $i >= 0; $i--){
        $rev .= $str[$i];
    }
    return $str == $rev;
}
function hw2($str){
    $arr = [];
    for($i = strlen($str) - 1; $i >= 0; $i--){
        $arr[] = $str[$i];
    }
    for($i = 0; $i < strlen($str); $i++){
        if($arr[$i] != $str[$i]){
            return false;
        }
    }
    return true;
}

function hw3($str){
    $len = strlen($str);
    $start = 0;
    $end = $len - 1;
    $count = floor($len / 2);
    for($i = 0; $i < $count; $i++){
        if($str[$start] == $str[$end]){
            $start++;
            $end--;
        }else{
            return false;
        }
    }
    return true;
}

//冒泡排序
function sort1($arr){
    $len = count($arr);
    for($i = 1; $i <= $len; $i++){
        for($k = 0; $k < $len - $i; $k++){
            if($arr[$k] > $arr[$k + 1]){
                $arr[$k] = $arr[$k] ^ $arr[$k + 1];
                $arr[$k + 1] = $arr[$k] ^ $arr[$k + 1];
                $arr[$k] = $arr[$k] ^ $arr[$k + 1];
            }
            $_GET['n']++;
        }
    }
    return $arr;
}

//快速排序
function sort2($arr){
    //获取数组的长度
    $count = count($arr);
    if($count <= 1){
        //如果数组长度小于等于1，不需要排序，直接返回
        return $arr;
    }
    //取出数组中的一个中间值，作为判断的条件
    $middle = $arr[0];
    $left = [];//left数组存储比中间值小的值
    $right = [];//right数组存储比中间值大的值
    for($i = 1; $i < $count; $i++){
        if($arr[$i] > $middle){
            //如果当前值大于中间值，放入right
            $right[] = $arr[$i];
        }else{
            //否则就是小于或者等于，放入left
            $left[] = $arr[$i];
        }
    }
    $left = sort2($left);//将left数组再次调用这个方法，对left数组中的元素今次再次的处理
    $right = sort2($right);
    //将处理好的数组合并并返回
    return array_merge($left, [$middle], $right);
    
}

/*
 * 银行柜台，统计平均等待时间
 * @param array $active_time 用户到达银行的时间
 * @param array $process_time 每一个用户办理业务所需要的时间
 */
function bank($active_time, $process_time){
    //创建窗口
    $windows = [];
    $number = count($active_time);
    $wait_time = 0;
    for($i = 0; $i < $number; $i++){
        if(count($windows) < 4){
            //如果当前窗口有空余，直接将用户离开的时间存入窗口
            $windows[] = $active_time[$i] + $process_time[$i];
            continue;
        }
        sort($windows);//将用户离开的时间从小到大进行排序
        $bye_user = array_shift($windows);//取出最先离开的用户时间
        if($bye_user > $active_time[$i]){
            //如果离开的用户的时间 大于 下一个用户到达的时间
            //用柜台用户的时间 减去 下一个用户到达的时间，得到等待的时间
            $wait_time += $bye_user - $active_time[$i];
            //将新到达的用户的离开时间 放入窗口
            $now_user_time = $bye_user + $process_time[$i];
        }else{
            $now_user_time = $active_time[$i] + $process_time[$i];
        }
        $windows[] = $now_user_time;
    }
    return $wait_time / $number;
}
//bank([
//    9.05, 9.10, 9.11, 9.15, 9.20, 9.30
//],[
//    0.30, 0.15, 0.28, 0.36, 0.40, 0.12
//]);

function func($number){
    $list = range('a', 'z');
    $count = count($list);
    $arr = [];
    while($number){
        $tmp = floor($number / $count); //商
        $rem = $number % $count;    //余数
        if($rem == 0){
            //如果余数等于0，商减一
            $tmp--;
            //当前余数对应字母直接为z
            array_unshift($arr, $list[$count - 1]);
        }else{
            //正常获取当前余数所对应的字母
            array_unshift($arr, $list[$rem - 1]);
        }
        //更新条件，计算下一位的字母
        $number = $tmp;
    }
    echo implode('', $arr);
}

function fbnq($n){
    $arr = [];
    for($i = 0; $i < $n; $i++){
        if(count($arr) < 2){
            $arr[] = 1;
        }else{
            $arr[] = $arr[$i - 1] + $arr[$i - 2];
        }
    }
    return $arr;
}
print_r(fbnq(10));