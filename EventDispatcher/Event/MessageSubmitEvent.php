<?php

namespace FrequenceWeb\Bundle\ContactBundle\EventDispatcher\Event;

use FrequenceWeb\Bundle\ContactBundle\Model\Contact;
use Symfony\Component\EventDispatcher\Event;

/**
 * This event is thrown each time an user send a message (Only and Only if validation pass)
 *
 * @author Yohan Giarelli <yohan@giarel.li>
 */
class MessageSubmitEvent extends Event
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
