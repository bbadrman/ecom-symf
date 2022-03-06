<?php

namespace App\EventSubscriber;


use Symfony\Component\HttpKernel\KernelInterface;
use Symfony\Component\EventDispatcher\EventSubscriberInterface;
use EasyCorp\Bundle\EasyAdminBundle\Event\BeforeEntityPersistedEvent;

class EasyAdminSubscriber implements EventSubscriberInterface
{
  private $appkernel;

  public function __construct(KernelInterface $appkernel)
  {

    $this->appkernel = $appkernel;
  }
  public static function getSubscribedEvents()
  {
    return [
      BeforeEntityPersistedEvent::class => ['setIllustration'],
      BeforeEntityPersistedEvent::class => ['updateIllustration'],
    ];
  }

  public function uploadIllustrations($event){

    $entity = $event->getEntityInstance();

    $tmp_name = $_FILES['Product']['tmp_name']['illustration']['file'];

    $filename = uniqid();

    $extention = pathinfo($_FILES['Product']['name']['illustration']['file'], PATHINFO_EXTENSION);

    $projet_dir = $this->appkernel->getProjectDir();

    move_uploaded_file($tmp_name, $projet_dir . '/public/uploads/'.$filename.'.'.$extention);

    $entity->setIllustration($tmp_name, $filename);
  }

  public function updateIllustration(BeforeEntityPersistedEvent $event)
  {
    if($_FILES['Product']['tmp_name']['illustration'] !=''){
      $entity = $event->getEntityInstance();


      $tmp_name = $_FILES['Product']['tmp_name']['illustration']['file'];

      $filename = uniqid();

      $extention = pathinfo($_FILES['Product']['name']['illustration']['file'], PATHINFO_EXTENSION);

      $projet_dir = $this->appkernel->getProjectDir();

      move_uploaded_file($tmp_name, $projet_dir.'/public/uploads/'.$filename.'.'.$extention);
      
      $entity->setIllustration($tmp_name, $filename);
    }
  }


  public function setIllustration(BeforeEntityPersistedEvent $event)
  {

            
    $entity = $event->getEntityInstance();
    //dd($entity); //"test.jpg"
    $tmp_name = $_FILES['Product']['tmp_name']['illustration']['file'];
    // dd($tap_name); //"test.jpg"
    $filename = uniqid();
    //dd($filename);//"6223c3982215f"

    // dd($_FILES['Product']['name']['illustration']);

    //$extention = pathinfo($_FILES['Product']['name']['illustration']['file'], PATHINFO_EXTENSION);
    //dd($extention); //"jpg"
    // $path = $_FILES['Product']['name']['illustration'];
    //     dd($path['file']);
    // $extention = pathinfo($path, PATHINFO_EXTENSION);

 

    $project_dir = $this->appkernel->getProjectDir();
    //dd($projet_dir);"/var/www/html"

    $test = move_uploaded_file($tmp_name, $project_dir.'/public/uploads/'.$filename);
     dd($test);
    $entity->setIllustration($filename);
  }
}
