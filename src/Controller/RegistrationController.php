<?php

namespace App\Controller;

use App\Entity\User;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\Form\Extension\Core\Type\PasswordType;
use Symfony\Component\Form\Extension\Core\Type\RepeatedType;
use Symfony\Component\Form\Extension\Core\Type\SubmitType;
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
        $form = $this->createFormBuilder()
            ->add('username')
            ->add('password', RepeatedType::class, [
                'type' => PasswordType::class,
                'invalid_message' => 'The password fields must match.',
                'options' => ['attr' => ['class' => 'password-field']],
                'required' => true,
                'first_options'  => ['label' => 'Password'],
                'second_options' => ['label' => 'Repeat Password'],
            ])
            ->add('register', SubmitType::class, [
                'attr' => [
                    'class' => 'btn btn-success',
                ],
            ])
            ->getForm();
        
        
        $form->handleRequest($request);
        
        if ($form->isSubmitted()) {
            $data = $form->getData();
            
            // create user object
            $user = new User();
            
            // set username
            $user->setUsername($data['username']);
            
            // set encoded password
            $user->setPassword(
                $passwordEncoder->encodePassword($user, $data['password'])
            );
    
            // get entity manager
            $em = $this->getDoctrine()->getManager();
            
            // save user to database
            $em->persist($user);
            $em->flush();
            
            // redirect to login page
            return $this->redirect($this->generateUrl('app_login'));
        }
        
        return $this->render('registration/index.html.twig', [
            'controller_name' => 'RegistrationController',
            'form' => $form->createView(),
        ]);
    }
}
