<?php

namespace mehun\ContentBundle\Form;

use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolverInterface;
use Symfony\Component\Validator\Constraints\Email;
use Symfony\Component\Validator\Constraints\Length;
use Symfony\Component\Validator\Constraints\NotBlank;
use Symfony\Component\Validator\Constraints\Collection;

class ContactType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder
            ->add('ime', 'text', array(
                'attr' => array(
                    'placeholder' => 'Vaše cijenjeno ime?',
                    'pattern'     => '.{2,}' //minlength
                )
            ))
            ->add('email', 'email', array(
                'attr' => array(
                    'placeholder' => 'Da bi vam mogli odgovoriti'
                )
            ))
            ->add('predmet', 'text', array(
                'attr' => array(
                    'placeholder' => 'Predmet Vaše poruke',
                    'pattern'     => '.{3,}' //minlength
                )
            ))
            ->add('poruka', 'textarea', array(
                'attr' => array(
                    'cols' => 90,
                    'rows' => 10,
                    'placeholder' => 'Vaša poruka za nas...'
                )
            ))
            ->add('submit', 'submit', array(
                'label' => 'Pošalji'
            ))
        ;
    }

    public function setDefaultOptions(OptionsResolverInterface $resolver)
    {
        $collectionConstraint = new Collection(array(
            'ime' => array(
                new NotBlank(array('message' => 'Name should not be blank.')),
                new Length(array('min' => 2))
            ),
            'email' => array(
                new NotBlank(array('message' => 'Email should not be blank.')),
                new Email(array('message' => 'Invalid email address.'))
            ),
            'predmet' => array(
                new NotBlank(array('message' => 'Subject should not be blank.')),
                new Length(array('min' => 3))
            ),
            'poruka' => array(
                new NotBlank(array('message' => 'Message should not be blank.')),
                new Length(array('min' => 5))
            )
        ));

        $resolver->setDefaults(array(
            'constraints' => $collectionConstraint
        ));
    }

    public function getName()
    {
        return 'contact';
    }
}