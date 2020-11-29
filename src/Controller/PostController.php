<?php

namespace App\Controller;

use App\Entity\Post;
use App\Repository\PostRepository;
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
     * @Route("/", name="post.")
     */
    public function index(PostRepository $postRepository): Response
    {
        $posts = $postRepository->findAll();
        
        return $this->render('post/index.html.twig', [
            'controller_name' => 'PostController',
            'posts' => $posts,
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
    
    /**
     * @Route ("/show/{id}")
     * @param $id
     * @param PostRepository $postRepository
     */
    public function show($id, PostRepository $postRepository) 
    {
        $post = $postRepository->find($id);
        
        return $this->render('post/show.html.twig', [
            'post' => $post,
        ]);
    }
}
