<?php


namespace App\Form;


use App\Entity\Article;
use App\Entity\User;
use App\Repository\UserRepository;
use Symfony\Bridge\Doctrine\Form\Type\EntityType;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\Type\TextareaType;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;

class ArticleFormType extends AbstractType
{
    private $userRepository;
    
    public function __construct(UserRepository $repository) 
    {
        $this->userRepository = $repository;
    }
    
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder
            ->add('title', TextType::class, [
                'help' => 'add title'
            ])
            ->add('body', TextareaType::class, [
                'required' => true,
            ])
            ->add('author_name', EntityType::class, [
                'class' => User::class,
                'placeholder' => 'Choose an author',                
                'choices' => $this->userRepository->findAllUsersAlphabetically(),
                'invalid_message' => 'Symfony is too smart for your hacking!',
            ])
            ->add('created_at', null, [
                'widget' => 'single_text'
            ])
        ;
    }
    
    public function configureOptions(OptionsResolver $resolver)
    {
        $resolver->setDefaults([
            'data_class' => Article::class,
        ]);   
    }
}