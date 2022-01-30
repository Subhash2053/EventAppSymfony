<?php

namespace App\Controller;

use App\Entity\Event;
use App\Form\EventType;
use App\Repository\EventRepository;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\IsGranted;


#[Route('/event')]
/**
 * @IsGranted("ROLE_USER")
 */
class EventController extends AbstractController
{
    #[Route('', name: 'event_index', methods: ['GET'])]
    public function index(Request $request, EventRepository $eventRepository): Response
    {
        
        $filter = $request->query->get('filterby', '');
        $includeFinishedEvents= ($filter == 'finishedEvents');
        $includeUpcomingEvents =  ($filter == 'upcomingEvents');
     
        $output= [
                     
            'events' => $eventRepository->getEvent($includeFinishedEvents, $includeUpcomingEvents),
           
            'finishedEvents'=>$includeFinishedEvents,
            'upcomingEvents'=>$includeUpcomingEvents,
        ];
       
        return $this->render('event/index.html.twig', $output);
    }

    #[Route('/new', name: 'event_new', methods: ['GET', 'POST'])]
    public function new(Request $request, EntityManagerInterface $entityManager): Response
    {
        $event = new Event();
        $form = $this->createForm(EventType::class, $event);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $entityManager->persist($event);
            $entityManager->flush();

            return $this->redirectToRoute('event_index', [], Response::HTTP_SEE_OTHER);
        }

        return $this->renderForm('event/new.html.twig', [
            'event' => $event,
            'form' => $form,
        ]);
    }

    #[Route('/{id}', name: 'event_show', methods: ['GET'])]
    public function show(Event $event): Response
    {
        return $this->render('event/show.html.twig', [
            'event' => $event,
        ]);
    }

    #[Route('/{id}/edit', name: 'event_edit', methods: ['GET', 'POST'])]
    public function edit(Request $request, Event $event, EntityManagerInterface $entityManager): Response
    {
        $form = $this->createForm(EventType::class, $event);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $entityManager->flush();

            return $this->redirectToRoute('event_index', [], Response::HTTP_SEE_OTHER);
        }

        return $this->renderForm('event/edit.html.twig', [
            'event' => $event,
            'form' => $form,
        ]);
    }

    #[Route('/{id}', name: 'event_delete', methods: ['POST'])]
    public function delete(Request $request, Event $event, EntityManagerInterface $entityManager): Response
    {

        
        $response = new Response();
      
        if ($this->isCsrfTokenValid('delete'.$event->getId(), $request->request->get('_token',''))) {
           
            $entityManager->remove($event);
            $entityManager->flush();
            $response->setContent(json_encode([
                'message' => 'data deleted',
                ]));
        }else{

            $response->setContent(json_encode([
                'error' => 'CSRF problem',
                ]));
        }
        $response->headers->set('Content-Type', 'application/json');
        return $response;
    }
}
