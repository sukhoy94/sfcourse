<?php


namespace App\Controller;


use App\Entity\Article;
use App\Form\ArticleFormType;
use App\Repository\ArticleRepository;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\Validator\Constraints\Date;


/**
 * Class ArticleController
 * @package App\Controller
 * 
 * @route("/articles", name="articles")
 */
class ArticleController extends AbstractController
{
    public function index()
    {        
        
    }
    
    /**
     * @route("/create", name=".create")
     * @return \Symfony\Component\HttpFoundation\Response
     */
    public function create(Request $request)
    {
        $form = $this->createForm(ArticleFormType::class);
        $form->handleRequest($request);
        
        if ($form->isSubmitted() && $form->isValid()) {
            $article = $form->getData();
 
            $em = $this->getDoctrine()->getManager();
            $em->persist($article);
            $em->flush();
    
            $this->addFlash('success', 'Article Created! Knowledge is power!');           
            return $this->redirectToRoute('articles.list');
        }
        
    
        return $this->render('articles/create.html.twig', [
            'articleForm' => $form->createView(),
        ]);
    }
    
    /**
     * @param ArticleRepository $repository
     * @route("/list", name=".list")
     */
    public function list(ArticleRepository $repository) 
    {
        $articles = $repository->findAll();
        
        return $this->render('articles/list.html.twig', [
            'articles' => $articles,
        ]);
    }
}