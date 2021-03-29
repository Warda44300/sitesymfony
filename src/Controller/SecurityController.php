<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\HttpFoundation\Request;
use Doctrine\ORM\EntityManagerInterface;
use App\Entity\User;
use App\Form\RegistrationType;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\Extension\Core\Type\SubmitType;
use Symfony\Component\Security\Core\Encoder\UserPasswordEncoderInterface;
use App\Security\LoginFormAuthenticator;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\Security\Guard\GuardAuthenticatorHandler;



class SecurityController extends AbstractController
{
	/**
	* @Route("/inscription", name="security_registration")
	*/
	public function registration(Request $request, EntityManagerInterface $manager, UserPasswordEncoderInterface $encoder, GuardAuthenticatorHandler $guardHandler, LoginFormAuthenticator $authenticator) {
		$user = new user();

		$form = $this->createForm(RegistrationType:: class, $user);

		$form->handleRequest($request);

		if($form->isSubmitted() && $form->isValid()){

			$hash = $encoder->encodePassword($user, $user->getPassword());

			$user->setPassword($hash);

			$manager->persist($user);
			$manager->flush();

			return $guardHandler->authenticateUserAndHandleSuccess(
                $user,
                $request,
                $authenticator,
                'main' // firewall name in security.yaml
            );
		}

		return $this->render('security/registration.html.twig', [
			'form' => $form->createView()
		]);
   }

   /**
   * @Route("/login", name="security_login")
   */
 	public function login() {
 		return $this->render('security/login.html.twig');
 	}

 	/**
 	* @Route("/deconnexion", name="security_logout")
 	*/
 	public function logout() {}
}



// manager persist permet de garder mon utilisateur par exemple dans le temps
// la fonction flush envoie la réquête mysql qui mettre en place les différente manipulation faite dans la function