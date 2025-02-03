<?php
namespace App\Service;

use App\Entity\Task;
use Doctrine\ORM\EntityManagerInterface;

use App\Repository\TaskListRepository;

class TaskListService
{
    private $entityManager;

    private $taskListRepository;
    public function __construct(EntityManagerInterface $entityManager,TaskListRepository $taskListRepository)
    {
        $this->entityManager = $entityManager;

        $this->taskListRepository = $taskListRepository;
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

    public function deleteTaskList(TaskList $taskList): void
    {
        $this->entityManager->remove($taskList);
        $this->entityManager->flush();
    }

    public function findTaskListById(int $id): ?TaskList
    {
        return $this->entityManager->getRepository(TaskList::class)->find($id);
    }
    

}