<?php

namespace App\Controller;

use App\Entity\User;
use App\Service\CheckAuthentication;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\Form\Extension\Core\Type\PasswordType;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\HttpFoundation\Session\Session;
use Symfony\Component\Routing\Annotation\Route;

class UserController extends AbstractController
{
    /**
     * @Route("/", name="authentication")
     */
    public function authentication(Request $request, Session $session, CheckAuthentication $checkAuthentication): Response
    {
        $user = new User();

        $form = $this->createFormBuilder($user)
            ->add('username', TextType::class)
            ->add('password', PasswordType::class)
            ->getForm();

        $form->handleRequest($request);
        if ($form->isSubmitted() && $form->isValid()) {

            // Get data from form
            $user = $form->getData();
            $errorUsername = $checkAuthentication->checkUsernameValidity($user->getUsername());
            $errorPassword = $checkAuthentication->checkPasswordValidity($user->getPassword());

            // Check error on username and password
            if($errorUsername && $errorPassword){
                $userFound = $this->getDoctrine()
                    ->getRepository(User::class)
                    ->findOneBy([
                        'username' => $user->getUsername(),
                        'password' => hash('sha256', $user->getPassword()),
                    ]);

                // Connexion or reject
                if ($userFound === null) {
                    $this->addFlash('error', 'Mot de passe incorrect');
                    $redirection = $this->redirectToRoute('authentication');
                } else {
                    $session->set('username', $userFound->getUsername());
                    $session->set('state', 'connected');

                    $this->addFlash('success', 'Authentification réussite !');
                    $redirection = $this->redirectToRoute('reveal');
                }
                
                return $redirection; 
            } else {
                return $this->render('user/index.html.twig', [
                    'form' => $form->createView(),
                    'errors' => [
                        'username' => !$errorUsername,
                        'password' => !$errorPassword
                    ]
                ]);
            }

        }

        return $this->render('user/index.html.twig', [
            'form' => $form->createView(),
        ]);
    }

    /**
     * @Route("/reveal", name="reveal")
     */
    public function reveal(Session $session): Response
    {
        if ($session->get('state') !== 'connected') {
            $this->addFlash('error', 'Vous ne pouvez pas accèder à cette page sans vous connecter !');
            return $this->redirectToRoute('authentication');
        } else {
            return $this->render('user/reveal.html.twig', [
                'username' => $session->get('username')
            ]);
        }
    }
}
