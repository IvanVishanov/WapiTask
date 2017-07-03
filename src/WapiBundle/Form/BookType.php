<?php

namespace WapiBundle\Form;

use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\Type\DateType;
use Symfony\Component\Form\Extension\Core\Type\FileType;
use Symfony\Component\Form\Extension\Core\Type\IntegerType;
use Symfony\Component\Form\Extension\Core\Type\NumberType;
use Symfony\Component\Form\Extension\Core\Type\TextareaType;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;

class BookType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder->add('title', TextType::class)
            ->add('author',TextType::class)
            ->add('cover',FileType::class)
            ->add('pageCount',IntegerType::class)
            ->add('iSBN', TextType::class)
            ->add('datePublished', DateType::class,[
                'widget' => 'single_text',
                'placeholder' => 'Publish Date',
            ])
            ->add('resume',TextareaType::class)
            ->add('format');
    }

    public function configureOptions(OptionsResolver $resolver)
    {
        $resolver->setDefaults(array(
            'data_class' => 'WapiBundle\Entity\Book',
        ));
    }
}
