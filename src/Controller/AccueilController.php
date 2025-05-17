<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Mailer\Transport\TransportInterface;
use Symfony\Component\Mime\Email;
use Symfony\Component\Routing\Attribute\Route;

final class AccueilController extends AbstractController
{
    #[Route('/', name: 'accueil')]
    public function index(TransportInterface $mailer): Response
    {
        $email = (new Email())
            ->to('foo@example.com')
            ->addTo('bar@example.com')
            ->cc('cc@example.com')
            ->addCc('cc2@example.com')
            ->text('Hello World')
            ->from('foo@example.com')
            ->subject('Test email')

            // ...
        ;
        $mailer->send($email);
        return $this->render('accueil/index.html.twig', [
            'controller_name' => 'AccueilController',
        ]);
    }
}
