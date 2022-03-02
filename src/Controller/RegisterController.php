<?php

namespace App\Controller;

use App\Entity\User;
use App\Form\RegisterType;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;

class RegisterController extends AbstractController
{
    /**
     * @Route("/inscription", name="app_register")
     */
    public function index(Request $request, EntityManagerInterface $manager): Response
    {

        $user = new User();
        $form = $this->createForm(RegisterType::class, $user);

        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()){

            $user = $form->getData();

            $manager->persist($user);
            $manager->flush();
        }
        return $this->render('register/index.html.twig',[
            'form' => $form->createView(), 
        ]);
    }
}
