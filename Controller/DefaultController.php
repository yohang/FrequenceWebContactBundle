<?php

namespace FrequenceWeb\Bundle\ContactBundle\Controller;

use Symfony\Component\DependencyInjection\ContainerAware,
    Symfony\Component\HttpFoundation\RedirectResponse,
    Symfony\Component\HttpFoundation\Request,
    Symfony\Component\Form\Form;

use FrequenceWeb\Bundle\ContactBundle\EventDispatcher\Event\MessageSubmitEvent,
    FrequenceWeb\Bundle\ContactBundle\EventDispatcher\ContactEvents,
    FrequenceWeb\Bundle\ContactBundle\Form\ContactType,
    FrequenceWeb\Bundle\ContactBundle\Model\Contact;

/**
 * Contact controller
 *
 * @author Yohan Giarelli <yohan@giarel.li>
 */
class DefaultController extends ContainerAware
{
    /**
     * Action that displays the contact form
     *
     * @return \Symfony\Component\HttpFoundation\Response
     */
    public function indexAction()
    {
        return $this->renderFormResponse($this->getForm());
    }

    /**
     * Action that handles the submitted contact form
     *
     * @param \Symfony\Component\HttpFoundation\Request $request
     * @return \Symfony\Component\HttpFoundation\Response
     */
    public function submitAction(Request $request)
    {
        $form = $this->getForm();
        $form->bindRequest($request);

        if ($form->isValid()) {
            // Send the event for message handling (send mail, add to DB, don't care)
            $event = new MessageSubmitEvent($form->getData());
            $this->container->get('event_dispatcher')->dispatch(ContactEvents::onMessageSubmit, $event);

            // Let say the user it's ok
            $message = $this->container->get('translator')->trans('contact.submit.success', array(), 'FrequenceWebContactBundle');
            $this->container->get('session')->setFlash('success', $message);

            // Redirect somewhere
            return new RedirectResponse($this->container->get('router')->generate('fw_contact_index'));
        }

        // Let say the user there's a problem
        $message = $this->container->get('translator')->trans('contact.submit.failure', array(), 'FrequenceWebContactBundle');
        $this->container->get('session')->setFlash('error', $message);

        // Errors ? Re-render the form
        return $this->renderFormResponse($form);
    }

    /**
     * Returns the rendered form response
     *
     * @param \Symfony\Component\Form\Form $form
     * @return \Symfony\Component\HttpFoundation\Response
     */
    protected function renderFormResponse(Form $form)
    {
        return $this->container->get('templating')->renderResponse(
            'FrequenceWebContactBundle:Default:index.html.twig',
            array('form' => $form->createView())
        );
    }

    /**
     * Returns the contact form instance
     *
     * @return \Symfony\Component\Form\Form
     */
    protected function getForm()
    {
        return $this->container->get('form.factory')->create(
            $this->container->get('frequence_web_contact.type'),
            $this->container->get('frequence_web_contact.model')
        );
    }
}
