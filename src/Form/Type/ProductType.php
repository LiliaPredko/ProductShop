<?php


namespace App\Form\Type;

use App\Entity\Category;
use App\Entity\Order;
use App\Entity\Product;
use Symfony\Bridge\Doctrine\Form\Type\EntityType;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\Type\ChoiceType;
use Symfony\Component\Form\Extension\Core\Type\FileType;
use Symfony\Component\Form\Extension\Core\Type\NumberType;
use Symfony\Component\Form\Extension\Core\Type\SubmitType;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\FormBuilderInterface;


class ProductType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options): void
    {
        $builder
            ->add('name', TextType::class)
            ->add('description', TextType::class)
            ->add('price', NumberType::class)
            ->add('discount', ChoiceType::class, [
                'choices'             => [
                    'No'              => Product::DISCOUNT_NO,
                    'Sale 30%'        => Product::DISCOUNT_SALE,
                    'Two for one'     => Product::DISCOUNT_TWO_FOR_ONE,
                    'More than three' => Product::DISCOUNT_MORE_THAN_THREE,
                ],
            ])
            ->add('image', FileType::class, [
                'label'    => 'Image',
                'mapped'   => false,
                'required' => false,
            ])
            ->add('category', EntityType::class, [
                'class'        => Category::class,
                'choice_label' => function ($category) {
                    return $category->getName();
                }
            ])
            ->add('save', SubmitType::class, ['label' => 'Save'])
        ;
    }
}