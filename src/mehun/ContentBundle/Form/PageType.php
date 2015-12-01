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
            ->add('title')
            ->add('abstract')
            ->add('updated')
            ->add('content', 'ckeditor', array(
                'config' => array(
                    'filebrowser_image_browse_url' => array(
                        'route' => 'elfinder',
                        'route_parameters' => array('instance' => 'default'),
                    ),
                    'uiColor' => '#ffffff',
                    //...
                ),
            ))
            ->add('category')
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
