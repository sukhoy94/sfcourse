<?php


namespace App\Controller;


use App\Form\ArticleFormType;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\Routing\Annotation\Route;


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
    public function create()
    {
        $form = $this->createForm(ArticleFormType::class);
    
        return $this->render('articles/create.html.twig', [
            'articleForm' => $form->createView(),
        ]);
    }    
}