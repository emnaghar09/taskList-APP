<?php

namespace App\Event;

use App\Entity\TaskList;

class TaskListCreatedEvent
{
    private $taskList;

    public function __construct(TaskList $taskList)
    {
        $this->taskList = $taskList;
    }

    public function getTaskList(): TaskList
    {
        return $this->taskList;
    }
}
