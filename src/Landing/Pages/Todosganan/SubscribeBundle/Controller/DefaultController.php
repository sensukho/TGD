<?php

namespace Landing\Pages\Todosganan\SubscribeBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;

class DefaultController extends Controller
{
    public function indexAction($name)
    {
        return $this->render('LandingPagesTodosgananSubscribeBundle:Default:index.html.twig', array('name' => $name));
    }
}
