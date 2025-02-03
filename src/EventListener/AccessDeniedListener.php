<?php
namespace App\EventListener;

use Symfony\Component\HttpFoundation\RedirectResponse;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\RouterInterface;
use Symfony\Component\HttpKernel\Event\ExceptionEvent;
use Symfony\Component\Security\Core\Exception\AccessDeniedException;
use Twig\Environment;

class AccessDeniedListener
{
    private RouterInterface $router;
    private Environment $twig;

    public function __construct(RouterInterface $router, Environment $twig)
    {
        $this->router = $router;
        $this->twig = $twig;
    }

    public function onKernelException(ExceptionEvent $event)
    {
        $exception = $event->getThrowable();

        if ($exception instanceof AccessDeniedException) {
            $response = new Response(
                $this->twig->render('errors/error403.html.twig', [
                    'message' => 'Vous n’avez pas la permission d’accéder à cette page.',
                ]),
                Response::HTTP_FORBIDDEN
            );

            $event->setResponse($response);
        }
    }
}
