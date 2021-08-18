<?php

namespace App\Controller;

use App\Entity\Ticket;
use App\Form\ClientTicketType;
use App\Repository\UserRepository;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\HttpFoundation\Request;


class LogIssueController extends AbstractController
{
    #[Route('/logissue', name: 'log_issue')]
    public function index(Request $request, UserRepository $userRepository): Response
    {
        $ticket = new Ticket();
        $form = $this->createForm(ClientTicketType::class, $ticket);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $user = $this->getUser();
            $ticket->setStatus('open');
            $ticket->setIsSecondLineProblem(false);
            $ticket->setCreatedBy($user);
            $entityManager = $this->getDoctrine()->getManager();
            $entityManager->persist($ticket);


            $entityManager->flush();

            return $this->redirectToRoute('ticket_index', [], Response::HTTP_SEE_OTHER);
        }
        return $this->renderForm('log_issue/index.html.twig', [
            'ticket'=> $ticket,
            'form' => $form
        ]);
    }
}
