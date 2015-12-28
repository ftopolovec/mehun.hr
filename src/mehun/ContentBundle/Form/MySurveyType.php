<?php

namespace mehun\ContentBundle\Form;

use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolverInterface;
use Symfony\Component\Validator\Constraints\Email;
use Symfony\Component\Validator\Constraints\Length;
use Symfony\Component\Validator\Constraints\NotBlank;
use Symfony\Component\Validator\Constraints\Collection;

class MySurveyType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder
            ->add('organizacijska_jedinica', 'text', array(
                'attr' => array(
                    'placeholder' => '',
                    'pattern'     => '.{2,}',
                    'label' => 'Organizacijska jedinica:'
                )
            ))
            ->add('email', 'email', array(
                'attr' => array(
                    'placeholder' => 'vaseime@primjer.com'
                )
            ))
            ->add('zadovoljstvo_kvalitetom', 'choice', array(
                'choices' => array(
                    'one' => 'Dobro',
                    'two' => 'Loše',
                    'three' => 'Odlično'),
                'multiple' => false
            ))
            ->add('omjer_cijena-usluga', 'choice', array(
                'choices' => array(
                    'one' => 'Dobar',
                    'two' => 'Loš',
                    'three' => 'Odličan'),
                'multiple' => false
                ))
            ->add('informiranost_o_ponudi_laboratorija', 'choice', array(
                'choices' => array(
                    'one' => 'Dobra',
                    'two' => 'Loša',
                    'three' => 'Odlična'),
                'multiple' => false
            ))
            ->add('primjedbe_na_proizvode', 'textarea', array(
                'attr' => array(
                    'cols' => 90,
                    'rows' => 10,
                    'placeholder' => ''
                )
            ))
            ->add('primjedbe_na_poslovni_stav', 'textarea', array(
                'attr' => array(
                    'cols' => 90,
                    'rows' => 10,
                    'placeholder' => ''
                )
            ))
            ->add('zakljucak_ili_sugestija', 'textarea', array(
                'attr' => array(
                    'cols' => 90,
                    'rows' => 10,
                    'placeholder' => ''
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
            'organizacijska_jedinica' => array(
                new NotBlank(array('message' => 'Ovo polje ne smije biti prazno!')),
                new Length(array('min' => 2))
            ),
            'email' => array(
                new NotBlank(array('message' => 'Ovo polje ne smije biti prazno!')),
                new Email(array('message' => 'Neispravna email adresa.'))
            ),
            'zadovoljstvo_kvalitetom' => array(
                new NotBlank(array('message' => 'Morate odabrati jednu opciju!')),
            ),
            'omjer_cijena-usluga' => array(
                new NotBlank(array('message' => 'Morate odabrati jednu opciju!')),
            ),
            'informiranost_o_ponudi_laboratorija' => array(
                new NotBlank(array('message' => 'Morate odabrati jednu opciju!')),
            ),
            'primjedbe_na_proizvode' => array(
                new Length(array('max' => 500)),
            ),
            'primjedbe_na_poslovni_stav' => array(
                new Length(array('max' => 500)),
            ),
            'zakljucak_ili_sugestija' => array(
                new Length(array('max' => 500)),
            )
        ));

        $resolver->setDefaults(array(
            'constraints' => $collectionConstraint
        ));
    }

    public function getName()
    {
        return 'anketa';
    }
}
