<?php

namespace Landing\Pages\Todosganan\Site\HomeBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\Request;
use Landing\Pages\CoreBundle\Controller\cherryCore;
//use Landing\Pages\CoreBundle\Controller;

class CtgController extends cherryCore
{
########## ADMINISTRATOR ##########
    public function inicioAction()
    {
    	$request = Request::createFromGlobals();
    	//var_dump($request->headers->get('user-agent'));
    	if( preg_match('/(Firefox|Chrome|Safari|Opera|Netscape)/i', $request->headers->get('user-agent')) ){
    		return $this->render('LandingPagesTodosgananSiteHomeBundle:ctg:index.html.twig');
    	}elseif ( preg_match('/(MSIE)/i', $request->headers->get('user-agent')) ) {
    		return $this->render('LandingPagesTodosgananSiteHomeBundle:ctg:index2.html.twig');
    	}
    }

    public function pagesAction($page)
    {
    	$request = Request::createFromGlobals();
    	//var_dump($request->headers->get('user-agent'));
    	if( preg_match('/(Firefox|Chrome|Safari|Opera|Netscape)/i', $request->headers->get('user-agent')) ){
    		return $this->render('LandingPagesTodosgananSiteHomeBundle:ctg:'.$page.'.html.twig');
    	}elseif ( preg_match('/(MSIE)/i', $request->headers->get('user-agent')) ) {
    		return $this->render('LandingPagesTodosgananSiteHomeBundle:ie:'.$page.'.html.twig');
    	}
    }
}