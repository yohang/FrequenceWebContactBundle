<?php

namespace FrequenceWeb\Bundle\ContactBundle\Model;

/**
 * Class attached to the contact form. Represents data from it.
 * You can extend it, and / or make it an entity or a document.
 *
 * @author Yohan Giarelli <yohan@giarel.li>
 */
class Contact
{
    /**
     * The sender name
     *
     * @var string
     */
    protected $name;

    /**
     * The sender email
     *
     * @var string
     */
    protected $email;

    /**
     * The message subject
     *
     * @var array
     */
    protected $subject;

    /**
     * The message body
     *
     * @var string
     */
    protected $body;

    /**
     * @param string $body
     */
    public function setBody($body)
    {
        $this->body = $body;
    }

    /**
     * @return string
     */
    public function getBody()
    {
        return $this->body;
    }

    /**
     * @param string $email
     */
    public function setEmail($email)
    {
        $this->email = $email;
    }

    /**
     * @return string
     */
    public function getEmail()
    {
        return $this->email;
    }

    /**
     * @param string $name
     */
    public function setName($name)
    {
        $this->name = $name;
    }

    /**
     * @return string
     */
    public function getName()
    {
        return $this->name;
    }

    /**
     * @return array
     */
    public function getSubject() {
        return $this->subject;
    }

    /**
     * @param array $subject
     */
    public function setSubject( $subject ) {
        $this->subject = $subject;
    }



    /**
     * Returns data that can be injected in the translating message subject
     *
     * @return array
     */
    public function toTranslateArray()
    {
        return array(
            '%name%'    => $this->name,
            '%email%'   => $this->email,
            '%subject%' => $this->subject,
        );
    }
}
