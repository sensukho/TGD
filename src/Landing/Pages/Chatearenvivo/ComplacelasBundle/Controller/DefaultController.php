<?php

namespace Landing\Pages\Chatearenvivo\ComplacelasBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;

class DefaultController extends Controller
{
    public function indexAction($name)
    {
        return $this->render('LandingPagesChatearenvivoComplacelasBundle:Default:index.html.twig', array('name' => $name));
    }
}
