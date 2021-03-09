<?php

namespace App\Controller;

use App\Entity\Contact;
use App\Form\ContactType;
use App\Repository\ContactRepository;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

/**
 * @Route("/default", name="default_")
 */


class DefaultController extends AbstractController
{
     /**
     * @Route("/", name="index")
      * @param ContactRepository $contactRepository
      * @return Response
     */

    public function index(ContactRepository $contactRepository) : Response
    {
        $contact = $contactRepository->findAll();
        //$contactMail = $contactRepository->findByMail('test@test.com');

        return $this->render('default/index.html.twig',
                            ['controller_name' => 'DefaultController',
                                'contact'=> $contact,
                                //'contactMail' => $contactMail,
                            ]);

    }

    /**
     * @Route("/contact", name="contact")
     * @param EntityManagerInterface $em
     * @param Request $request
     * @return Response
     */

    public function contact(EntityManagerInterface $em, Request $request) : Response
    {
        $contact =new Contact();

        $contact->setEmail('test@test.com');
        $contact->setSubject('Ceci est un test');
        $contact->setMessage('Un message de test, pouvant être long, ou non. Celui-ci ne l\'est pas :) .');

        $em->persist($contact);
        $em->flush();

        $form = $this->createForm(ContactType::class, $contact, [
            'method' => 'POST'
        ]);

        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $em->persist($contact);
            $em->flush();

            return $this->redirectToRoute('index');
        }

        return $this->render('default/contact.html.twig', ['form'=> $form ->createView()]);
    }
}

