<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class MainController extends AbstractController
{
    /**
     * @Route("/", name="main")
     */
    public function index(): Response
    {
        return $this->render('home/main.html.twig');
    }
    
    /**
     * @Route("/about", name="about")
     * @return Response
     */
    public function about(): Response
    {
        return $this->render('home/about.html.twig');
    }
    
    /**
     * @Route("/posts/{id}", name="postDetail")
     * @param Request $request
     * @return Response
     */
    public function singlePost(Request $request)
    {
        dump($request->get('id'));
    
        return new Response('Single post');
    }
    
}
