<?php

namespace App\Controller;

use App\Entity\User;
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
    public function authentication(Request $request, Session $session): Response
    {
        $user = new User();

        $form = $this->createFormBuilder($user)
            ->add('username', TextType::class)
            ->add('password', PasswordType::class)
            ->getForm();

        $form->handleRequest($request);
        if ($form->isSubmitted() && $form->isValid()) { 

            // TODO : Vérifier le nombre de caractères du mot de passe + l'integrité des deux champs
            // Class utilitaire vérification
            // Class utilitaire de génération de mot de passe

            $user = $form->getData();

            $userFound = $this->getDoctrine()
                ->getRepository(User::class)
                ->findOneBy([
                    'username' => $user->getUserName(),
                    'password' => hash('md5', $user->getPassword()),
                ]);

            if ($userFound === null) {
                $this->addFlash('error', 'Mot de passe incorrect');
                return $this->redirectToRoute('authentication');
            } else {

                $session->set('username', $userFound->getUsername());
                $session->set('state', 'connected');

                $this->addFlash('success', 'Authentification réussite !');
                return $this->redirectToRoute('reveal');
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
