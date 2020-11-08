<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class MainController extends AbstractController
{
    /**
     * @Route("/", name="main")
     */
    public function index(): Response
    {
        return new Response('Main');
    }
    
    /**
     * @Route("/about", name="about")
     * @return Response
     */
    public function about(): Response
    {
        return new Response('About');
    }
    
}
