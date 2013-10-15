<?php

namespace Landing\Pages\CoreBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;

class SolClientController extends Controller{
    private $client;
    private $username;
    private $password;
    public $arg;
    private $urlWsdl;

    //instacne para singleton
    public static $instance = NULL;

    //Se cambio el cosntructor a private
    private function __construct(){
        $this->username="";
        $this->password="";
        //$this->urlWsdl = "https://maya.uche.org/sol/services/SolWebservice?wsdl";
        $this->urlWsdl = "https://hive.mobilogy.com/sol/services/SolWebservice?wsdl"; //OLD
        try {
            $this->client = new \SoapClient($this->urlWsdl);
        }
        catch(SoapFault $fault){
                echo "request failed. Returned error : ".$fault->faultcode."-".$fault->faultstring;
        }
    }

    public static function getInstance() {
        if(!isset(self::$instance)) {
            try {
                self::$instance = new SolClientController();
            }catch(SoapFault $fault){
                echo "request failed. Returned error : ".$fault->faultcode."-".$fault->faultstring;
            }
        }
        return self::$instance;
    }

    /*FUNCION PARA CREAR ARREGLO DE DATOS A AL METODO DEL WEBSERVICE ARREGLO DE OPERADORES*/
    public function getChannelAllowedWOperatorVOsForCountry($channelId,$countryCode){
         try {
            $pCriteria = new \stdClass();
            $pCriteria->channelId=$channelId;
            $pCriteria->countryCode=$countryCode;
            $result=$this->client->getChannelAllowedWOperatorVOsForCountry($pCriteria);
            return $result;
        }
            catch(Exception $fault){
                echo $fault;
                echo "ERROR IN WS getChannelAllowedWOperatorVOsForCountry";
            }
        }

    /*FUNCION PARA CREAR ARREGLO DE DATOS A BI*/
    public function getStatHit($login,$password,$webUserId,$channelId,$campaignId,$adId,$parameterId,$shortcodeOperatorMappingId,$page,$previousPage,$pageType,$msisdn,$trafficSourceParam){
         try {
            $pCriteria = new \stdClass();
            $pCriteria->login=$login;
            $pCriteria->password=$password;
            $pCriteria->webUserId=$webUserId;
            $pCriteria->channelId=$channelId;
            $pCriteria->campaignId=$campaignId;
            $pCriteria->adId=$adId;
            $pCriteria->parameterId=$parameterId;
            $pCriteria->shortcodeOperatorMappingId=$shortcodeOperatorMappingId;
            $pCriteria->page=$page;
            $pCriteria->previousPage=$previousPage;
            $pCriteria->pageType=$pageType;
            $pCriteria->msisdn=$msisdn;
            $pCriteria->trafficSourceParam=$trafficSourceParam;

            $result=$this->client->statHit($pCriteria);

            return $result;

        }
        catch(SoapFault $fault){
            echo $fault;
            echo "ERROR IN WS getStatHit";
        }
    }

    public function getParameterInstanceVOs($login,$password,$operatorShortname,$channelId,$adId,$campaignId,$customerFk){
        try {
            $key = $login."".$password."".$operatorShortname."".$channelId."".$adId."".$campaignId."".$customerFk;
            //$memcache = new MemCached();
            //$exists = $memcache->existsKey($key);
            $exists = false;
            //Si existe el key no debemos hacer la peticion del WS y obtener el objeto del memcache
            if($exists) {
                //echo "Se obtuvo el obejto del memCache";
                $result = $memcache->getObjectByKey($key);
            }
            //Si no existe debemos persistirlo en cache y hacer la consulta al WS
            else{
                $pCriteria = new \stdClass();
                $pCriteria->login=$login;
                $pCriteria->password=$password;
                $pCriteria->operatorShortname=$operatorShortname;
                $pCriteria->channelId=$channelId;
                $pCriteria->campaignId=$campaignId;
                $pCriteria->adId=$adId;
                $pCriteria->customerFk=$customerFk;
                $result=$this->client->getParameterInstanceVOs($pCriteria);
                //echo "Se obtuvo el obejto del Webservice";
                //$memcache->persistObjectCache($key,$result);
            }
            return $result;
        }catch(SoapFault $fault){
            echo $fault;
            echo "ERROR IN WS getParameterInstanceVOs";
        }
    }

    public function getUrlsCampania($login,$password,$operatorShortname,$campania,$channels,$names)
    {
        $urls = array();

        $i = 0;
        foreach ($channels as $channel) {
            $url = 'http://clubs.movilaction.com/chitchat/' . $names[$i] .'/index.php?adId=';
            $result = $this->getParameterInstanceVOs($login,$password,$operatorShortname,$channel,null,$campania,null);
            if (count($result->getParameterInstanceVOsReturn->parameterInstanceVO) >1){

                $urls[$i] = $url . $result->getParameterInstanceVOsReturn->parameterInstanceVO[0]->adId;
            }
            else {
                $urls[$i] = $url . $result->getParameterInstanceVOsReturn->parameterInstanceVO->adId;
            }
            $i++;
        }
        return $urls;
    }

    public function getUrlsCampania_test($login,$password,$operatorShortname,$adIds,$campania,$customerFks,$channels,$names)
    {

        $urls = array();
        $adId=NULL;
        $customerFk=NULL;
        $campaignId=NULL;
        $result=NULL;
        $adId_vos=NULL;
        $campaignId_vos=NULL;
        $adId_qs=NULL;
        $campaignId_qs=NULL;
        $customerFk_qs=NULL;

        $i = 0;
        //getParameterInstanceVOs($login,$password,$operatorShortname,$channelId,$adId,$campaignId,$customerFk);
        foreach ($channels as $channel) {
            $url = 'http://clubs.movilaction.com/chitchat/' . $names[$i] .'/index.php';


            $adId=(is_array($adIds) && array_key_exists($i,$adIds))?$adIds[$i]:NULL;
            $adId=(is_int($adIds))?$adIds:$adId;
            $customerFk=(is_array($customerFks) && array_key_exists($i,$customerFks))?$customerFks[$i]:NULL;
            $customerFk=(is_int($customerFks))?$customerFks:$customerFk;

            $campaignId=(is_array($campania) && array_key_exists($i,$campania))?$campania[$i]:$campania;
            $campaignId=(is_int($campania))?$campania:$campaignId;
            //var_dump($campaignId);
            $result = $this->getParameterInstanceVOs($login,$password,$operatorShortname,$channel,$adId,$campaignId,$customerFk);
            if (count($result->getParameterInstanceVOsReturn->parameterInstanceVO) >1)
            {
                $adId_vos=$result->getParameterInstanceVOsReturn->parameterInstanceVO[0]->adId;
                $campaignId_vos=$result->getParameterInstanceVOsReturn->parameterInstanceVO[0]->campaignId;

                $adId_qs=($adId_vos!='')?"adId=$adId_vos":'';
                $campaignId_qs=($campaignId_vos!='')?"&campaignId=$campaignId_vos":'';
                $customerFk_qs=($customerFk!='')?"&customerFk=$customerFk":'';

                $urls[$i] =$url.'?'.$adId_qs.$campaignId_qs.$customerFk_qs;

            }
            else
            {
                $adId_vos=$result->getParameterInstanceVOsReturn->parameterInstanceVO->adId;
                $campaignId_vos=$result->getParameterInstanceVOsReturn->parameterInstanceVO->campaignId;

                $adId_qs=($adId_vos!='')?"adId=$adId_vos":'';
                $campaignId_qs=($campaignId_vos!='')?"&campaignId=$campaignId_vos":'';
                $customerFk_qs=($customerFk!='')?"&customerFk=$customerFk":'';

                $urls[$i] =$url.'?'.$adId_qs.$campaignId_qs.$customerFk_qs;
            }
            $i++;

        }
        return $urls;
    }
    public function getUrlsCampania_test2($campania,$channels,$names)
    {
        $urls = array();
        $campaignId=NULL;

        $campaignId_qs=NULL;

        $i = 0;
        foreach ($channels as $channel) {
            $url = 'http://clubs.movilaction.com/chitchat/' . $names[$i] .'/index.php';
            $campaignId=(is_array($campania) && array_key_exists($i,$campania))?$campania[$i]:$campania;
            $campaignId=(is_int($campania))?$campania:$campaignId;
            //var_dump($campaignId);
            $campaignId_qs=($campaignId!='')?"campaignId=$campaignId":'';
            $urls[$i] =$url.'?'.$campaignId_qs;
            $i++;
        }
        return $urls;
    }
}
/*********************************************************************************************************/
function obtenerArregloRecursosCanal($recursosCanal)
{
    $resources=array();
    $names=array();
    $resourcesAux=array();
    foreach($recursosCanal->getParameterInstanceVOsReturn->parameterInstanceVO as $resourceType)
    {
        $resourcesAux[]=get_object_vars($resourceType);
    }
    foreach($resourcesAux as $kResource=>$resource)
    {
        $names[]=$resource['name'];
    }
    $namesAux=array();
    foreach($names as $name)
    {
        if(!in_array($name,$namesAux))
        {
            foreach($resourcesAux as $resource)
            {
                if($resource['name']==$name)
                {
                    $namesAux[]=$name;
                    $resources[$name]=$resource;
                }

            }
        }
    }
    return $resources;
}
/*********************************************************************************************************/
function obtenerArregloInfOperadores($recursosCanal)
{
    $resources=array();
    $names=array();
    $resourcesAux=array();
    foreach($recursosCanal->getChannelAllowedWOperatorVOsForCountryReturn   as $resourceType)
    {
        $resourcesAux[]=get_object_vars($resourceType);
    }
    foreach($resourcesAux as $kResource=>$resource)
    {
        $names[]=$resource['name'];
    }
    $namesAux=array();
    foreach($names as $name)
    {
        if(!in_array($name,$namesAux))
        {
            foreach($resourcesAux as $resource)
            {
                if($resource['name']==$name)
                {
                    $namesAux[]=$name;
                    $resources[$name]=$resource;
                }

            }
        }
    }
    return $resources;
}

function obtenerArregloInfOperadoresArr($recursosCanal)
{
    $resources=array();
    $names=array();
    $resourcesAux=array();
    foreach($recursosCanal->getChannelAllowedWOperatorVOsForCountryReturn -> wOperatorVO as $resourceType)
    {
        $resourcesAux[]=get_object_vars($resourceType);
    }
    foreach($resourcesAux as $kResource=>$resource)
    {
        $names[]=$resource['name'];
    }
    $namesAux=array();
    foreach($names as $name)
    {
        if(!in_array($name,$namesAux))
        {
            foreach($resourcesAux as $resource)
            {
                if($resource['name']==$name)
                {
                    $namesAux[]=$name;
                    $resources[$name]=$resource;
                }

            }
        }
    }
    return $resources;
}
