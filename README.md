# SITE_NAME

SITE_NAME website with docker, drupal 9.2, Apache, MySQL and phpmyadmin.


## Main Configuration

### Configure docker containers

In docker >> docker-compose.yml find replace test by project name and change all the port for web, db & phpmyadmin.


### Install Dependencies :

```
docker-compose exec web bash
composer install
```


### Configure Xdebug

1. In PhpStorm go to: File | Settings | PHP | Debug, in Xdebug >> Debug port enter the port number (9010 for example).
2. Click on ADD Configurations (next phone symbole):
  - In left of pop-up window click on + and choose PHP Remote Debug;
  - Enter Name: Localhost (for example);
  - Check: Filter debug connection by IDE key;
  - In Server click in: ...;
  - In left off the pop-up window click on +;
  - Enter Localhost for Name (for example);
  - Enter Localhost for Host,
  - Enter the port number (check the web port in docker-compose);
  - Select Use path mappings;
  - in Project files >> got to your project root path >> next src enter: /var/www/html;
  - Click: Apply.
3. Download the [Xdebug helper](https://chrome.google.com/webstore/detail/xdebug-helper/eadndfjplgieldjbigjakmdgkmoaaaoc) (Google Chrome extension) and in options >> IDE key copy "PHPSTORM".
4. Back in Run/Debug Configuration in IDE key(session id) enter the copied IDE key (PHPSTORM) then click Apply.
5. In Menu >> Run >> select : Break at first line in PHP scripts.
6. Click on the phone symbole until it change to green and in browser click on Xdebug helper until it change to green also
7. Go to your home page website and click f5 to refresh.
8. Finally, in Run >> uncheck : Break at first line in PHP scripts.


### Configuring the Database :

The database connection information is stored as an environment variable called DATABASE_URL. 
For development, you can find and customize this inside app >> .env:

```
# to use mysql:
DATABASE_URL="mysql://yassine:123456@db:3306/my_cabinet_db?serverVersion=8.0.27"
```


### Installing Doctrine :

```
composer require symfony/orm-pack
composer require --dev symfony/maker-bundle
```


### Install the Profiler

`composer require --dev symfony/profiler-pack`


### Adding Rewrite Rules

The easiest way is to install the apache Symfony pack by executing the following command: `composer require symfony/apache-pack`
> Note: for more information check: [web server configuration](https://symfony.com/doc/current/setup/web_server_configuration.html).


## symfony make:user

created: src/Entity/User.php
 created: src/Repository/UserRepository.php
 updated: src/Entity/User.php
 updated: config/packages/security.yaml    

nb: dans security il ajoute 
 app_user_provider:
            entity:
                class: App\Entity\User
                property: email


### boostrap 
  alors pour garder la theme boostrap il faut ajouter sur scripte twig.yaml :
  twig:
         form_themes: ['bootstrap_4_layout.html.twig']

### conferme mot de password
 il y a deux methode soit de declarer in form une class RepetType::class  ou bien  'mapped' => false, pour que soit reflese seulement sur broiser sans recherche de property pass-conferm in class user

 ### valider la formule a l'aide injection indupendance 

  1) pour valider la fourmule il faut met : 
            $doctrine = $this->getDoctrine()->getManager();
            $doctrine->persist($user);
            $doctrine->flush();
  au dessu du fonction 
  2) ou bien created une private property au haut du fontion 
       private $entityManager;
       public function __construct(EntityManagerInterface $entityManager){
         $this->entityManager = $entityManager;
       }

       dans ce cas on peut supprimer  $doctrine = $this->getDoctrine()->getManager();
  3) aussi crasse a l'injection indupendance au fontion tu peut met index(EntityManagerInterface $Manager)
   $manajer->persist
   $manager->flush

   ### creation login a l'aide du symfony make:auth

   www-data@e9165f57d395:~/html$ symfony make:auth

 What style of authentication do you want? [Empty authenticator]:
  [0] Empty authenticator
  [1] Login form authenticator
 > 1

 The class name of the authenticator to create (e.g. AppCustomAuthenticator):
 > LoginFormAuthenticator

 Choose a name for the controller class (e.g. SecurityController) [SecurityController]:
 > 

 Do you want to generate a '/logout' URL? (yes/no) [yes]:
 > 

 created: src/Security/LoginFormAuthenticator.php
 updated: config/packages/security.yaml
 created: src/Controller/SecurityController.php
 created: templates/security/login.html.twig

           
  Success! 
           

 Next:
 - Customize your new authenticator.
 - Finish the redirect "TODO" in the App\Security\LoginFormAuthenticator::onAuthenticationSuccess() method.
 - Review & adapt the login template: templates/security/login.html.twig.

 ### symfony debug:route 
 qui permet d'afficher les route possible avec leur path

 ### EasyAdminBundle

 1) il faut l'installer a l'aide du cmd "composer require easycorp/easyadmin-bundle"
 2) 
www-data@e9165f57d395:~/html$ symfony make:admin:dashboard

 Which class name do you prefer for your Dashboard controller? [DashboardController]:
 > 

 In which directory of your project do you want to generate "DashboardController"? [src/Controller/Admin/]:
 > 


                                                                                                                        
 [OK] Your dashboard class has been successfully generated.            

 3) www-data@e9165f57d395:~/html$ symfony make:admin:crud

 Which Doctrine entity are you going to manage with this CRUD controller?:
  [0] App\Entity\User
 > 0

 Which directory do you want to generate the CRUD controller in? [src/Controller/Admin/]:
 > 

 Namespace of the generated CRUD controller [App\Controller\Admin]:
 > 

                                                                                                                        
 [OK] Your CRUD controller class has been successfully generated.

 ### Création de notre compte Stripe
   email:  bbadrman@gmail.com
   password: badrman@1983

###  Installation de Stripe dans notre projet
  a l'aide du commande   "composer require stripe/stripe-php" dans container docker bien sur

### fr.mailjet.com   au lieu du swifmailer-bundel
       bbadrman@gmail.com
       badrman@1983
       id model :3770328