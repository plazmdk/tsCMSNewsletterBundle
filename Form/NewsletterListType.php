<?php
/**
 * Created by PhpStorm.
 * User: plazm
 * Date: 7/13/14
 * Time: 9:51 PM
 */

namespace tsCMS\NewsletterBundle\Form;


use Doctrine\ORM\EntityRepository;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolverInterface;
use tsCMS\TemplateBundle\Entity\Template;

class NewsletterListType extends AbstractType {

    /**
     * @param FormBuilderInterface $builder
     * @param array $options
     */
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder
            ->add('title', "text", array(
                'label' => 'newsletterlist.title',
                'required' => true
            ))
            ->add("save","submit",array(
                'label' => 'newsletterlist.save',
            ));

        ;
    }

    /**
     * @param OptionsResolverInterface $resolver
     */
    public function setDefaultOptions(OptionsResolverInterface $resolver)
    {
        $resolver->setDefaults(array(
            'data_class' => 'tsCMS\NewsletterBundle\Entity\NewsletterList'
        ));
    }

    /**
     * @return string
     */
    public function getName()
    {
        return 'tscms_newsletterbundle_newsletterlisttype';
    }
} 