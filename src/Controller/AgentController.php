<?php

namespace App\Controller;

use App\Repository\AgentRepository;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

#[Route('/agents')]
class AgentController extends AbstractController
{
    #[Route('/', name: 'agents_index', methods: ['GET'])]
    public function index(AgentRepository $agentRepository): Response
    {
         
       
        return $this->render('agent/index.html.twig', [
            'agents' => $agentRepository->findAll() ,
        ]);
        //these are the vars we give to the twig template (the view)
    }
}
