<?php
use PHPUnit\Framework\TestCase;

require '../application/entities/Task.php';

 class TaskTest extends TestCase {
  private $task;
  public function setUp()
  {
      $this->task = new Task();
  }
  public function testTaskSuccess()
  {
     $taskIsSet = $this->task->setTask('connor');
     $groupIsSet = $this->task->setGroup(2);
     $sizeIsSet = $this->task->setSize(3);
     $priorityIsSet = $this->task->setPriority(4);
     
     $this->assertTrue($taskIsSet);
     $this->assertTrue($groupIsSet);
     $this->assertTrue($sizeIsSet);
     $this->assertTrue($priorityIsSet);
  }
  
  public function testTaskFailure()
  {
     $taskIsSet = $this->task->setTask('Thisis64charactersitsgoingtotakemalongtimetotypebutineedtoseeifitworksthisisareallylongstringjimisacoolguyisthis64charactersyet');
     $groupIsSet = $this->task->setGroup(10);
     $sizeIsSet = $this->task->setSize(100);
     $priorityIsSet = $this->task->setPriority(999999999);
     
     $this->assertFalse($taskIsSet);
     $this->assertFalse($groupIsSet);
     $this->assertFalse($sizeIsSet);
     $this->assertFalse($priorityIsSet);
  }
}
