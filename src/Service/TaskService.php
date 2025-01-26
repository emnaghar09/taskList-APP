<?php
namespace App\Service;

use App\Entity\Task;
use Doctrine\ORM\EntityManagerInterface;
use App\Repository\TaskRepository;
use App\Repository\TaskListRepository;

class TaskService
{
    private $entityManager;
    private $taskRepository;
    private $taskListRepository;
    public function __construct(EntityManagerInterface $entityManager, TaskRepository $taskRepository, TaskListRepository $taskListRepository)
    {
        $this->entityManager = $entityManager;
        $this->taskRepository = $taskRepository;
        $this->taskListRepository = $taskListRepository;
    }

    public function getAllTask(): array
    {
        return $this->taskRepository->findAll();
    }

    public function getTasks($idList): array
    {
        return $this->taskRepository->findByTaskList($idList);
    }
    
    public function createTask(Task $task): void
    {
        $this->entityManager->persist($task);
        $this->entityManager->flush();
    }


    public function getAllTaskList(): array
    {
        return $this->taskListRepository->findAll();
    }
    public function getUserTaskLists($idUser): array
    {
        return $this->taskListRepository->findByUserId($idUser);
    }

    public function getTaskList($id): array
    {
        return $this->taskListRepository->findById($id);
    }
    public function getUserTasks($idUser): array
    {
        return $this->taskRepository->findTasksByUserId($idUser);
    }

    

}