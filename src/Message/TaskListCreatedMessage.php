<?php 
namespace App\Message;

class TaskListCreatedMessage
{
    private string $taskListName;
    private string $userEmail;

    public function __construct(string $taskListName, string $userEmail)
    {
        $this->taskListName = $taskListName;
        $this->userEmail = $userEmail;
    }

    public function getTaskListName(): string
    {
        return $this->taskListName;
    }

    public function getUserEmail(): string
    {
        return $this->userEmail;
    }
}
