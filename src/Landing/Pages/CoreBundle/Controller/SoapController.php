<?php

namespace Landing\Pages\CoreBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;

class SoapController extends Controller{
	private $client;
   	private $username;
    private $password;
    public $arg;
    private $urlWsdl;

    public static $instance = NULL;

    public function __construct(){
        $this->username="";
        $this->password="";
        //$this->urlWsdl = "https://maya.uche.org/kotek/services/CommonWebservice?wsdl";
        $this->urlWsdl = "https://hive.mobilogy.com/kotek/services/CommonWebservice?wsdl"; //OLD
        try {
            $this->client = new \Soapclient($this->urlWsdl);
        }
        catch(SoapFault $fault){
            echo "request failed. Returned error : ".$fault->faultcode."-".$fault->faultstring;
        }
    }

    public static function getInstance() {
        if(!isset(self::$instance)) {
            try {
                self::$instance = new SoapController();
            }catch(SoapFault $fault){
                echo "request failed. Returned error : ".$fault->faultcode."-".$fault->faultstring;
            }
        }
        return self::$instance;
    }

    public function getOperatorVOWithRemoteIp($ip){
        try {
            //$ip='201.103.100.248';
            $pCriteria = new \stdClass();
            $pCriteria->ip=$ip;

            $result=$this->client->getOperatorVOWithRemoteIp($pCriteria);
            return $result;
        }
        catch(SoapFault $fault){
            echo $fault;
        }
    }
}