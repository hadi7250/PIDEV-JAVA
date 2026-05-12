<?php

namespace App\Form;

use App\Entity\ForumCategory;
use App\Entity\ForumDiscussion;
use Symfony\Bridge\Doctrine\Form\Type\EntityType;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\Extension\Core\Type\TextareaType;
use Symfony\Component\Form\Extension\Core\Type\FileType;
use Symfony\Component\Validator\Constraints\Callback;
use Symfony\Component\Validator\Context\ExecutionContextInterface;

class ForumDiscussionType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options): void
    {
        $builder
            ->add('title', TextType::class, [
                'label' => 'Discussion Title',
                'required' => false,
                'attr' => [
                    'class' => 'form-control',
                    'placeholder' => 'Enter a clear and concise title...'
                ]
            ])
            ->add('content', TextareaType::class, [
                'label' => 'Content',
                'required' => false,
                'attr' => [
                    'class' => 'form-control',
                    'rows' => 8,
                    'placeholder' => 'Describe your topic in detail...'
                ]
            ])
            ->add('category', EntityType::class, [
                'label' => 'Category',
                'class' => ForumCategory::class,
                'choice_label' => 'name',
                'placeholder' => 'Select a category',
                'required' => false,
                'attr' => [
                    'class' => 'form-control'
                ]
            ]);
    }

    public function configureOptions(OptionsResolver $resolver): void
    {
        $resolver->setDefaults([
            'data_class' => ForumDiscussion::class,
            'constraints' => [
                new Callback([$this, 'validateCategory']),
            ],
        ]);
    }

    public function validateCategory(ForumDiscussion $discussion, ExecutionContextInterface $context): void
    {
        if ($discussion->getCategory() === null) {
            $context->buildViolation('Please select a category for your discussion.')
                ->atPath('category')
                ->addViolation();
        }
    }
}
