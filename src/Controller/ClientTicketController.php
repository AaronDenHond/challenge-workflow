<?php

namespace App\Controller;

use App\Entity\User;
use App\Entity\Ticket;
use App\Entity\Comment;
use App\Form\ClientTicketType;
use App\Form\CommentType;
use App\Repository\TicketRepository;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\HttpFoundation\Request;

#[Route('/mytickets')]
class ClientTicketController extends AbstractController
{

    #[Route('/', name: 'my_tickets')]
    public function index(TicketRepository $ticketRepository): Response
    {

        return $this->render('client_ticket/myTickets.html.twig', [
            'tickets' => $ticketRepository->findBy(
                ['createdBy' => $this->getUser()]),
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
            'ticket' => $ticket,
            'form' => $form
        ]);
    }

    #[Route('/{id}', name: 'myticket_show', methods: ['GET', 'POST'])]
    public function show(Ticket $ticket, Request $request): Response
    {
        //LOGIC TO GET COMMENTS PER TICKET, NO NEED FOR CommentRepository like this.
        $comments = $ticket->getComments();
        $comment = new Comment();
        $form = $this->createForm(CommentType::class, $comment);
        $form->handleRequest($request);
        $user = $this->getUser();
        $canSetPrivate = false;
        if (in_array("ROLE_ADMIN", $user->getRoles()) || in_array("ROLE_AGENT", $user->getRoles())) {
            $canSetPrivate= true;
        }
        if ($form->isSubmitted() && $form->isValid()) {
            //agents need to have functionality to set private or not
            if (!$canSetPrivate){
                $comment->setPrivate(false);
            }
            $comment->setUserID($user);
            $comment->setTicketID($ticket);
            $entityManager = $this->getDoctrine()->getManager();
            $entityManager->persist($comment);
            $entityManager->flush();

        }

        //no need to redirect here, we're alrdy 

        return $this->renderForm('client_ticket/show.html.twig', [
            'canSetPrivate' => $canSetPrivate,
            'ticket' => $ticket,
            'comments' => $comments,
            'form' => $form,
            //don't forget to give form variable with the render or it won't work! no form is render, form is renderForm
        ]);
    }
}
