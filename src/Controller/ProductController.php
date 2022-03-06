<?php

namespace App\Controller;

use App\Entity\Product;
use App\Repository\ProductRepository;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;

class ProductController extends AbstractController
{
    /**
     * @Route("/nos-produits", name="products")
     */
    public function index(ProductRepository $repo): Response
    {
       
        $products = $repo->findAll();

       
        return $this->render('product/index.html.twig',[
            'products' => $products
        ]);
    }

    /**
     * @Route("/produit/{slug}", name="product")
     */
    public function show(Product  $product ): Response
    {

        //$product = $this->findOneBySlug($slug);

        //   if (!$product) {
        //     return $this->redirectToRoute('products');
        // }


        return $this->render('product/show.html.twig', [
            'product' => $product
        ]);
       
    }
}
