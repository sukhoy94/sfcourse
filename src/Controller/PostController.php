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
 * @Route ("/posts", name="posts")
 */
class PostController extends AbstractController
{
    /**
     * @Route("/", name=".index")
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
     * @return Response
     */
    public function show($id, PostRepository $postRepository): Response
    {
        $post = $postRepository->find($id);
        
        return $this->render('post/show.html.twig', [
            'post' => $post,
        ]);
    }
    
    /**
     * @Route ("/delete/{id}")
     * @param Post $post
     * @return \Symfony\Component\HttpFoundation\RedirectResponse
     */
    public function delete(Post $post): \Symfony\Component\HttpFoundation\RedirectResponse
    {
        $entityManager = $this->getDoctrine()->getManager();
        $entityManager->remove($post);
        $entityManager->flush();
        
        return $this->redirect($this->generateUrl('posts.index'));
    }   
}
