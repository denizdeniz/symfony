<?php

namespace App\Controller;

use Symfony\Component\Routing\Annotation\Route;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use FOS\UserBundle\Util\TokenGeneratorInterface;

class DefaultController extends Controller
{

    public function index(TokenGeneratorInterface $tokenGenerator)
    {

        $entityManager = $this->getDoctrine()->getManager();

        $user = $this->get('security.token_storage')->getToken()->getUser();
        $token = "";
        if(is_object($user)){
            $token = $user->getConfirmationToken();

            if (!$token) {
                $user->setConfirmationToken($tokenGenerator->generateToken());
                $user->setPasswordRequestedAt(new \DateTime());
                $token = $user->getConfirmationToken();
                $entityManager->persist($user);
                $entityManager->flush();
            }
        }

        return $this->render('default/index.html.twig', array('token' => $token));

    }
}
