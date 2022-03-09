<?php 
namespace App\Classe;

use App\Entity\Product;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Component\HttpFoundation\Session\SessionInterface;

class Cart
{
    private $session;
    private $entityManager;

    public function __construct(EntityManagerInterface $entityManager, SessionInterface $session)
{
    $this->session = $session;
    $this->entityManager = $entityManager;
}

    public function add($id)
    {
        $cart = $this->session->get('cart');

        if (!empty($cart[$id])) {
            $cart[$id]++;
        }else {
            $cart[$id] = 1;
        }

     $this->session->set('cart',$cart);
    }

    public function get( ){
        return $this->session->get('cart');
    }

    public function remove()
    {
        return $this->session->remove('cart');
    }
    public function delete($id)
    {
        $cart = $this->session->get('cart');
        unset($cart[$id]);
        return $this->session->set('cart', $cart);
    }
    public function decrease($id){

        $cart = $this->session->get('cart', []);
        if ($cart[$id] > 1){
            //retirer une quantitie -1
            $cart[$id]--;
        }else{
            //supremer un product
            unset($cart[$id]);
        }
        //verifier si la quantite de notre product = 1
        return $this->session->set('cart', $cart);
    }
    public function getFull(){
        $cartComplet = [];
        if ($this->get()) {
            foreach ($this->get() as $id => $quantity) {
                $product_objet = $this->entityManager->getRepository(Product::class)->findOneById($id);
;

                if (!$product_objet) {
                    $this->delete($id);
                    continue;
                }
                $cartComplet[] = [
                    'product' => $product_objet,
                    'quantity' => $quantity
                ];
            }
        }
        return $cartComplet;
    }
}