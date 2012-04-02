<?php

namespace FrequenceWeb\Bundle\ContactBundle\EventDispatcher\Listener;

use Symfony\Bundle\FrameworkBundle\Translation\Translator,
    Symfony\Bundle\FrameworkBundle\Templating\EngineInterface;

use FrequenceWeb\Bundle\ContactBundle\EventDispatcher\Event\MessageSubmitEvent;

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
     * @var \Symfony\Bundle\FrameworkBundle\Translation\Translator
     */
    protected $translator;

    /**
     * @var \Symfony\Bundle\FrameworkBundle\Templating\EngineInterface
     */
    protected $templating;

    /**
     * @var array
     */
    protected $config;

    /**
     * @param \Swift_Mailer $mailer
     * @param \Symfony\Bundle\FrameworkBundle\Templating\EngineInterface $templating
     * @param \Symfony\Bundle\FrameworkBundle\Translation\Translator $translator
     * @param array $config Configuration from DIC
     */
    public function __construct(\Swift_Mailer $mailer, EngineInterface $templating, Translator $translator, array $config)
    {
        $this->mailer     = $mailer;
        $this->templating = $templating;
        $this->translator = $translator;
        $this->config     = $config;
    }

    /**
     * Called when onMessageSubmit event is fired
     * @param \FrequenceWeb\Bundle\ContactBundle\EventDispatcher\Event\MessageSubmitEvent $event
     */
    public function onMessageSubmit(MessageSubmitEvent $event)
    {
        $contact = $event->getContact();

        $message = new \Swift_Message($this->translator->trans(
            $this->config['subject'],
            $contact->toTranslateArray(),
            'FrequenceWebContactBundle'
        ));

        $message->addFrom($this->config['from']);
        $message->addReplyTo($contact->getEmail(), $contact->getName());
        $message->addTo($this->config['to']);
        $message->addPart($this->templating->render('FrequenceWebContactBundle:Mails:mail.html.twig', array('contact' => $contact)), 'text/html');
        $message->addPart($this->templating->render('FrequenceWebContactBundle:Mails:mail.txt.twig', array('contact' => $contact)), 'text/plain');

        $this->mailer->send($message);
    }
}
