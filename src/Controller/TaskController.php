<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\HttpFoundation\Request;
use App\Entity\Task;
use App\Service\TaskService;
use App\Form\TaskType;
use App\Form\TaskListFormType;
use App\Entity\TaskList;
use Doctrine\ORM\EntityManagerInterface;

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
     * @Route("/userTaskList", name="get_All_user_taskList", methods={"GET","POST"})
     */
    public function getUserTaskList(Request $request,EntityManagerInterface $entityManager): Response{
        $userId=$this->getUser()->getId();
        $userTaskLists=  $this->taskService->getUserTaskLists($userId);
        $taskList= new TaskList();
        $form = $this->createForm(TaskListFormType::class, $taskList);
        $form->handleRequest($request);
        if ($form->isSubmitted() && $form->isValid()) {
            $taskList->setUser($this->getUser());
            $taskList->setDate(new \DateTime());
            $entityManager->persist($taskList);
            $entityManager->flush();
            $this->addFlash('success', 'Task created successfully!');
            $form = $this->createForm(TaskListFormType::class, $taskList); // Nouveau formulaire pour cet objet

            return $this->render('task/userTasks.html.twig', ['userTaskLists'=> $userTaskLists,
                'form' => $form->createView(),
            ]);
        }
        return $this->render('task/userTasks.html.twig', ['userTaskLists'=> $userTaskLists, 'form'=>$form->createView()]);
    }
        /** 
     * @Route("/userTasks", name="get_all_user_task", methods={"GET"})
     */
    public function getUserTasks(): Response{
        $userId=$this->getUser()->getId();
        $userTasks=  $this->taskService->getUserTasks($userId);
        return $this->render('task/list.html.twig', ['userTasks'=> $userTasks]);
    }
    /**
     * @Route("/new", name="add_task", methods={"GET","POST"})
     */
    public function createTask(Request $request): Response
    {
        $task= new Task();
        $form = $this->createForm(TaskType::class, $task, [
            'user' => $this->getUser(),
        ]);
        $form->handleRequest($request);
        if ($form->isSubmitted() && $form->isValid()) {
            $this->taskService->createTask($task);
            $this->addFlash('success', 'Task created successfully!');

            return $this->redirectToRoute('get_All_user_taskList');
        }
        return $this->render('task/new.html.twig', ['form'=>$form->createView()]);
    }


}
