<?php

namespace App\Form;

use App\Entity\Category;
use App\Entity\Room;
use Symfony\Bridge\Doctrine\Form\Type\EntityType;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\Type\CheckboxType;
use Symfony\Component\Form\Extension\Core\Type\FileType;
use Symfony\Component\Form\Extension\Core\Type\IntegerType;
use Symfony\Component\Form\Extension\Core\Type\TextareaType;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;

class RoomType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder
            ->add('name',TextType::class)
            ->add('capacity',IntegerType::class)
            ->add('category',EntityType::class,[
                'class'=>Category::class
            ])
            ->add('city',TextType::class)
            ->add('hasWifi',CheckboxType::class,[
                'required'=>false
            ])
            ->add('description',TextareaType::class)
            ->add('imageFile',FileType::class,[
                'required'=>false
            ])
        ;
    }

    public function configureOptions(OptionsResolver $resolver)
    {
        $resolver->setDefaults([
            'data_class' => Room::class,
            'translation_domain'=>'room_form'
        ]);
    }
}
