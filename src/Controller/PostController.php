<?php

namespace App\Controller;

use App\Entity\Post;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

/**
 * Class PostController
 * @package App\Controller
 * @Route ("/post", name="post")
 */
class PostController extends AbstractController
{
    /**
     * @Route("/post", name="post.")
     */
    public function index(): Response
    {
        return $this->render('post/index.html.twig', [
            'controller_name' => 'PostController',
        ]);
    }
    
    /**
     * @Route ("/create", name="create")
     * @return Response
     */
    public function create(): Response
    {
        
        $post = new Post();
        $post->setTitle('Firts post');
        $em = $this->getDoctrine()->getManager();
        $em->persist($post);
        $em->flush();
        
        return new Response("Post created");
    }
}
