<?php

namespace mehun\ContentBundle\Form;

use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolverInterface;

class PageType extends AbstractType
{
    /**
     * @param FormBuilderInterface $builder
     * @param array $options
     */
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder
            ->add('title', null, array('label' => 'Naslov objave'))
            ->add('abstract', 'textarea', array('label' => 'Kratki opis objave do 255 znakova'))
            ->add('updated', 'date', array(
                'label' => 'Datum objave posta',
                'input' => 'datetime',
                'html5' => 'true'
            ))
            ->add('content', 'ckeditor', array(
                'label' => 'Sadržaj (Maksimalna širina slike je 600px i 3MB)',
                'config' => array(
                    'filebrowser_image_browse_url' => array(
                        'route' => 'elfinder',
                        'route_parameters' => array('instance' => 'default'),
                    ),
                    'uiColor' => '#ffffff',
                    //...
                ),
            ))
            ->add('category', null, array('label' => 'Odaberite kategoriju objave'))
        ;
    }
    
    /**
     * @param OptionsResolverInterface $resolver
     */
    public function setDefaultOptions(OptionsResolverInterface $resolver)
    {
        $resolver->setDefaults(array(
            'data_class' => 'mehun\ContentBundle\Entity\Page'
        ));
    }

    /**
     * @return string
     */
    public function getName()
    {
        return 'mehun_contentbundle_page';
    }
}
