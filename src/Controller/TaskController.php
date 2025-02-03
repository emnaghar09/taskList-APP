<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\HttpFoundation\Request;
use App\Entity\Task;
use App\Service\TaskService;
use App\Service\TaskListService;
use App\Form\TaskType;
use App\Form\TaskListFormType;
use App\Entity\TaskList;
use Doctrine\ORM\EntityManagerInterface;
use App\Event\TaskListCreatedEvent;
use Symfony\Contracts\EventDispatcher\EventDispatcherInterface;

class TaskController extends AbstractController
{
    private $taskService;
    private $taskListService;
    private EventDispatcherInterface $dispatcher;
    public function __construct(TaskService $taskService, TaskListService $taskListService, EventDispatcherInterface $dispatcher)
    {
        $this->taskService= $taskService;
        $this->taskListService= $taskListService;
        $this->dispatcher = $dispatcher;
    }


    /**
     * @Route("/", name="home", methods={"GET"})
     */
    public function home(): Response
    {
        return $this->render('task/home.html.twig');
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
        $taskLists=  $this->taskListService->getTaskList($id);
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
        $userTaskLists=  $this->taskListService->getUserTaskLists($userId);
        $taskList= new TaskList();
        $form = $this->createForm(TaskListFormType::class, $taskList);
        $form->handleRequest($request);
        if ($form->isSubmitted() && $form->isValid()) {
            $taskList->setUser($this->getUser());
            $taskList->setDate(new \DateTime());
            $entityManager->persist($taskList);
            $entityManager->flush();
            $this->addFlash('success', 'Task created successfully!');
                    // Dispatch the event
            // $event = new TaskListCreatedEvent($taskList);
            // $this->dispatcher->dispatch($event);

            return $this->redirectToRoute('get_All_user_taskList');
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
/**
 * @Route("/task/new/{id}", name="add_task_id_list", methods={"GET", "POST"})
 */
public function createTaskWithIdList(Request $request, $id): Response
{
    $task = new Task();
    
    // Récupérer la taskList en fonction de l'ID passé dans l'URL
    $taskList = $this->taskListService->getTaskList($id); 

    if (!$taskList) {
        throw $this->createNotFoundException('Liste de tâches non trouvée');
    }

    $task->setTaskList($taskList);
    $form = $this->createForm(TaskType::class, $task, [
        'user' => $this->getUser(),
    ]);
    $form->handleRequest($request);

    if ($form->isSubmitted() && $form->isValid()) {
        $this->taskService->createTask($task);
        $this->addFlash('success', 'Tâche créée avec succès!');
        return $this->redirectToRoute('get_task_by_list_id', ['id' => $id]);
    }

    return $this->render('task/new.html.twig', ['form' => $form->createView(), 'taskList' => $taskList]);
}

    /**
     * @Route("/task/delete/{id}", name="task_delete", methods={"DELETE", "POST"})
     */
    public function delete($id): Response
    {
        $task = $this->taskService->findtaskById($id);

        if (!$task) {
            throw $this->createNotFoundException('Dépense non trouvée');
        }

        $this->taskService->deletetask($task);
        $userId = $this->getUser()->getId();
        $userTasks = $this->taskService->getUserTasks($userId);
        $this->addFlash('success', 'Tâche supprimée avec succès !');
        return $this->render('task/list.html.twig', [
            'userTasks' => $userTasks
        ]);
    }
        /**
     * @Route("/taskList/delete/{id}", name="task_list_delete", methods={"DELETE", "POST"})
     */
    public function deleteList($id): Response
    {
        $task = $this->taskListService->findTaskListById($id);

        if (!$task) {
            throw $this->createNotFoundException('Dépense non trouvée');
        }
        $this->taskListService->deleteTaskList($task);
        $userId=$this->getUser()->getId();
        $userTaskLists=  $this->taskListService->getUserTaskLists($userId);
        $this->addFlash('success', 'Liste supprimée avec succès !');
        return $this->render('task/userTasks.html.twig', [
            'userTasks' => $userTaskLists
        ]);
    }
}
