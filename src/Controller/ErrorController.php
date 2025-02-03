<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class ErrorController extends AbstractController
{
    /**
     * @Route("/error", name="app_error")
     */
    public function show(FlattenException $exception): Response
    {
        $statusCode = $exception->getStatusCode();
        return $this->render('exception/error.html.twig', [
            'status_code' => $statusCode,
            'message' => $exception->getMessage(),
        ]);
    }
}
