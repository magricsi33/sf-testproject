<?php

namespace App\Controller;

use App\Entity\Messages;
use App\Repository\MessagesRepository;
use App\Form\MessagesFormType;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\Form\Extension\Core\Type\DateType;
use Symfony\Component\Form\Extension\Core\Type\SubmitType;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\Form\FormFactoryInterface;
use Symfony\Component\HttpFoundation\Request;

class ContactContorller extends AbstractController
{
    private $em;
    private $movieRepository;
    public function __construct(MessagesRepository $messagesRepository, EntityManagerInterface $em) {
        $this->messagesRepository = $messagesRepository;
        $this->em = $em;
    }


    /**
     * @Route("/kapcsolat", name="kapcsolat")
     */
    public function index(Request $request): Response
    {
        $messages = new Messages();
        $form = $this->createForm(MessagesFormType::class, $messages);
        
        $form->handleRequest($request);
        if ($form->isSubmitted() && $form->isValid()) {
            $newMessage = $form->getData();
            if (! $newMessage->getName() || ! $newMessage->getEmail() || ! $newMessage->getComment()) {
                $this->addFlash(
                    'danger',
                    'Hiba! Kérjük töltsd ki az összes mezőt!'
                );
            } else {
                $this->em->persist($newMessage);
                $this->em->flush();
    
                $this->addFlash(
                    'success',
                    'Köszönjük szépen a kérdésedet. Válaszunkkal hamarosan keresünk a megadott e-mail címen.'
                );
            }
            return $this->redirectToRoute('kapcsolat');
        };

        return $this->render('contact.html.twig', [
            'form' => $form->createView()
        ]);
    }
    
}
