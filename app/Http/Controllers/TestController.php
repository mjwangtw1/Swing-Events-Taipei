<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Http\Requests;

class TestController extends Controller
{
    public function iteration_q()
    {
    
    //Enter your code here, enjoy!
    //$N = 15;

    $N = 9;
 
    // 9 -> 1001 -> 1BN = 2;
    // 529 -> 1000010001 -> 2BN = 4,3
    // 20 -> 10100 -> 1BN = 1
    // 15 -> 1111 -> 0BN
    

    $binary_data = decbin($N);

    $binary_data = '10000010000000001';


    $zero = '0'; 
    $one = '1';
      
    $binary_data_array = str_split($binary_data);

    if( ! in_array($zero, $binary_data_array))
    {
        return 0; //Not even 1 zeron inside
    }

    $start_flag = false;
    $end_flag = TRUE;
    $counter = 0;
    $max_length = 0;

    foreach($binary_data_array as $index => $value)
    {
        if($one == $value)
        {
            if($end_flag)
            {
                //echo 'GG';
                if ( ! $start_flag)
                {
                    $start_flag = TRUE;
                    $end_flag = FALSE; 
                }
                $end_flag = FALSE;
            }
            else
            {
                $end_flag = TRUE;
                $max_length = $counter;
                $counter = 0;
                $start_flag = FALSE;
            }


        }

        if(($zero == $value) && ($start_flag) && ( ! $end_flag))
        {
            $counter ++;
        }

        echo 'AT[' . $index .'],V[' . $value . '],S[' . $start_flag . '],E[' . $end_flag . ']C[' . $counter .']<br/>';
    }


        if( ! $end_flag)
        {
            return  0;
        }



        return $counter;

    }

    //Array Manipulation Question #1 - Moving Array
    public function array_q()
    {

//===============================Sample Input
        $K = 6;                  
        $A = [3,8,9,7,6];

//===============================Resired Result
        $result =      [9,7,6,3,8]; //Desired Result;
       
        $count = count($A);
        if ($K > $count)
        {
            $K = $K % $count;
        }

        $loop = $count - $K;

        $slice = array_slice($A, 0, $loop);
        $move = array_slice($A, $loop, $count);

        $array_final = array_merge($move, $slice);

        return $array_final;
    }

    //Use Array_keys to kick out duplicate Keys
    public function array_q2()
    {
//===============================Sample Input
        $A = [9,3,9,3,9,7,9];

//===============================Resired Result
        $result = 7; //Unpaired stuff.

        

        //Plan A: simpler
        $count = count($A);
        
        foreach($A as $key =>$value)
        {
            $check_array = array_keys($A, $value);
            //Just get the single one
            if (count($check_array) % 2 != 0)
            {
                return $value;
            }
        }


        //Plan B: Use more resourse
        foreach($A as $key => $value)
        {
            $check_array = array_keys($A, $value);

            if (count($check_array) %2 == 0)
            {
                foreach($check_array as $id=> $value)
                {
                    unset($A[$value]); //Unset all these shit
                }
            }          
        }
        $data = array_values($A);

        //Plan C: Leo's solution
        $return_array = [];
        foreach($A as $value)
        {
            if(isset($return_array[$value]))
            {
                unset($return_array[$value]);
            }
            else
            {
                $return_array[] = $value;
            }
        }

        return array_pop($return_array);




        return $data[0];
    }

    public function frog_jump()
    {
        $X = 10; $Y = 85; $D = 30;
  //===============================Sample Data Above.
        
        $dist = $Y - $X;

        if ($dist == 0)
        {
            return 0;
        }

        $steps = ceil($dist / $D);

        return $steps;
    }


    public function cal_permutation()
    {
        $A = [4,1,3,2]; //prem
        //$A = [4,1,3];   //N-Prem

        $A = [5,0,3,2]; //Antisum

        //===============================Sample Data Above.

        $total = 0;
        $count = count($A);
        $check_array = [];
        $cal_total = (1 + $count) * $count /2;
        foreach($A as $key => $value)
        {
            $total += $value;
 
            if(isset($check_array[$value])) //考慮重複case
            {
                return 0;
            }
            else
            {
                $check_array[$value] = $value;
            }

            if($value > $count) //考慮過大值
            {
                return 0;
            }            
        }

        //Not sum case
        if ($total != $cal_total)
        {
            return 0;
        }
        
        return 1;
    }

    public function tape_equilibrium()
    {   
        //$A = [3,1,5,4,3];
        $A = [-1000, 1000];

        //===============================Sample Data Above.
        $total = array_sum($A);
        $cnt = count($A);
       
        $record = 9999999;
        $left = 0;

        for($i = 0 ; $i < $cnt - 1 ; $i++)
        {
            $left = $left + $A[$i];
            $total = $total - $A[$i];

            $data = abs($total - $left);
            $record = min($record, $data);
        }

        return $record;

    }


    public function perm_missing_elem()
    {   
        $A = [2,3,1,5];
        //===============================Sample Data Above.
        $cnt = count($A);  
        $area = (1 + $cnt + 1 ) * ($cnt +1) / 2 ; 
        $total = array_sum($A);

        $result = $area - $total;

        return $result;

    }

    public function frog_river_one()
    {
        $n = 5;
        $A = [1,3,1,4,2,3,5,4];
        //===============================Sample Data Above.
        
        $cnt = count($A);

        if ($n == 0)
        {
            return -1;
        }

        $ret = [];
        for($i=1;$i<=$n;$i++)
        {
            $ret[$i] = $i;
        }

        foreach($A as $key=>$value)
        {
            if(isset($ret[$value]))
            {
                unset($ret[$value]);
            }
            if(empty($ret))
            {
                return $key;
            }
        }

        return -1;

    }

    public function missing_integer()
    {
        $A = [1,3,6,4,1,2];
        $A = [1];
        //===============================Sample Data Above.
        
    
        $ret = [];
        foreach($A as $value)
        {
            $ret[$value] = 1;
        }

        $LEO_rule = TRUE;

        if($LEO_rule)
        {
            $i = 0;
            do
            {
                $i++;

                //echo 'Now: ' . $ret[$i] . ' <br/>';

            }while(isset($ret[$i])); 
        
            return $i;

        }
        else
        {
            //Traditional
            $cnt = count($A);
            for($i=1; ; $i++)
            {
                if( ! isset($ret[$i]))
                {
                    return $i;
                }
            }

        }
    }


    public function max_counter()
    {
        $A = [3,4,4,6,1,4,4];
        //$A = [1];
        //$A = [7,7,7,7,7];
        $N = 5;        
        //===============================Sample Data Above.

        //===============================Leo's solution.
        $ret = [];
        $max = 0;
        $low = 0;

        foreach($A as $v)
        {
            if($v < $N )
            {
                if(isset($ret[$v-1]))
                {
                    $ret[$v-1] ++;
                }
                else
                {
                    $ret[$v-1 ] = 1;
                }

                if($ret[$v-1] > $max)
                {
                    $max = $ret[$v-1];                
                }

            }
            else
            {
                $low += $max;
                $ret = [];
                $max = 0;
            }
        }

        for ($i=0; $i <$N; $i++)
        {
            if(isset($ret[$i]))
            {
                $ret[$i] += $low;
            }
            else
            {
                $ret[$i] = $low;
            }

        }
        return $ret;

        //===============================Leo's solution.

        if(FALSE)
        {
            $res = [];
            for($i=0;$i<$N;$i++)
            {
                $res[$i] = 0; //Fill in the basic shit.
            }

            foreach($A as $id=> $values)
            {
                
                if($values > $N)
                {
                    $max = max($res);

                    for($i=0;$i<$N;$i++)
                    {
                        $res[$i] = $max; //Fill in the basic shit.
                        unset($A[$id]);   
                    }
                }
                else
                {
       
                    $res[$values -1] = $res[$values -1] +1;
                }
            }

            return $res;
        }
        
    }   

    //WTF don't get the question at all
    public function passing_cars()
    {
        echo 'passing cars';
        $A = [0,1,0,1,1];
        //================Sample Data Above

        $cnt = count($A);


        $passingEastCount = 0;
        $total_passing = 0;

        foreach($A as $key => $value)
        {
            if(1 == $value)
            {
                $passingEastCount = $passingEastCount + $total_passing;
            }
            else
            {
                $passingEastCount ++;
            }

        }

        if ($total_passing > 1000000000 || $total_passing < 0)
        {
            return -1;
        }

        return $total_passing;
    }


    public function count_div()
    {
        echo 'passing cars';
        $A = [0,1,0,1,1];
        //================Sample Data Above



    }



    public function min_avg_two_slice()
    {
        echo 'Min avg two slice';




    }

    public function check_1()
    {
        $Y = 2014; $A = 'April'; $B = 'May'; $W = 'Wednesday';
        //================Sample Data Above
        
        $leap = ($Y % 4 == 0 ) ? 29 : 28; //Deal with Leap first.

        //Set the data first.
        $month['January'] = 31;
        $month['February'] = $leap; //29 if leap
        $month['March'] = 31;
        $month['April'] = 30;
        $month['May'] = 31;
        $month['June'] = 30;
        $month['July'] = 31;
        $month['August'] = 31;
        $month['September'] = 30;
        $month['October'] = 31;
        $month['November'] = 30;
        $month['December'] = 31;

        //Month_fetch
        $month_order['January'] = 1;
        $month_order['February'] = 2;
        $month_order['March'] = 3;
        $month_order['April'] = 4;
        $month_order['May'] = 5;
        $month_order['June'] = 6;
        $month_order['July'] = 7;
        $month_order['August'] = 8;
        $month_order['September'] = 9;
        $month_order['October'] = 10;
        $month_order['November'] = 11;
        $month_order['December'] = 12;    

        $ref = array_keys($month_order);
        // var_dump($ref);

        $delta =         $ref[$month_order[$B]];
        // var_dump($delta);

        $start['month']= $month[$A];
        $start['order'] = $month_order[$A];

        $end['month']= $month[$B];
        $end['order'] = $month_order[$B];

        $sum = [];
        $days_total = 0;
        foreach($month as $month_name => $days_in_month)
        {
            $days_total += $days_in_month;
            $sum[$month_name] = $days_total;
            //$week_day[$month_name] = $days_total % 7;
        }

        $days_till_first = $sum[$A];

        $extra_first = $days_till_first %7;

        $actual_begin_date = $days_till_first + (7- $extra_first); //126



        $days_till_end = $sum[$delta];

        $extra_end = $days_till_end % 7;

        $actual_end_date = $days_till_end - ( 7 - $extra_end );

        $gap = ($actual_end_date - $actual_begin_date) / 7;

        $actual_entire_weeks = floor($gap);


        //var_dump($actual_entire_weeks);   

        return (int) $actual_entire_weeks;

    }

    public function check_2()
    {
        $A = [ 1, 3,-3]; //ans = 6
        $A = [-8, 4, 0, 5, -3, 6]; //ans = 14

        // foreach($A as $index => $values)
        // {   
        //     if($values > $max)
        //     {
        //         $max = $values;
        //         $ret[$index] = $values;
        //     }
        // }

        //First Version //works but looped N**2, trying to simplify
        $cnt = count($A);
        $max = 0;
        for($i=0; $i<$cnt ; $i++)
        {
            for($j=$i; $j<$cnt; $j++)
            {
                echo 'i: ' . $i . ', j:' . $j . '<br/>';

                $result = $A[$i] + $A[$j] + abs($i - $j);
                if($max <= $result)
                {
                    $max = $result;
                }
            }
        }
        return $max;


        $cnt = count($A);
        $sum = array_sum($A);
        $max = 0;

        return $sum;




        var_dump($max);



    }

    public function check_3()
    {
        //$K, $L, $M, $N, $P, $Q, $R, $S
        //Calculate if they cross each other.

        //Cross: TRUE
        $K = 0; $L = 1; //First  //p1
        $M = 4; $N = 3; //Pair

        $P = 1; $Q = 3; //Second 
        $R = 2; $S = 1; //Pair   //p2

        //Not cross: FALSE
        // $K = 0; $L = 1; //First
        // $M = 4; $N = 3; //Pair
        // $P = 3; $Q = 2; //Second
        // $R = 5; $S = 1; //Pair
        //================Sample Data Above
        
        //Get formula first;
        // $y = $a * $x + $b;

        // $L = $a * $K + $b;
        // $M = $a * $N + $b;

        // $a = ($L - $b) / $K;
        // $a = ($M - $b) / $N;

        $a = ($L-$N) / ($K-$M) ;
        $b = $L - ($a * $K);

        //echo '$a' . $a .', b:' .$b . '<br/>';

        //Here we got the data, a=0.5, b=1;
        
        $check_first = $a*$P + $b - $Q;
        $check_second = $a*$R + $b - $S ;

        //echo "First:" . $check_first . ', Second ' . $check_second;

        $cross = ($check_first * $check_second > 0)? FALSE : TRUE;

        return $cross;

        var_dump($cross);
        
    }

    public function check_4()
    {
        echo 'check_4';
    }

    public function check_5()
    {
        //Cross: TRUE
        $K = -4; $L = 1; //First  //p1
        $M = 2; $N = 6; //Pair

        $P = 0; $Q = -1; //Second 
        $R = 4; $S = 3; //Pair   //p2

        $square_1 = ($M - $K) *($N - $L);
        $square_2 = ($R - $P) *($S - $Q);

        $intersect_square = 0; //default no intersect
        if(($M-$P) * ($S-$L) > 0)
        {
            $intersect_square = ($M-$P) * ($S-$L);
        }    

        $final = ($square_1+$square_2 - $intersect_square);

        if($final > 2147483647)
        {
            return -1;
        }

        return $final;
        //var_dump($intersect_square);

    }





    public function equi()
    {
        $sum = array_sum($A) - $A[0];
        $cnt = count($A);
        $left = 0;

        if(empty($A)) //fuck that empty array
        {
            return -1;
        }

        if($sum == 0) 
        {
            return 0;
        }

        for($i=1; $i<$cnt ;$i++)
        {   
            $left = $left + $A[$i-1];
            $sum = $sum - $A[$i];

            if($left == $sum)
            {
                return $i;
            }

        }

        return -1;

    }









    public function grid()
    {
        return view('grid');
    }


}