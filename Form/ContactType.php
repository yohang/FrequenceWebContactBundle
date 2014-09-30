<?php

namespace FrequenceWeb\Bundle\ContactBundle\Form;

use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;

/**
 * The contact form
 *
 * @author Yohan Giarelli <yohan@giarel.li>
 */
class ContactType extends AbstractType
{
    /**
     * @{inheritDoc}
     */
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder
            ->add('name', 'text', array(
                'label' => 'form.name',
                'translation_domain' => 'FrequenceWebContactBundle'))
            ->add('email', 'email', array(
                'label' => 'form.email',
                'translation_domain' => 'FrequenceWebContactBundle'))
            ->add('subject', 'text', array(
                'label' => 'form.subject',
                'translation_domain' => 'FrequenceWebContactBundle'))
            ->add('body', 'textarea', array(
                'label' => 'form.body',
                'translation_domain' => 'FrequenceWebContactBundle'))
        ;
    }

    /**
     * @{inheritDoc}
     */
    public function getName()
    {
        return 'contact';
    }
}
