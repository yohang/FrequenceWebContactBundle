<?php

namespace FrequenceWeb\Bundle\ContactBundle\Controller;

use FrequenceWeb\Bundle\ContactBundle\EventDispatcher\ContactEvents;
use FrequenceWeb\Bundle\ContactBundle\EventDispatcher\Event\ErrorMessageSubmit;
use FrequenceWeb\Bundle\ContactBundle\EventDispatcher\Event\MessageSubmitEvent;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\RedirectResponse;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\Form\FormInterface;

/**
 * Contact controller
 *
 * @author Yohan Giarelli <yohan@giarel.li>
 */
class DefaultController extends Controller
{
    /**
     * Action that displays the contact form
     *
     * @param Request $request
     *
     * @return \Symfony\Component\HttpFoundation\Response
     */
    public function indexAction(Request $request)
    {
        $this->container->get('session')->set('_fw_contact_referer', $request->getUri());

        return $this->renderFormResponse($this->getForm());
    }

    /**
     * Action that handles the submitted contact form
     *
     * @param  Request                                    $request
     *
     * @return \Symfony\Component\HttpFoundation\Response
     */
    public function submitAction(Request $request)
    {
        $form = $this->getForm();
        $form->handleRequest($request);

        if ($form->isValid()) {
            // Send the event for message handling (send mail, add to DB, don't care)
            $event = new MessageSubmitEvent($form->getData());
            $this->container->get('event_dispatcher')->dispatch(ContactEvents::onMessageSubmit, $event);

            // Let say the user it's ok
            $message = $this->container->get('translator')->trans('contact.submit.success', array(), 'FrequenceWebContactBundle');
            $this->container->get('session')->getFlashBag()->add('success', $message);

            // Redirect somewhere
            return new RedirectResponse($this->container->get('session')->get('_fw_contact_referer'));
        }else{
            $event = new ErrorMessageSubmit($form->getData());
            $this->container->get('event_dispatcher')->dispatch(ContactEvents::onErrorMessageSubmit, $event);
        }
        
        // Let say the user there's a problem
        $message = $this->container->get('translator')->trans('contact.submit.failure', array(), 'FrequenceWebContactBundle');
        $this->container->get('session')->getFlashBag()->add('error', $message);

        // Errors ? Re-render the form
        return $this->renderFormResponse($form);
    }

    /**
     * Returns the rendered form response
     *
     * @param  FormInterface                              $form
     *
     * @return \Symfony\Component\HttpFoundation\Response
     */
    protected function renderFormResponse(FormInterface $form)
    {
        return $this->container->get('templating')->renderResponse(
            'FrequenceWebContactBundle:Default:index.html.twig',
            array('form' => $form->createView())
        );
    }

    /**
     * Returns the contact form instance
     *
     * @return FormInterface
     */
    protected function getForm()
    {
        return $this->container->get('form.factory')->create(
            $this->container->get('frequence_web_contact.type'),
            $this->container->get('frequence_web_contact.model')
        );
    }
}
