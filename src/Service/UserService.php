<?php
namespace App\Service;

use App\Entity\User;
use Doctrine\ORM\EntityManagerInterface;
use App\Repository\UserRepository;


class UserService
{
    private $entityManager;
    private $UserRepository;

    public function __construct(EntityManagerInterface $entityManager, UserRepository $userRepository)
    {
        $this->entityManager = $entityManager;
        $this->userRepository = $userRepository;

    }

    public function getAllUser(): array
    {
        return $this->userRepository->findAll();
    }

   
    
    public function createUser(User $user): void
    {
        $this->entityManager->persist($user);
        $this->entityManager->flush();
    }
    public function getUserUsers($idUser): array
    {
        return $this->userRepository->findUsersByUserId($idUser);
    }
    public function deleteUser(User $user): void
    {
        $this->entityManager->remove($user);
        $this->entityManager->flush();
    }

    public function findUserById(int $id): ?User
    {
        return $this->entityManager->getRepository(User::class)->find($id);
    }



    

}