<?php

namespace FrequenceWeb\Bundle\ContactBundle\Form;

use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\Type\EmailType;
use Symfony\Component\Form\Extension\Core\Type\TextareaType;
use Symfony\Component\Form\Extension\Core\Type\TextType;
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
            ->add('name', TextType::class)
            ->add('email', EmailType::class)
            ->add('subject', TextType::class)
            ->add('body', TextareaType::class)
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
