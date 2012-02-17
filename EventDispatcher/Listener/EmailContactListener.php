<?php

namespace FrequenceWeb\Bundle\ContactBundle\EventDispatcher\Listener;

use Symfony\Bundle\FrameworkBundle\Translation\Translator;

use FrequenceWeb\Bundle\ContactBundle\EventDispatcher\Event\MessageSubmitEvent;

class EmailContactListener
{
    /**
     * @var \Swift_Mailer
     */
    protected $mailer;

    /**
     * @var \Symfony\Bundle\FrameworkBundle\Translation\Translator
     */
    protected $translator;

    /**
     * @var array
     */
    protected $config;

    public function __construct(\Swift_Mailer $mailer, Translator $translator, array $config)
    {
        $this->mailer     = $mailer;
        $this->translator = $translator;
        $this->config     = $config;
    }

    public function onMessageSubmit(MessageSubmitEvent $event)
    {
        $contact = $event->getContact();

        $message = new \Swift_Message(
            $this->translator->trans($this->config['subject']),
            $contact->body
        );

        $message->addFrom($this->config['from']);
        $message->addReplyTo($contact->email, $contact->name);
        $message->addTo($this->config['to']);

        $this->mailer->send($message);
    }
}
