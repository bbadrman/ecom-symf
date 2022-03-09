<?php

namespace App\Controller;

use App\Entity\Adress;
use App\Form\AddressType;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;

class AccountAddressController extends AbstractController
{
    private $entityManager;

    public function __construct(EntityManagerInterface $entityManager){
      $this->entityManager = $entityManager;
    }
    /**
     * @Route("/compte/adresses", name="account_address")
     */
    public function index(): Response
    {
    
        return $this->render('account/address.html.twig');
    }

    /**
     * @Route("/compte/ajouter_adresses", name="address_add")
     */
    public function add(Request $request, EntityManagerInterface $manager): Response
    {
        $adress = new Adress();
        $form = $this->createForm(AddressType::class, $adress);

        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $adress->setUser($this->getUser());

            $manager->persist($adress);
            $manager->flush(); 
            return $this->redirectToRoute('account_address');
        }

        return $this->render('account/address_form.html.twig',[
            'form' => $form->createView(),
        ]);
    }

    /**
     * @Route("/compte/modifier_adresses/{id}", name="address_edit")
     */
    public function edit(Request $request, EntityManagerInterface $manager, $id): Response
    {
        $adress = $this->entityManager->getRepository(Adress::class)->findOneById($id);

        if (!$adress || $adress->getUser() != $this->getUser()) {
            return $this->redirectToRoute('account_address');
        }

        $form = $this->createForm(AddressType::class, $adress);

        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {

            $manager->flush();
            return $this->redirectToRoute('account_address');
        }

        return $this->render('account/address_form.html.twig', [
            'form' => $form->createView(),
        ]);
    }

    /**
     * @Route("/compte/suppremer_adresses/{id}", name="address_delete")
     */
    public function delete(EntityManagerInterface $manager, $id): Response
    {
        $adress = $this->entityManager->getRepository(Adress::class)->findOneById($id);

        if ($adress && $adress->getUser() == $this->getUser()) {



            $manager->remove($adress);

            $manager->flush();
        }

    
            return $this->redirectToRoute('account_address');
      }

}
