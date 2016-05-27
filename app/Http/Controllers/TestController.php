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

        return $data[0];
    }


}
