<?php

namespace App\Form;

use App\Entity\User;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\Type\ChoiceType;
use Symfony\Component\Form\Extension\Core\Type\EmailType;
use Symfony\Component\Form\Extension\Core\Type\FileType;
use Symfony\Component\Form\Extension\Core\Type\IntegerType;
use Symfony\Component\Form\Extension\Core\Type\PasswordType;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\Extension\Core\Type\TextareaType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;

class UserType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options): void
    {
        $isEdit = $options['edit_mode'] ?? false;
        
        $builder
            ->add('firstName', TextType::class, [
                'label' => 'First Name',
                'required' => false,
                'attr' => [
                    'class' => 'form-control',
                    'placeholder' => 'John'
                ]
            ])
            ->add('lastName', TextType::class, [
                'label' => 'Last Name',
                'required' => false,
                'attr' => [
                    'class' => 'form-control',
                    'placeholder' => 'Doe'
                ]
            ])
            ->add('age', IntegerType::class, [
                'label' => 'Age',
                'required' => false,
                'attr' => [
                    'class' => 'form-control',
                    'placeholder' => '25'
                ]
            ])
            ->add('email', EmailType::class, [
                'label' => 'Email',
                'required' => false,
                'attr' => [
                    'class' => 'form-control',
                    'placeholder' => 'john.doe@example.com'
                ]
            ])
            ->add('username', TextType::class, [
                'label' => 'Username',
                'required' => false,
                'attr' => [
                    'class' => 'form-control',
                    'placeholder' => 'johndoe'
                ]
            ])
            ->add('role', ChoiceType::class, [
                'label' => 'Role',
                'choices' => [
                    'Admin' => 'ADMIN',
                    'Enseignant' => 'ENSEIGNANT',
                    'User' => 'USER',
                ],
                'required' => false,
                'attr' => ['class' => 'form-control']
            ])
            ->add('status', ChoiceType::class, [
                'label' => 'Status',
                'choices' => [
                    'Active' => 'active',
                    'Inactive' => 'inactive',
                    'Pending' => 'pending',
                ],
                'required' => false,
                'attr' => ['class' => 'form-control']
            ])
            ->add('bio', TextareaType::class, [
                'label' => 'Notes',
                'required' => false,
                'attr' => [
                    'class' => 'form-control',
                    'rows' => 4,
                    'placeholder' => 'Additional notes about this user...'
                ]
            ])
            ->add('photoFile', FileType::class, [
                'label' => 'Photo de profil (JPG/PNG, max 2Mo)',
                'mapped' => false,
                'required' => false,
                'attr' => [
                    'class' => 'form-control',
                    'accept' => 'image/jpeg,image/jpg,image/png'
                ]
            ]);

        if (!$isEdit) {
            $builder->add('plainPassword', PasswordType::class, [
                'label' => 'Password',
                'required' => false,
                'mapped' => false,
                'attr' => [
                    'class' => 'form-control',
                    'placeholder' => 'Minimum 8 characters'
                ]
            ]);
        } else {
            $builder->add('plainPassword', PasswordType::class, [
                'label' => 'New Password (leave blank to keep current)',
                'required' => false,
                'mapped' => false,
                'attr' => [
                    'class' => 'form-control',
                    'placeholder' => 'Leave blank to keep current password'
                ]
            ]);
        }
    }

    public function configureOptions(OptionsResolver $resolver): void
    {
        $resolver->setDefaults([
            'data_class' => User::class,
            'edit_mode' => false,
        ]);

        $resolver->setAllowedTypes('edit_mode', 'bool');
    }
}