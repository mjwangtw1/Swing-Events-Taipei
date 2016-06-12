<?php

use Illuminate\Foundation\Testing\WithoutMiddleware;
use Illuminate\Foundation\Testing\DatabaseMigrations;
use Illuminate\Foundation\Testing\DatabaseTransactions;

class ExampleTest extends TestCase
{
    /**
     * A basic functional test example.
     *
     * @return void
     */
    public function testBasicExample()
    {
        // $this->visit('/')
        //      ->see('Laravel 5');


        //Temp modify
        // $this->visit('/test_sample')
        //      ->see('for Phpunit test');


        //Laracast practice

        //1. Visit the test_sample page
        $this->visit('/test_sample');
        //2. Click on the link 'Click Me'
        $this->click('Click Me');
        //3. See 'Whazzup bro'
        $this->see('Whazzup bro');
        //4. Verify the page /whazzup
        $this->seePageIs('/whazzup');
       
    }

}