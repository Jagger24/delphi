<?php

namespace Tests\Unit;

use Tests\TestCase;
use Illuminate\Foundation\Testing\RefreshDatabase;
use App\Http\Controllers\SessionController;

class ExampleTest extends TestCase
{
    /**
     * A basic test example.
     *
     * @return void
     */
    public function testBasicTest()
    {
        $this->assertTrue(true);
    }

	/**
     * Test SessionController::mean with 0 students
     *
     * @return void
     */
    public function testMean0Students()  {
    	$nums = "0,1,2";
    	$num_students = 0;
    	$mean = SessionController::mean($nums, $num_students);
    	$this->assertTrue($mean == 0);
    }

    /**
     * Test SessionController::mean with no votes
     *
     * @return void
     */
    public function testMean0Votes()  {
    	$nums = "";
    	$num_students = 2;
    	$mean = SessionController::mean($nums, $num_students);
    	$this->assertTrue($mean == 0);
    }

    /**
     * Test SessionController::mean normal case
     *
     * @return void
     */
    public function testMeanNormalCase()  {
    	$nums = "1,2,3";
    	$num_students = 3;
    	$mean = SessionController::mean($nums, $num_students);
    	$this->assertTrue($mean == 2);
    }

    /**
     * Test SessionController::std_dev with 0 students
     *
     * @return void
     */
    public function testStdDev0Students()  {
    	$nums = "1,2,3";
    	$num_students = 0;
    	$mean = 2;
    	$std_dev = SessionController::std_dev($nums, $num_students, $mean);
    	$this->assertTrue($std_dev == 0);
    }

    /**
     * Test SessionController::std_dev with 0 mean/votes
     *
     * @return void
     */
    public function testStdDev0Mean()  {
    	$nums = "";
    	$num_students = 3;
    	$mean = 0;
    	$std_dev = SessionController::std_dev($nums, $num_students, $mean);
    	$this->assertTrue($std_dev == 0);
    }

    /**
     * Test SessionController::std_dev normal case
     *
     * @return void
     */
    public function testStdDevNormalCase()  {
    	$nums = "1,2,3";
    	$num_students = 3;
    	$mean = 2;
    	$std_dev = SessionController::std_dev($nums, $num_students, $mean);
    	$this->assertTrue(round($std_dev, 3) == .816);
    }
}
