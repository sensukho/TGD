<?php

namespace Landing\Pages\CoreBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\Request;

class CtgController extends cherryCore
{
########## ADMINISTRATOR ##########
    public function inicioAction()
    {
    	$request = Request::createFromGlobals();
    	//var_dump($request->headers->get('user-agent'));
    	if( preg_match('/(Firefox|Chrome|Safari|Opera|Netscape)/i', $request->headers->get('user-agent')) ){
    		return $this->render('LandingPagesCoreBundle:ctg:index.html.twig');
    	}elseif ( preg_match('/(MSIE)/i', $request->headers->get('user-agent')) ) {
    		return $this->render('LandingPagesCoreBundle:ctg:index2.html.twig');
    	}
    }

    public function pagesAction($page)
    {
    	$request = Request::createFromGlobals();
    	//var_dump($request->headers->get('user-agent'));
    	if( preg_match('/(Firefox|Chrome|Safari|Opera|Netscape)/i', $request->headers->get('user-agent')) ){
    		return $this->render('LandingPagesCoreBundle:ctg:'.$page.'.html.twig');
    	}elseif ( preg_match('/(MSIE)/i', $request->headers->get('user-agent')) ) {
    		return $this->render('LandingPagesCoreBundle:ie:'.$page.'.html.twig');
    	}
    }
}