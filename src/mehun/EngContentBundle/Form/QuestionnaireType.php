<?php

namespace mehun\EngContentBundle\Form;

use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolverInterface;
use Symfony\Component\Validator\Constraints\Email;
use Symfony\Component\Validator\Constraints\Length;
use Symfony\Component\Validator\Constraints\NotBlank;
use Symfony\Component\Validator\Constraints\Collection;

class QuestionnaireType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder
            ->add('organization_unit', 'text', array(
                'attr' => array(
                    'placeholder' => '',
                    'pattern'     => '.{2,}',
                    'label' => 'Organization unit:'
                )
            ))
            ->add('email', 'email', array(
                'attr' => array(
                    'placeholder' => 'yourname@example.com'
                )
            ))
            ->add('quality_contentment', 'choice', array(
                'choices' => array(
                    'one' => 'Bad',
                    'two' => 'Good',
                    'three' => 'Excelent'),
                'multiple' => false
            ))
            ->add('prices_services_ratio', 'choice', array(
                'choices' => array(
                    'one' => 'Bad',
                    'two' => 'Good',
                    'three' => 'Excelent'),
                'multiple' => false
            ))
            ->add('information_and_awareness_about_our_laboratory_offer', 'choice', array(
                'choices' => array(
                    'one' => 'Bad',
                    'two' => 'Good',
                    'three' => 'Excelent'),
                'multiple' => false
            ))
            ->add('comments_and_objection_about_products', 'textarea', array(
                'attr' => array(
                    'cols' => 90,
                    'rows' => 10,
                    'placeholder' => ''
                )
            ))
            ->add('comments_and_objections_about_business_attitude', 'textarea', array(
                'attr' => array(
                    'cols' => 90,
                    'rows' => 10,
                    'placeholder' => ''
                )
            ))
            ->add('conclusion_and_suggestions', 'textarea', array(
                'attr' => array(
                    'cols' => 90,
                    'rows' => 10,
                    'placeholder' => ''
                )
            ))
            ->add('submit', 'submit', array(
                'label' => 'Send'
            ))

        ;
    }

    public function setDefaultOptions(OptionsResolverInterface $resolver)
    {
        $collectionConstraint = new Collection(array(
            'organization_unit' => array(
                new NotBlank(array('message' => 'This field cannot be empty!')),
                new Length(array('min' => 2))
            ),
            'email' => array(
                new NotBlank(array('message' => 'This field cannot be empty!')),
                new Email(array('message' => 'Neispravna email adresa.'))
            ),
            'quality_contentment' => array(
                new NotBlank(array('message' => 'You have to choose one option!')),
            ),
            'prices_services_ratio' => array(
                new NotBlank(array('message' => 'You have to choose one option!')),
            ),
            'information_and_awareness_about_our_laboratory_offer' => array(
                new NotBlank(array('message' => 'You have to choose one option!')),
            ),
            'comments_and_objections_about_products' => array(
                new Length(array('max' => 500)),
            ),
            'comments_and_objections_about_business_attitude' => array(
                new Length(array('max' => 500)),
            ),
            'conclusion_and_suggestions' => array(
                new Length(array('max' => 500)),
            )
        ));

        $resolver->setDefaults(array(
            'constraints' => $collectionConstraint
        ));
    }

    public function getName()
    {
        return 'questionnaire';
    }
}
