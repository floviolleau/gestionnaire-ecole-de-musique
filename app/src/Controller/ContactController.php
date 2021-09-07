<?php

namespace App\Controller;

use Symfony\Bridge\Twig\Mime\TemplatedEmail;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\DependencyInjection\ParameterBag\ParameterBagInterface;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\Mailer\MailerInterface;
use Symfony\Component\Routing\Annotation\Route;

class ContactController extends AbstractController
{
    /**
     * @var ParameterBagInterface
     */
    private ParameterBagInterface $params;

    /**
     * @var MailerInterface
     */
    private $mailer;

    /**
     * @param ParameterBagInterface $params
     * @param MailerInterface $mailer
     */
    public function __construct(ParameterBagInterface $params, MailerInterface $mailer)
    {
        $this->params = $params;
        $this->mailer = $mailer;
    }

    /**
     * @Route("/contact/submit", name="app_submit_contact")
     * @param Request $request
     * @return \Symfony\Component\HttpFoundation\RedirectResponse
     * @throws \Symfony\Component\Mailer\Exception\TransportExceptionInterface
     */
    public function submitForm(Request $request)
    {
        $nameUser = $request->get('name');
        $emailUser = $request->get('email');

        $email = (new TemplatedEmail())
            ->from($this->params->get('from_email'))
            ->to($emailUser)
            ->cc($this->params->get('to_email'))
            ->htmlTemplate('emails/contact.html.twig')
            ->context(['name' => $nameUser]);

        $this->mailer->send($email);

        $this->addFlash('notice', 'Form submitted successfully');
        return $this->redirectToRoute('contact');
    }
}
