<?php

namespace Landing\Pages\CoreBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;

class SmSubscriptionClientController extends Controller {
    private $client;
    private $username;
    private $password;
    public $arg;
    private $urlWsdl;

    //instance para singleton
    public static $instance = NULL;

    public function __construct(){
        $this->username="";
        $this->password="";
        //$this->urlWsdl = "https://maya.uche.org/kotek/services/SubscriptionWebservice?wsdl";
        $this->urlWsdl = "https://hive.mobilogy.com/kotek/services/SubscriptionWebservice?wsdl"; //OLD
		//$this->urlWsdl = "http://10.75.75.78:8080/kotek/services/SubscriptionWebservice?wsdl";
        //ini_set("soap.wsdl_cache_enabled", "0");
        try {
        	$this->client = new \SoapClient($this->urlWsdl);
        }
        catch(SoapFault $fault){
                echo "request failed. Returned error : ".$fault->faultcode."-".$fault->faultstring;
        }

    }

    //deveulve una isntancia de SmSubscriptionClient sino existe una creada
    public static function getInstance() {
        if(!isset(self::$instance)) {
            try {
                self::$instance = new SmSubscriptionClientController();
            }catch(SoapFault $fault){
                echo "request failed. Returned error : ".$fault->faultcode."-".$fault->faultstring;
            }
        }
        return self::$instance;
    }


    function getSubscriptionVO($login,$password,$msisdn,$operatorShortname,$shortcodeNumber,$serviceFk){
        try {
        	echo $login . $password . $operatorShortname . $shortcodeNumber . $serviceFk;
        	$pCriteria = new \stdClass();
			$pCriteria->login=$login;
			$pCriteria->password=$password;
			$pCriteria->msisdn=$msisdn;
			$pCriteria->operatorShortname=$operatorShortname;
			$pCriteria->shortcodeNumber=$shortcodeNumber;
			$pCriteria->serviceFk=$serviceFk;

            $result=$this->client->getSubscriptionVO($pCriteria);
            //var_dump($result);
            return $result;

        }
        catch(SoapFault $fault){
            echo $fault;
        }
    }

    function loadSubscriptionVO($login,$password,$subscriptionId){
        try {
        	echo $login . $password . $subscriptionId;
        	$pCriteria = new \stdClass();
			$pCriteria->login=$login;
			$pCriteria->password=$password;
			$pCriteria->subscriptionId=$subscriptionId;

            $result=$this->client->loadSubscriptionVO($pCriteria);
            //var_dump($result);
            return $result;

        }
        catch(SoapFault $fault){
            echo $fault;
        }
    }

    function sendMtToUser($login,$password,$subscriptionId,$text,$url){
        try {
        	echo $login . $password . $subscriptionId . $text . $url;
        	$pCriteria = new \stdClass();
			$pCriteria->login=$login;
			$pCriteria->password=$password;
			$pCriteria->subscriptionId=$subscriptionId;
			$pCriteria->text=$text;
			$pCriteria->url=$url;

            $result=$this->client->sendMtToUser($pCriteria);
            //var_dump($result);
            return $result;

        }
        catch(SoapFault $fault){
            echo $fault;
        }
    }

    function sendPinWebAccessToUser($login,$password,$subscriptionId){
        try {
        	echo $login . $password . $subscriptionId;
        	$pCriteria = new \stdClass();
			$pCriteria->login=$login;
			$pCriteria->password=$password;
			$pCriteria->subscriptionId=$subscriptionId;

            $result=$this->client->sendPinWebAccessToUser($pCriteria);
            //var_dump($result);
            return $result;

        }
        catch(SoapFault $fault){
            echo $fault;
        }
    }

    function subscribeUser($login,$password,$msisdn,$t2sId,$moForcePin)
	{
			//echo $login . $password . $msisdn . $t2sId . $moForcePin;
        	$pCriteria = new \stdClass();
			$pCriteria->login=$login;
			$pCriteria->password=$password;
			$pCriteria->msisdn=$msisdn;
			$pCriteria->t2sId=$t2sId;
			$pCriteria->moForcePin=$moForcePin;

            $result=$this->client->subscribeUser($pCriteria);

			return $result;
    }
	function subscribeUserAF($login,$password,$msisdn,$t2sId,$moForcePin,$pixelChargedUrl)
	{
			//echo $login . $password . $msisdn . $t2sId . $moForcePin;
        	$pCriteria = new \stdClass();
			$pCriteria->login=$login;
			$pCriteria->password=$password;
			$pCriteria->msisdn=$msisdn;
			$pCriteria->t2sId=$t2sId;
			$pCriteria->moForcePin=$moForcePin;
			$pCriteria->pixelChargedUrl=$pixelChargedUrl;

            $result=$this->client->subscribeUserAF($pCriteria);

			return $result;
    }

	function preSubscribeUserAF($login,$password,$msisdn,$t2sId,$pixelChargedUrl)
	{
			//echo $login . $password . $msisdn . $t2sId . $moForcePin;
        	$pCriteria = new \stdClass();
			$pCriteria->user=$login;
			$pCriteria->pass=$password;
			$pCriteria->msisdn=$msisdn;
			$pCriteria->t2sId=$t2sId;
			$pCriteria->pixelChargedUrl=$pixelChargedUrl;

            $result=$this->client->preSubscribeUserAF($pCriteria);

			return $result;
    }

    function subscribeUserWithDirectBilling($login,$password,$msisdn,$t2sId,$moForcePin){
        echo $login . $password . $msisdn . $t2sId . $moForcePin;
		$pCriteria = new \stdClass();
		$pCriteria->login=$login;
		$pCriteria->password=$password;
		$pCriteria->msisdn=$msisdn;
		$pCriteria->t2sId=$t2sId;
		$pCriteria->moForcePin=$moForcePin;

		$result=$this->client->subscribeUserWithDirectBilling($pCriteria);
		return $result;
    }
    function subscribeUserWithDirectBillingAF($login,$password,$msisdn,$t2sId,$moForcePin,$pixelChargedUrl){
        echo $login . $password . $msisdn . $t2sId . $moForcePin;
		$pCriteria = new \stdClass();
		$pCriteria->login=$login;
		$pCriteria->password=$password;
		$pCriteria->msisdn=$msisdn;
		$pCriteria->t2sId=$t2sId;
		$pCriteria->moForcePin=$moForcePin;
		$pCriteria->pixelChargedUrl=$pixelChargedUrl;

		$result=$this->client->subscribeUserWithDirectBillingAF($pCriteria);
		return $result;
    }
    function subscriptionPinConfirm($login,$password,$subscriptionId, $pin){
        $pCriteria = new \stdClass();
		$pCriteria->login=$login;
		$pCriteria->password=$password;
		$pCriteria->subscriptionId=$subscriptionId;
		$pCriteria->pin=$pin;
		$result=$this->client->subscriptionPinConfirm($pCriteria);
		return $result;
    }
}
