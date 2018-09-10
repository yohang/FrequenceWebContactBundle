<?php

namespace FrequenceWeb\Bundle\ContactBundle\EventDispatcher\Listener;

use FrequenceWeb\Bundle\ContactBundle\EventDispatcher\Event\MessageSubmitEvent;
use Symfony\Component\Templating\EngineInterface;
use Symfony\Component\Translation\TranslatorInterface;

/**
 * Listener for contact events, that sends emails
 *
 * @author Yohan Giarelli <yohan@giarel.li>
 */
class EmailContactListener
{
    /**
     * @var \Swift_Mailer
     */
    protected $mailer;

    /**
     * @var TranslatorInterface
     */
    protected $translator;

    /**
     * @var EngineInterface
     */
    protected $templating;

    /**
     * @var array
     */
    protected $config;

    /**
     * @param \Swift_Mailer       $mailer
     * @param EngineInterface     $templating
     * @param TranslatorInterface $translator
     * @param array<string>       $config     Configuration from DIC
     */
    public function __construct(\Swift_Mailer $mailer, EngineInterface $templating, TranslatorInterface $translator, array $config)
    {
        $this->mailer     = $mailer;
        $this->templating = $templating;
        $this->translator = $translator;
        $this->config     = $config;
    }

    /**
     * Called when onMessageSubmit event is fired
     *
     * @param MessageSubmitEvent $event
     */
    public function onMessageSubmit(MessageSubmitEvent $event)
    {
        $contact = $event->getContact();
        if(count($this->config["fixed_to_and_subject"]) > 0) {
            $selected_destination = $this->config["fixed_to_and_subject"][$contact->getSubject()];
            $custom_subject = $selected_destination["title"].": ".$contact->getEmail();
            $custom_to =  $selected_destination["email"];
        } else {
            $custom_subject = $contact->getSubject();
            $custom_to = $this->config["to"];
        }



        $message = new \Swift_Message($this->translator->trans(
            $custom_subject,
            $contact->toTranslateArray(),
            'FrequenceWebContactBundle'
        ));

        $message->addFrom($this->config['from']);
        $message->addReplyTo($contact->getEmail(), $contact->getName());
        $message->addTo($custom_to);
        $message->addPart(
            $this->templating->render(
                'FrequenceWebContactBundle:Mails:mail.html.twig',
                array('contact' => $contact)
            ),
            'text/html'
        );
        $message->addPart(
            $this->templating->render(
                'FrequenceWebContactBundle:Mails:mail.txt.twig',
                array('contact' => $contact)
            ),
            'text/plain'
        );

        $this->mailer->send($message);
    }
}
