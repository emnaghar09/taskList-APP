<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use App\Service\UserService;
class UserController extends AbstractController
{

    private $userService;
    public function __construct(UserService $userService)
    {
        $this->userService= $userService;
    }

        /** 
     * @Route("/user", name="get_all_users", methods={"GET"})
     */
    public function getUsers(): Response{
        $users=  $this->userService->getAllUser();
        return $this->render('user/user.html.twig', ['users'=> $users]);
    }

    /**
     * @Route("/user/delete/{id}", name="user_delete", methods={"DELETE"})
     */
    public function delete($id): Response
    {
        $user = $this->userService->findUserById($id);

        if (!$user) {
            throw $this->createNotFoundException('Dépense non trouvée');
        }

        $this->userService->deleteUser($user);

        return $this->json(['message' => 'Dépense supprimée avec succès']);
    }
    
}
