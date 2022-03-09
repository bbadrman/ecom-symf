<?php

namespace App\Controller;

use App\Classe\Cart;
use App\Repository\ProductRepository;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;

class CartController extends AbstractController
{
    /**
     * @Route("/mon-panier", name="cart")
     */
    public function index(Cart $cart, ProductRepository $repo): Response
    {
        

       
       
        return $this->render('cart/index.html.twig',[
            'cart' =>  $cart->getFull()
        ]);
    }


    /**
     * @Route("/cart/add/{id}", name="add_to_cart")
     */
    public function add(Cart $cart, $id): Response
    {
        $cart->add($id);
        return $this->redirectToRoute('cart');
    }

    /**
     * @Route("/cart/remove", name="remove_cart")
     */
    public function remove(Cart $cart): Response
    {
        $cart->remove();
        return $this->redirectToRoute('products');
    }

    /**
     * @Route("/cart/delete{id}", name="delete_cart")
     */
    public function delete(Cart $cart, $id): Response
    {
        $cart->delete($id);
        return $this->redirectToRoute('cart');
    }


    /**
     * @Route("/cart/decrease{id}", name="decrease_cart")
     */
    public function decrease(Cart $cart, $id): Response
    {
        $cart->decrease($id);
        return $this->redirectToRoute('cart');
    }
}
