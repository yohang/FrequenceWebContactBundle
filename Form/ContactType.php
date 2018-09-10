<?php

namespace FrequenceWeb\Bundle\ContactBundle\Form;

use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\Type\EmailType;
use Symfony\Component\Form\Extension\Core\Type\TextareaType;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\Extension\Core\Type\ChoiceType;
use Symfony\Component\Form\FormBuilderInterface;

use EWZ\Bundle\RecaptchaBundle\Form\Type\EWZRecaptchaType;
use Symfony\Component\OptionsResolver\OptionsResolver;

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
        $this->addSubjet($builder, $options);

        $builder
            ->add('name', TextType::class, array(
                'label' => 'form.name',
                'translation_domain' => 'FrequenceWebContactBundle'))
            ->add('email', EmailType::class, array(
                'label' => 'form.email',
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

    private function addSubjet(FormBuilderInterface $builder, array $options) {
        if(count($options["fixed_to_and_subject"]) > 0) {

            $subject = $options["fixed_to_and_subject"];
            $field_data = array();
            $i = 0;
            foreach ($subject as $s) {
                $field_data[$s["title"]] = $i;
                $i++;
            }

            $builder
                ->add('subject', ChoiceType::class, array(
                    'label' => 'form.subject',
                    'translation_domain' => 'FrequenceWebContactBundle',
                    'choices' => $field_data
                ));
        } else {
            $builder
                ->add('subject', TextType::class, array(
                        'label' => 'form.subject',
                        'translation_domain' => 'FrequenceWebContactBundle')
                );
        }
    }

    /**
     * @{inheritDoc}
     */
    public function getName()
    {
        return 'contact';
    }


    public function configureOptions(OptionsResolver $resolver)
    {
        $resolver->setRequired('fixed_to_and_subject');
    }
}
