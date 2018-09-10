<?php

namespace FrequenceWeb\Bundle\ContactBundle\EventDispatcher\Event;

use FrequenceWeb\Bundle\ContactBundle\Model\Contact;
use Symfony\Component\EventDispatcher\Event;

/**
 * This event is thrown each time an user send a message and get an error
 *
 * @author Chrysweel
 */
class ErrorMessageSubmit extends Event
{
    /**
     * @var Contact
     */
    protected $contact;

    /**
     * @param Contact $contact
     */
    public function __construct(Contact $contact)
    {
        $this->contact = $contact;
    }

    /**
     * @return Contact
     */
    public function getContact()
    {
        return $this->contact;
    }
}
