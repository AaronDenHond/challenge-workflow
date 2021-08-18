<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class LogIssueController extends AbstractController
{
    #[Route('/logissue', name: 'log_issue')]
    public function index(): Response
    {
        return $this->render('log_issue/index.html.twig', [
            'controller_name' => 'LogIssueController',
        ]);
    }
}
