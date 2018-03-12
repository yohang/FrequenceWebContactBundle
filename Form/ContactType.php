<?php

namespace FrequenceWeb\Bundle\ContactBundle\Form;

use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\Type\EmailType;
use Symfony\Component\Form\Extension\Core\Type\TextareaType;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\FormBuilderInterface;

use EWZ\Bundle\RecaptchaBundle\Form\Type\EWZRecaptchaType;

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
            ->add('name', TextType::class, array(
                'label' => 'form.name',
                'translation_domain' => 'FrequenceWebContactBundle'))
            ->add('email', EmailType::class, array(
                'label' => 'form.email',
                'translation_domain' => 'FrequenceWebContactBundle'))
            ->add('subject', TextType::class, array(
                'label' => 'form.subject',
                'translation_domain' => 'FrequenceWebContactBundle'))
            ->add('body', TextareaType::class, array(
                'label' => 'form.body',
                'translation_domain' => 'FrequenceWebContactBundle'))
            ->add('recaptcha', EWZRecaptchaType::class, array(
                'label' => false,
                'mapped' => false,
            ))
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
