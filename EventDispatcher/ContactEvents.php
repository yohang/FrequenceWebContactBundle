<?php

namespace FrequenceWeb\Bundle\ContactBundle\EventDispatcher;

class ContactEvents
{
    /**
     * This event is thrown each time an user send a message (Only and Only if validation pass)
     */
    const onMessageSubmit = 'contact.submit';
}
