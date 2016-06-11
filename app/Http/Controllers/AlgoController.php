<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Http\Requests;

class AlgoController extends Controller
{
    //This controller is trying to practice some Demos and Algos
    //
    public function bubble_sort()
    {


    }

    public function selection_sort()
    {



    }

    public function is_prime($x = 1952)
    {
        //return $x;

        //If it is prime, then return -1;
        //If not prime, then return the biggest prime factor.

        $closest_sqrt = floor(sqrt($x));
        $max_factor = -1;
        $is_prime = TRUE;

        if($x % 2 == 0)
        {
            $max_factor = 2;
            $is_prime = FALSE;
        }

        for($i = 3;$i<=$closest_sqrt; $i = $i+1)
        {
            if($x % $i == 0)
            {
                //echo 'yolo';
                $max_factor = $i;
            }
        }

        if( ! $is_prime)
        {
            return $x / $max_factor;
        }

        return "This number $x is a fucking prime"; 
    }

    //Find the Max Prime Factor
    public function gcd($a = 235, $b = 877)
    {   
        return 'a: ' . $a . ', b:' . $b;
    }
    
    //Find the Min
    public function lcm()
    {


    }

    //9x9 table
    public function square($n = 9)
    {
        //return $n;
        for($i=1; $i<=$n; $i++)
        {
            for($j=1; $j<=$n; $j++)
            {
                //echo $i . 'x' . $j . '=' . $i*$j . ' ';

                echo $i*$j . ' ';

            }
            echo '<br/>';
        }

    }   

    //Classic
    public function fizzbuzz($n = 50)
    {

        for($i=1;$i<=$n;$i++)
        {
            if ($i % 15 == 0)
            {
                echo 'FizzBuzz';
            }
            elseif($i % 5 == 0)
            {
                echo 'Buzz';
            }
            elseif($i % 3 == 0)
            {
                echo 'Fizz';
            }
            else
            {
                echo $i;
            }

            echo '<br/>';
        }
    }

    public function print_square($n = 7)
    {
        //return 'this is a fucking square';

        $total = $n + 2;

        for($i=1; $i<=$total; $i++)
        {
            for($j=1; $j<=$total; $j++)
            {
                if(($j > 2 OR $j < $total) OR ($i >2 OR $i < $total))
                {
                    echo 'X';

                    // if($j== 1 OR $j == $total)
                    // {
                        
                    // }   
                }
                else
                {
                    echo '@';
                }

            }
            // echo '@';
            echo '<br/>';
        }



    }



}
