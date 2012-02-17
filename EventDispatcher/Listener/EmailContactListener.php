<?php

namespace FrequenceWeb\Bundle\ContactBundle\EventDispatcher\Listener;

use FrequenceWeb\Bundle\ContactBundle\EventDispatcher\Event\MessageSubmitEvent;

class EmailContactListener
{
    /**
     * @var \Swift_Mailer
     */
    protected $mailer;

    /**
     * @var array
     */
    protected $config;

    public function __construct(\Swift_Mailer $mailer, array $config)
    {
        $this->mailer = $mailer;
        $this->config = $config;
    }

    public function onMessageSubmit(MessageSubmitEvent $event)
    {

    }
}
