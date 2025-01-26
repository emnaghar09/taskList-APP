<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\HttpFoundation\Request;
use App\Entity\Task;
use App\Service\TaskService;
use App\Form\TaskType;

class TaskController extends AbstractController
{
    private $taskService;
    public function __construct(TaskService $taskService)
    {
        $this->taskService= $taskService;
    }


    /** 
     * @Route("/task", name="get_all_task", methods={"GET"})
     */
    public function getAllTask(): Response{
        $tasks=  $this->taskService->getAllTask();
        return $this->render('task/index.html.twig', ['tasks'=> $tasks]);
    }

        /** 
     * @Route("/taskList/{id}", name="get_task_list_by_id", methods={"GET"})
     */
    public function getTaskList($id): Response{
        $taskLists=  $this->taskService->getTaskList($id);
        return $this->render('task/index.html.twig', ['taskLists'=> $taskLists]);
    }
        /** 
     * @Route("/task/{id}", name="get_task_by_list_id", methods={"GET"})
     */
    public function getTasks($id): Response{
        $tasks=  $this->taskService->getTasks($id);
        return $this->render('task/index.html.twig', ['tasks'=> $tasks]);
    }
    
        /** 
     * @Route("/userTaskList", name="get_user_task", methods={"GET"})
     */
    public function getUserTaskList(): Response{
        $userId=$this->getUser()->getId();
        $userTaskLists=  $this->taskService->getUserTaskLists($userId);
        return $this->render('task/userTasks.html.twig', ['userTaskLists'=> $userTaskLists]);
    }

    /**
     * @Route("/new", name="add_task", methods={"GET","POST"})
     */
    public function createTask(Request $request): Response
    {
        $task= new Task();
        $form= $this->createForm(TaskType::class, $task);
        $form->handleRequest($request);
        if ($form->isSubmitted() && $form->isValid()) {
            $this->taskService->createTask($task);
            $this->addFlash('success', 'Task created successfully!');

            return $this->redirectToRoute('get_user_task');
        }
        return $this->render('task/new.html.twig', ['form'=>$form->createView()]);
    }

}
