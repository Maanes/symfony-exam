<?php

namespace App\Controller;

use App\Entity\Contact;
use App\Repository\ContactRepository;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

/**
 * @Route("/default", name="default_")
 */


class DefaultController extends AbstractController
{
     /**
     * @Route("/", name="index")
     */

    public function index(ContactRepository & $contactRepository) : Response
    {
        $contact = $contactRepository->findAll();
        $contact = $contactRepository->findByMail('test@test.com');

        return $this->render('default/index.html.twig',['controller_name' => 'DefaultController',]);
    }

    /**
     * @Route("/contact", name="contact")
     */

    public function contact(EntityManagerInterface $em) : Response
    {
        $contact =new Contact();

        $contact->setEmail('test@test.com');
        $contact->setSubject('Ceci est un test');
        $contact->setMessage('Un message de test, pouvant être long, ou non. Celui-ci ne l\'est pas :) .');

        $em->persist($contact);
        $em->flush();

        return $this->render('default/contact.html.twig');
    }
}


?>