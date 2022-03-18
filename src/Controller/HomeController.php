<?php

namespace App\Controller;

use App\Classe\Mail;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\HttpFoundation\Session\SessionInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;

class HomeController extends AbstractController
{
    /**
     * @Route("/", name="home")
     */
    public function index(SessionInterface $session): Response
    {
        // $mail = new Mail();
        // $mail->send('badr.bechtioui@gmail.com',  'badr bechtioui', 'Mon mail',  'bonjout badr');
        $session->remove('cart');
        //$cart = $session->get('cart');
         
        return $this->render('home/index.html.twig');
    }
}
