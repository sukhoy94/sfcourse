<?php

namespace App\Controller;

use App\Entity\User;
use App\Form\RegisterType;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\Security\Core\Encoder\UserPasswordEncoderInterface;

class RegistrationController extends AbstractController
{
    /**
     * @Route("/registration", name="registration")
     * @param Request $request
     * @param UserPasswordEncoderInterface $passwordEncoder
     * @return Response
     */
    public function index(Request $request, UserPasswordEncoderInterface $passwordEncoder): Response
    {
        $user = new User();
        $form = $this->createForm(RegisterType::class, $user);
        $form->handleRequest($request);       
        
        if ($form->isSubmitted() && $form->isValid()) {
            $user = new User();            
            
            $user->setUsername($form->getData()->getUsername());            
            $user->setPassword(
                $passwordEncoder->encodePassword($user, $form->getData()->getPassword())
            );    
            $em = $this->getDoctrine()->getManager();
            
            $em->persist($user);
            $em->flush();
            
            // redirect to login page
            return $this->redirect($this->generateUrl('app_login'));
        }
        
        return $this->render('registration/index.html.twig', [
            'form' => $form->createView(),
        ]);
    }
}
