<?php
namespace App\Service;

use App\Entity\Task;
use Doctrine\ORM\EntityManagerInterface;
use App\Repository\TaskRepository;


class TaskService
{
    private $entityManager;
    private $taskRepository;

    public function __construct(EntityManagerInterface $entityManager, TaskRepository $taskRepository)
    {
        $this->entityManager = $entityManager;
        $this->taskRepository = $taskRepository;

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


    public function getUserTasks($idUser): array
    {
        return $this->taskRepository->findTasksByUserId($idUser);
    }
    public function deleteTask(Task $task): void
    {
        $this->entityManager->remove($task);
        $this->entityManager->flush();
    }

    public function findtaskById(int $id): ?Task
    {
        return $this->entityManager->getRepository(Task::class)->find($id);
    }
    

}