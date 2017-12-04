<?php


use PHPUnit\Framework\TestCase;


class TaskListTest extends TestCase {

    private $CI;

    public function setUp() {
        $this->CI = & get_instance();
    }

    public function testSet() {
        $tasks = $this->CI->tasks->all();


            $completeTasks = 0;
            $incompleteTasks = 0;
            foreach ($tasks as $task) {
                if ($task->status == 2) {
                    $completeTasks++;
                } else {
                    $incompleteTasks++;
                }
            }
            $this->assertGreaterThan($completeTasks, $incompleteTasks);

    }

}
