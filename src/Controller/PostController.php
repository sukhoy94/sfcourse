<?php

namespace App\Controller;

use App\Entity\Post;
use App\Form\PostType;
use App\Repository\PostRepository;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\File\UploadedFile;
use Symfony\Component\HttpFoundation\RedirectResponse;
use Symfony\Component\HttpFoundation\Request;
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
     * @Route ("/create", name=".create")
     * @param Request $request
     * @return Response
     */
    public function create(Request $request): Response
    {
        $post = new Post();
        $form = $this->createForm(PostType::class, $post);
        $form->handleRequest($request);
        
        if ($form->isSubmitted()) {
            /** @var UploadedFile $file */
            $file = $request->files->get('post')['image'];
            
            if ($file) {
                $fileName = md5(uniqid()) . '.' . $file->guessClientExtension();
                $file->move(
                    $this->getParameter('uploads_dir'),
                    $fileName
                );
                
                $post->setImage($fileName);
            }
            
            $entityManager = $this->getDoctrine()->getManager();
            $entityManager->persist($post);
            $entityManager->flush();
            
            return $this->redirect($this->generateUrl('posts.index'));
        }
        
        return $this->render('post/create.html.twig', [
            'form' => $form->createView(),
        ]);
    }
    
    /**
     * @Route ("/show/{id}", name=".show")
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
     * @Route ("/delete/{id}", name=".delete")
     * @param Post $post
     * @return RedirectResponse
     */
    public function delete(Post $post): RedirectResponse
    {
        $entityManager = $this->getDoctrine()->getManager();
        $entityManager->remove($post);
        $entityManager->flush();
        
        $this->addFlash('success', 'Post was successfully removed');
        
        return $this->redirect($this->generateUrl('posts.index'));
    }   
}
