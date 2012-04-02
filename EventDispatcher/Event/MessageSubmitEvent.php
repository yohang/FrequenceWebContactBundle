<?php

namespace FrequenceWeb\Bundle\ContactBundle\EventDispatcher\Event;

use Symfony\Component\EventDispatcher\Event;

use FrequenceWeb\Bundle\ContactBundle\Model\Contact;

/**
 * This event is thrown each time an user send a message (Only and Only if validation pass)
 *
 * @author Yohan Giarelli <yohan@giarel.li>
 */
class MessageSubmitEvent extends Event
{
    /**
     * @var \FrequenceWeb\Bundle\ContactBundle\Model\Contact
     */
    protected $contact;

    /**
     * @param \FrequenceWeb\Bundle\ContactBundle\Model\Contact $contact
     */
    public function __construct(Contact $contact)
    {
        $this->contact = $contact;
    }

    /**
     * @return \FrequenceWeb\Bundle\ContactBundle\Model\Contact
     */
    public function getContact()
    {
        return $this->contact;
    }
}
