<?php

namespace Landing\Pages\CoreBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\Request;

class DefaultController extends cherryCore
{
########## ADMINISTRATOR ##########
    public function adminAction()
    {
        return $this->render('LandingPagesCoreBundle:admin:index.html.twig', array( 'error' => '00X0' ));
    }

    public function loginAction()
    {
        $request = Request::createFromGlobals();
        $user = $request->request->get('user',NULL);
        $pass = $request->request->get('pass',NULL);
        if( $user == 'sensukho' ){
            if( $pass == '12345' ){
                $session = base64_encode( md5( $user.$pass.date('Y-n-d') ) );
                return $this->redirect( $this->generateUrl('admin_home', array( 'session' => $session )) );
            }else{ return $this->render('LandingPagesCoreBundle:admin:index.html.twig', array( 'error' => '00X1' )); }
        }else{ return $this->render('LandingPagesCoreBundle:admin:index.html.twig', array( 'error' => '00X2' )); }
    }

    public function homeAction($session)
    {
        $s = base64_encode( md5('sensukho'.'12345'.date('Y-n-d') ) );
        return $this->render('LandingPagesCoreBundle:admin:lpg.html.twig', array( 'session' => $session, 'session_id' => $s ));
    }
########## WEBSPOTS ##########
    public function indexAction($cat,$site)
    {
        $request = Request::createFromGlobals();
        $portal = $this->getNav($request);

        if( $portal == 'web' ){
            return $this->redirect( $this->generateUrl('web', array( 'site' => $site, 'cat' => $cat)) );
        }elseif ($portal == 'wap') {
            return $this->redirect( $this->generateUrl('wap', array( 'site' => $site, 'cat' => $cat)) );
        }
    }
########## WEBSPOTS: WEB ##########
    public function webAction($cat,$site)
    {
    	$request = Request::createFromGlobals();
		$params = $this->setConfig($request,$cat,ucfirst($cat),$site,ucfirst($site));
    	$this->get('cache')->save('params', serialize($params));
        $portal = $this->getNav($request);

    	//var_dump($params);

        //$params['web']['webspot']['formfields']['error']['val'] = base64_encode(4);

        return $this->render('LandingPages'.$params['config']['portal']['bundle'].''.$params['config']['site']['bundle'].'Bundle::'.$portal.'.html.twig', array( 'params' => $params, 'portal' => $portal ));
    }

    public function webpinAction()
    {
		if ($params = $this->get('cache')->fetch('params')) {
    		$params = unserialize($params);
		}
		$request = Request::createFromGlobals();
		$this->sysvars = $params;
		$params = $this->setPinConfig($request);
    	$params = $this->sendMsisdn();
    	$this->get('cache')->save('params', serialize($params));
        $portal = $this->getNav($request);

    	//var_dump($this->sysvars);

        return $this->render('LandingPages'.$params['config']['portal']['bundle'].''.$params['config']['site']['bundle'].'Bundle::'.$portal.'pin.html.twig', array( 'params' => $params, 'portal' => $portal ));
    }

    public function webregAction()
    {
    	if ($params = $this->get('cache')->fetch('params')) {
    		$params = unserialize($params);
		}
    	$request = Request::createFromGlobals();
    	$this->sysvars = $params;
    	$params = $this->setRegConfig($request);
    	$params = $this->sendPin();
    	$this->get('cache')->save('params', serialize($params));
        $portal = $this->getNav($request);

    	//var_dump($this->sysvars);

        return $this->render('LandingPages'.$params['config']['portal']['bundle'].''.$params['config']['site']['bundle'].'Bundle::'.$portal.'welcome.html.twig', array( 'params' => $params, 'portal' => $portal ));
    }
########## WEBSPOTS: WAP ##########
    public function wapAction($cat,$site)
    {
        $request = Request::createFromGlobals();
        $params = $this->setConfig($request,$cat,ucfirst($cat),$site,ucfirst($site));
        $this->get('cache')->save('params', serialize($params));
        $portal = $this->getNav($request);

        //var_dump($params);

        return $this->render('LandingPages'.$params['config']['portal']['bundle'].''.$params['config']['site']['bundle'].'Bundle::'.$portal.'.html.twig', array( 'params' => $params, 'portal' => $portal ));
    }

    public function wapregAction()
    {
        if ($params = $this->get('cache')->fetch('params')) {
            $params = unserialize($params);
        }
        $request = Request::createFromGlobals();
        $this->sysvars = $params;
        $params = $this->setMsisdnConfig($request);
        //$params = $this->sendMsisdn();
        $this->get('cache')->save('params', serialize($params));
        $portal = $this->getNav($request);

        //var_dump($this->sysvars);

        return $this->render('LandingPages'.$params['config']['portal']['bundle'].''.$params['config']['site']['bundle'].'Bundle::'.$portal.'pin.html.twig', array( 'params' => $params, 'portal' => $portal ));
    }
########## OTHER ##########
    public function checkboxAction()
    {
    	if ($params = $this->get('cache')->fetch('params')) {
    		$params = unserialize($params);
		}
    	$request = Request::createFromGlobals();
		$this->sysvars = $params;
    	$params = $this->getLegals($request);

    	$this->get('cache')->save('params', serialize($params));

    	if( $request->request->get('set',NULL) == 'up' ){
    		return $this->render('LandingPages'.$params['config']['portal']['bundle'].''.$params['config']['site']['bundle'].'Bundle::checkbox_top.html.twig', array( 'params' => $params ));
    	}elseif( $request->request->get('set',NULL) == 'down' ){
    		return $this->render('LandingPages'.$params['config']['portal']['bundle'].''.$params['config']['site']['bundle'].'Bundle::checkbox_lower.html.twig', array( 'params' => $params ));
    	}
	}
}