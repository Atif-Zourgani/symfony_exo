<?php

namespace App\Form;

use App\Entity\Author;
use App\Entity\Book;
use Symfony\Bridge\Doctrine\Form\Type\EntityType;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\Type\CheckboxType;
use Symfony\Component\Form\Extension\Core\Type\ChoiceType;
use Symfony\Component\Form\Extension\Core\Type\IntegerType;
use Symfony\Component\Form\Extension\Core\Type\SubmitType;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;
use function Symfony\Bridge\Twig\Extension\twig_is_selected_choice;



//\\\\\////////\\\\\\\\\\\\//////////////\\\\\\\\\\\\\\\\\\\/////////////\\\\\\\\\\\\\\///////////
///////\\\\\\\\////////////Création d'un formulaire by symfo \\\\\\\\\\\\//////////////\\\\\\\\\\\
//\\\\\////////\\\\\\\\\\\\//////////////\\\\\\\\\\\\\\\\\\\/////////////\\\\\\\\\\\\\\///////////
class BookType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder // #####::class = type du champ / label = changer le nom qui va s'afficher /required = rendre le champ obligatoire
            ->add('title', TextType::class, ['label'=>'titre'])
            ->add('NBpages', IntegerType::class, [
                'label'=>'Nombre de pages',
                'required' => false
            ])
                                //choice type= faire une liste de choix
            ->add('style', ChoiceType::class,[
                                    'choices' => [
                                        'education' => 'education',
                                        'roman' => 'roman',
                                        'manga' => 'manga',
                                        'BD' => 'BD'
                                    ],
                                    'label' => 'Style'
                                ])
            ->add('authors', EntityType::class, [
                'class' => Author::class,
                'choice_label' => 'name'])
            ->add('InStock', CheckboxType::class, [
                'label'=>'Stock',
                'attr'=>[
                    'required'=>false
                ]
            ])
            //      1er parametre= se qui va s'afficher/ 2iem parametre = le type /
            ->add('Envoyer', SubmitType::class)
        ;
    }

    public function configureOptions(OptionsResolver $resolver)
    {
        $resolver->setDefaults([
            'data_class' => Book::class,
        ]);
    }
}
