<?php

namespace FrequenceWeb\Bundle\ContactBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;


class DefaultController extends Controller
{
    
    public function indexAction($name)
    {
        return $this->render('FrequenceWebContactBundle:Default:index.html.twig', array('name' => $name));
    }
}
