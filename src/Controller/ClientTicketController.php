<?php

namespace App\Controller;

use App\Entity\Ticket;
use App\Form\ClientTicketType;
use App\Repository\TicketRepository;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\HttpFoundation\Request;


class ClientTicketController extends AbstractController
{

    #[Route('/mytickets', name: 'my_tickets')]
    public function index(TicketRepository $ticketRepository): Response
    {

        return $this->render('client_ticket/myTickets.html.twig', [
            'tickets' => $ticketRepository->findBy(
                [ 'createdBy' => $this->getUser()]),
        ]);
    }

    #[Route('/logissue', name: 'log_issue')]
    public function logIssue(Request $request): Response
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
            return $this->redirectToRoute('my_tickets', [], Response::HTTP_SEE_OTHER);
        }
        return $this->renderForm('client_ticket/index.html.twig', [
            'ticket'=> $ticket,
            'form' => $form
        ]);
    }
}
