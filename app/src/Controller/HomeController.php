<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\Routing\Annotation\Route;

class HomeController extends AbstractController
{
    /**
     * @Route("/home", name="app_home")
     */
    public function index()
    {
        return $this->render('home/index.html.twig', [
            'controller_name' => 'HomeController',
        ]);
    }


    /**
     * @Route("/account", name="app_account")
     * @return \Symfony\Component\HttpFoundation\Response
     */
    public function accountPage()
    {
        return $this->render('user/account.html.twig');
    }

    /**
     * @Route("/contact", name="app_contact")
     * @return \Symfony\Component\HttpFoundation\Response
     */
    public function contactPage()
    {
        return $this->render('contact.html.twig');
    }

}
