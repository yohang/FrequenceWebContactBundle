<?php

namespace FrequenceWeb\Bundle\ContactBundle\Model;

class Contact
{
    /**
     * The sender name
     * @var string
     */
    public $name;

    /**
     * The sender email
     * @var string
     */
    public $email;

    /**
     * The message subject
     * @var string
     */
    public $subject;

    /**
     * The message body
     * @var string
     */
    public $body;
}
