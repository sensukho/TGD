<?php
/* ****************************************** */
//ini_set('date.timezone', 'America/Mexico_City');
//define("DEBUG_MODE_CURL", TRUE);
//define("SPOT_URL_SNIPPET", '*');
//define("UNLINK_CURL_FILES", FALSE);
namespace Landing\Pages\CoreBundle\Controller;

class Helper
{
    /* ******************************************************************************************************** */
    /*getVosPropsByT2sType ADAPTADO PARA STATHITS*/
    function getVosPropsByT2sType($t2sType = 't2swap', $vosParams, $hitsParams) {

        $vosProps = array();
        if (is_array($vosParams)) {
            $solObj = SolClientController::getInstance();
            $USR_SOL_CLIENT = $vosParams['USR_SOL_CLIENT'];
            $PSW_SOL_CLIENT = $vosParams['PSW_SOL_CLIENT'];
            $OPRNAME_SOL_CLIENT = $vosParams['OPRNAME_SOL_CLIENT'];
            $CHANNEL_SOL_CLIENT = $vosParams['CHANNEL_SOL_CLIENT'];
            $adId = (array_key_exists('adId', $vosParams)) ? $vosParams['adId'] : NULL;
            $campaignId = (array_key_exists('campaignId', $vosParams)) ? $vosParams['campaignId'] : NULL;
            $customerFk = (array_key_exists('customerFk', $vosParams)) ? $vosParams['customerFk'] : NULL;
            $webUserId = $hitsParams['webUserId'];
            $parameterId = $hitsParams['parameterId'];
            $shortcodeOperatorMappingId = $hitsParams['shortcodeOperatorMappingId'];
            $page = $hitsParams['page'];
            $previousPage = $hitsParams['previousPage'];
            $pageType = $hitsParams['pageType'];
            $msisdn = (array_key_exists('msisdn', $hitsParams)) ? $hitsParams['msisdn'] : NULL;
            $trafficSourceParam = (array_key_exists('trafficSourceParam', $hitsParams)) ? $hitsParams['trafficSourceParam'] : NULL;
            //echo "como se envian getParameterInstanceVOs($USR_SOL_CLIENT, $PSW_SOL_CLIENT, $OPRNAME_SOL_CLIENT, $CHANNEL_SOL_CLIENT, $adId, $campaignId, $customerFk);";
            $vos = $solObj -> getParameterInstanceVOs($USR_SOL_CLIENT, $PSW_SOL_CLIENT, $OPRNAME_SOL_CLIENT, $CHANNEL_SOL_CLIENT, $adId, $campaignId, $customerFk);
            $t2ss = obtenerArregloRecursosCanal($vos);
            $vosProps = $t2ss[$t2sType];
            //echo "Respuesta de getParameter ". var_dump($vosProps);
            //echo "Como se envia getStatHit(" . $USR_SOL_CLIENT . "," . $PSW_SOL_CLIENT . "," . $webUserId . "," . $vosProps['channelId'] . "," . $vosProps['campaignId'] . "," . $vosProps['adId'] . "," . $vosProps['parameterId'] . "," . $vosProps['shortcodeOperatorMappingId'] . "," . $page . "," . $previousPage . "," . $pageType . "," . $msisdn . "," . $trafficSourceParam . ");";
            $statHits = $solObj -> getStatHit($USR_SOL_CLIENT, $PSW_SOL_CLIENT, $webUserId, $vosProps['channelId'], $vosProps['campaignId'], $vosProps['adId'], $vosProps['parameterId'], $vosProps['shortcodeOperatorMappingId'], $page, $previousPage, $pageType, $msisdn, $trafficSourceParam);
            //echo "Respuesta de StatHits: " . var_dump($statHits);
        }
        return array($vosProps, $statHits);
    }
    function getVosProps($t2sType='t2swap',$vosParams)
        {
            $vosProps=array();
            if(is_array($vosParams))
            {
                $solObj=SolClient::getInstance();
                $USR_SOL_CLIENT=$vosParams['USR_SOL_CLIENT'];
                $PSW_SOL_CLIENT=$vosParams['PSW_SOL_CLIENT'];
                $OPRNAME_SOL_CLIENT=$vosParams['OPRNAME_SOL_CLIENT'];
                $CHANNEL_SOL_CLIENT=$vosParams['CHANNEL_SOL_CLIENT'];
                $adId=(array_key_exists('adId',$vosParams))?$vosParams['adId']:NULL;
                $campaignId=(array_key_exists('campaignId',$vosParams))?$vosParams['campaignId']:NULL;
                $customerFk=(array_key_exists('customerFk',$vosParams))?$vosParams['customerFk']:NULL;
                $vos=$solObj->getParameterInstanceVOs($USR_SOL_CLIENT,$PSW_SOL_CLIENT,$OPRNAME_SOL_CLIENT,$CHANNEL_SOL_CLIENT,$adId,$campaignId,$customerFk);
                $t2ss=obtenerArregloRecursosCanal($vos);
                $vosProps=$t2ss[$t2sType];
            }
            return $vosProps;
        }

    function getReplacedUrl($urlString, $parameters = array()) {
        if (isset($parameters['custom']) && $parameters['custom'] != '' && (strstr($urlString, '__custom__') !== FALSE)) {
            $urlString = str_replace('__custom__', $parameters['custom'], $urlString);
        }
        return $urlString;
    }

    function getTrackingUrls($vosProps, $reqVars) {
        $trackingUrls = array();
        if (array_key_exists('pixelTrackingUrl', $vosProps) && !empty($vosProps['pixelTrackingUrl']))
            $trackingUrls['pixelTrackingUrl'] = getReplacedUrl($vosProps['pixelTrackingUrl'], $reqVars);
        if (array_key_exists('pixelConversionUrl', $vosProps) && !empty($vosProps['pixelConversionUrl']))
            $trackingUrls['pixelConversionUrl'] = getReplacedUrl($vosProps['pixelConversionUrl'], $reqVars);
        if (array_key_exists('pixelChargedUrl', $vosProps) && !empty($vosProps['pixelChargedUrl']))
            $trackingUrls['pixelChargedUrl'] = getReplacedUrl($vosProps['pixelChargedUrl'], $reqVars);

        return $trackingUrls;
    }

    function getTrackingCodes($vosProps) {
        $trackingCodes = array();
        if (array_key_exists('htmlTrackingCode', $vosProps) && !empty($vosProps['htmlTrackingCode']))
            $trackingCodes['htmlTrackingCode'] = $vosProps['htmlTrackingCode'];
        if (array_key_exists('wmlTrackingCode', $vosProps) && !empty($vosProps['wmlTrackingCode']))
            $trackingCodes['wmlTrackingCode'] = $vosProps['wmlTrackingCode'];

        return $trackingCodes;
    }

    function getTrackingImages($trackingUrls){
        $trackingImages = array();
        if (is_array($trackingUrls))
            foreach ($trackingUrls as $ktu => $trackingUrl) {
                $trackingImages[$ktu] = '<img src="' . $trackingUrl . '&time=' . time() . '" style="display: none;" />';
            }
        return $trackingImages;
    }

    function setCustomVarSess() {
        if (isset($_GET['custom']) && $_GET['custom'] != '') {
            $_SESSION['custom'] = substr(trim($_GET['custom']), 0, 80);
        }
    }

    function getUnserSessVar($arrayName, $elementName) {
        $unserVar = array();
        if (isset($_SESSION[$arrayName]) && strlen($_SESSION[$arrayName]) > 1) {
            $unserVar = unserialize($_SESSION[$arrayName]);
        } else {
            return FALSE;
        }
        if (isset($unserVar[$elementName])) {
            return $unserVar[$elementName];
        } else {
            return FALSE;
        }

    }

    /*
     function curlRequest($url)
     {
     $result='';
     if(trim($url)!='' && $url!='n/a')
     {
     if($url=='n/a')file_put_contents('/opt/www/webspots/clubs/test/volcado_pruebas.txt',"\n".'es igual a n/a'."\n",FILE_APPEND);
     file_put_contents('/opt/www/webspots/clubs/test/volcado_pruebas.txt',"\n".'antes_de_curl'."\n",FILE_APPEND);
     $cr = curl_init();
     curl_setopt($cr, CURLOPT_URL, $url);
     curl_setopt($cr, CURLOPT_RETURNTRANSFER, true);
     curl_setopt($cr, CURLOPT_HEADER, 0);
     curl_setopt($cr, CURLOPT_TIMEOUT, 180);
     $result = curl_exec($cr);
     file_put_contents('/opt/www/webspots/clubs/test/volcado_pruebas.txt',"\n-".$url.date('H:i:s')."-\n",FILE_APPEND);
     file_put_contents('/opt/www/webspots/clubs/test/volcado_pruebas.txt',"\n".'despues_de_curl'."\n",FILE_APPEND);
     }
     return $result;
     }
     */
    function curlRequest($url) {
        $result = '';
        $wd = '/home/movilaction/www/webspots/clubs/test/curl';
        if (trim($url) != '' && $url != 'n/a') {
            if (!is_dir($wd))
                mkdir($wd);
            $cr = curl_init();
            curl_setopt($cr, CURLOPT_URL, $url);
            curl_setopt($cr, CURLOPT_RETURNTRANSFER, true);
            curl_setopt($cr, CURLOPT_HEADER, 0);
            curl_setopt($cr, CURLOPT_TIMEOUT, 180);
            /* ************************************************************************ */
            if ((defined('UNLINK_CURL_FILES') && UNLINK_CURL_FILES)) {
                $wfiles = glob($wd . '/*');
                foreach ($wfiles as $wfile) {
                    if (file_exists($wfile) && is_file($wfile) && strstr($wfile, 'curl') != FALSE)
                        unlink($wfile);
                }
            }
            /* ************************************************************************ */
            $debugMode = FALSE;
            $debugMode = (defined('DEBUG_MODE_CURL') && DEBUG_MODE_CURL) && (defined('SPOT_URL_SNIPPET') && (strstr($_SERVER['SCRIPT_FILENAME'], SPOT_URL_SNIPPET) != FALSE || SPOT_URL_SNIPPET == '*'));

            if ($debugMode) {

                $logfh = fopen($wd . '/raw_curl_errors.txt', 'a+');
                //$logfhvb = fopen($wd.'/verbose_curl.txt', 'a+');
                //curl_setopt($cr, CURLOPT_VERBOSE, true);
                //curl_setopt($cr, CURLOPT_FILE, $logfhvb);
                curl_setopt($cr, CURLOPT_STDERR, $logfh);
                //curl_setopt($cr, CURLOPT_FOLLOWLOCATION, TRUE);
            }
            /* ************************************************************************ */
            $result = curl_exec($cr);
            /* ************************************************************************ */
            if ($debugMode) {
                $errorsFileName = '';
                $successFileName = '';
                $impSName = '';
                $expSName = array();
                $expSNameLength = 0;
                $expSName = explode('/', $_SERVER['SCRIPT_NAME']);

                $expSNameLength = count($expSName);
                unset($expSName[0], $expSName[$expSNameLength - 1]);
                $impSName = implode('_', $expSName);
                $errorsFileName = $impSName . '_curl_errors.txt';
                $successFileName = $impSName . '_curl_success.txt';

                $isHttpError = FALSE;
                $httpCode = curl_getinfo($cr, CURLINFO_HTTP_CODE);
                $effectiveUrl = curl_getinfo($cr, CURLINFO_EFFECTIVE_URL);
                $fileTime = curl_getinfo($cr, CURLINFO_FILETIME);
                $isHttpError = (substr($httpCode, 0, 1) == 4 || substr($httpCode, 0, 1) == 3 || substr($httpCode, 0, 1) == 5) ? TRUE : FALSE;

                $adId = '';
                $campaignId = '';
                $t2sFk = '';
                $adId = (isset($_SESSION['resource_properties']['adId'])) ? $_SESSION['resource_properties']['adId'] : '';
                $campaignId = (isset($_SESSION['resource_properties']['campaignId'])) ? $_SESSION['resource_properties']['campaignId'] : '';
                $t2sFk = (isset($_SESSION['resource_properties']['t2sFk'])) ? $_SESSION['resource_properties']['t2sFk'] : '';

                if ($isHttpError) {
                    file_put_contents($wd . '/' . $errorsFileName, $httpCode . '; URL efectiva' . $effectiveUrl . ';' . $fileTime . ';adId:' . $adId . ';campaignId: ' . $campaignId . ';t2s: ' . $t2sFk . ';' . date('Y m d H:i:s') . "\n", FILE_APPEND);
                }
                /* ************************************************************************ */
                if ($result === FALSE) {
                    file_put_contents($wd . '/' . $errorsFileName, 'URL pasada' . $url . ';' . curl_error($cr) . ';' . curl_errno($cr) . ';' . 'adId:' . $adId . ';campaignId: ' . $campaignId . ';t2s: ' . $t2sFk . ';' . date('Y m d H:i:s') . "\n", FILE_APPEND);
                } elseif (!$isHttpError) {
                    file_put_contents($wd . '/' . $successFileName, 'URL pasada' . $url . '; URL efectiva: ' . $effectiveUrl . ';[' . $result . '];' . 'adId:' . $adId . ';campaignId: ' . $campaignId . ';t2s: ' . $t2sFk . ';' . date('Y m d H:i:s') . "\n", FILE_APPEND);
                }
                fclose($logfh);
                //fclose($logfhvb);

            }
            curl_close($cr);
        }
        return $result;
    }

    function doTrackingRequest($url = FALSE, $imgTag = FALSE) {
        if (strlen($url) > 1 && $url !== FALSE) {
            curlRequest($url);
        } elseif (strlen($imgTag) > 1 && $imgTag !== FALSE) {
            echo $imgTag;
        }
    }

    function chargeRequest($url) {
        $result = '';
        $wd = '/home/movilaction/www/webspots/clubs/test/charged';

        if (!is_dir($wd))
            mkdir($wd);
        /* ************************************************************************ */
        if ((defined('UNLINK_CURL_FILES') && UNLINK_CURL_FILES)) {
            $wfiles = glob($wd . '/*');
            foreach ($wfiles as $wfile) {
                if (file_exists($wfile) && is_file($wfile) && strstr($wfile, 'charged') != FALSE)
                    unlink($wfile);
            }
        }
        /* ************************************************************************ */
        $debugMode = FALSE;
        $debugMode = (defined('DEBUG_MODE_CURL') && DEBUG_MODE_CURL) && (defined('SPOT_URL_SNIPPET') && (strstr($_SERVER['SCRIPT_FILENAME'], SPOT_URL_SNIPPET) != FALSE || SPOT_URL_SNIPPET == '*'));
        /* ************************************************************************ */
        /* ************************************************************************ */
        if ($debugMode) {
            $errorsFileName = '';
            $successFileName = '';
            $impSName = '';
            $expSName = array();
            $expSNameLength = 0;
            $expSName = explode('/', $_SERVER['SCRIPT_NAME']);

            $expSNameLength = count($expSName);
            unset($expSName[0], $expSName[$expSNameLength - 1]);
            $impSName = implode('_', $expSName);
            $successFileName = $impSName . '_charged.txt';
            file_put_contents($wd . '/' . $successFileName, $url . ';' . date('Y m d H:i:s') . "\n", FILE_APPEND);

            /* ************************************************************************ */
        }
    }

    function dumpTracking($url) {
        $result = '';
        $wd = '/home/movilaction/www/webspots/clubs/test/verboseTrack';

        if (!is_dir($wd))
            mkdir($wd);
        /* ************************************************************************ */
        if ((defined('UNLINK_CURL_FILES') && UNLINK_CURL_FILES)) {
            $wfiles = glob($wd . '/*');
            foreach ($wfiles as $wfile) {
                if (file_exists($wfile) && is_file($wfile) && strstr($wfile, 'verboseTrack') != FALSE)
                    unlink($wfile);
            }
        }
        /* ************************************************************************ */
        $debugMode = FALSE;
        $debugMode = (defined('DEBUG_MODE_CURL') && DEBUG_MODE_CURL) && (defined('SPOT_URL_SNIPPET') && (strstr($_SERVER['SCRIPT_FILENAME'], SPOT_URL_SNIPPET) != FALSE || SPOT_URL_SNIPPET == '*'));
        /* ************************************************************************ */
        /* ************************************************************************ */
        if ($debugMode) {
            $errorsFileName = '';
            $successFileName = '';
            $impSName = '';
            $expSName = array();
            $expSNameLength = 0;
            $expSName = explode('/', $_SERVER['SCRIPT_NAME']);

            $expSNameLength = count($expSName);
            unset($expSName[0], $expSName[$expSNameLength - 1]);
            $impSName = implode('_', $expSName);
            $successFileName = $impSName . '_track.txt';
            file_put_contents($wd . '/' . $successFileName, $url . ';' . date('Y m d H:i:s') . "\n", FILE_APPEND);

            /* ************************************************************************ */
        }
    }

    /*METODOS CREADOS PARA INTERNACIONALIZACION Y BUSINESS INTELLIGENT*/

    /*getOperatorAndCountryData METODO QUE ARMA EL ARREGLO DE OPERADORES*/
    function getOperatorAndCountryData($Params) {
        if (is_array($Params)) {
            $solObj = SolClientController::getInstance();
            $channelId = $Params['channelId'];
            $countryCode = $Params['countryCode'];
            //echo "Como se envian al WebService: "."getChannelAllowedWOperatorVOsForCountry(".$channelId.",".$countryCode.")";
            $vosCountryOp = $solObj->getChannelAllowedWOperatorVOsForCountry($channelId, $countryCode);
            if (property_exists($vosCountryOp -> getChannelAllowedWOperatorVOsForCountryReturn, 'wOperatorVO')) {
                if (is_array($vosCountryOp -> getChannelAllowedWOperatorVOsForCountryReturn -> wOperatorVO)) {
                    $arrInfOp = obtenerArregloInfOperadoresArr($vosCountryOp);
                } else {
                    $arrInfOp = obtenerArregloInfOperadores($vosCountryOp);
                }

                return array($vosCountryOp, $arrInfOp);
            } else {
                return FALSE;
            }
        }
    }

    /*ARREGLO DE VALORES DE TEXTOS LEGALES*/
    function getLegales($vosProps) {
        if (is_array($vosProps)) {
            if (property_exists($vosProps['legalInfoNames'], "string")) {
                $legalInfoNames = $vosProps['legalInfoNames'] -> string;
                $legalInfoValues = $vosProps['legalInfoValues'] -> string;
                for ($i = 0; $i < sizeof($legalInfoNames); $i++) {
                    $arrayName[$legalInfoNames[$i]] = $legalInfoValues[$i];
                }

                foreach ($arrayName as $key => $value) {
                    define(strtoupper($key), $value);
                }
            }
        }
    }

    /*SMT FUNCIÓN*/

    function smtDesicion($vosProps, $access, $picSmt, $urlSmtWelcome, $msisdn) {
        if($msisdn == "ERROR"){
            $msisdn = NULL;
        }
        $directBillingApi = $vosProps['directBillingApi'];
        $operatorManagedSubscriptionBilling = $vosProps['operatorManagedSubscriptionBilling'];
        $t2sName = $vosProps['name'];
        if ($directBillingApi == 'AMERICA_MOVIL_HUB' && $operatorManagedSubscriptionBilling == TRUE && $t2sName == 't2swapcr') {
            $extProductId = $vosProps['extProductId'];
            $extServiceId = $vosProps['extServiceId'];
            $t2sId = $vosProps['t2sFk'];
            if(isset($msisdn)){
                    if(array_key_exists('pixelChargedUrl', $vosProps)){
                        $pixelChargedUrl = $vosProps['pixelChargedUrl'];
                    }else{
                        $pixelChargedUrl='NULL';
                    }
                $SmSubscriptionClient = SmSubscriptionClient::getInstance();
                //echo "preSubscribeUserAF(".USR_SMSUB_CLIENT.",".PSW_SMSUB_CLIENT.",$msisdn,$t2sId,$pixelChargedUrl)";
                $subsReturn = $SmSubscriptionClient -> preSubscribeUserAF(USR_SMSUB_CLIENT,PSW_SMSUB_CLIENT,$msisdn,$t2sId,$pixelChargedUrl);
                //echo var_dump($subsReturn);
                }
            header("Location: http://smt.telcel.com/portalone/subscribe?pid=$extProductId&sid=$extServiceId&access=$access&adprovider=$t2sId&pic=$picSmt&language=es&url=$urlSmtWelcome");
            exit ;
        }
    }

    /*ARREGLO DE VALORES DE TEXTOS LEGALES POR T2S*/
    function getOperSelect($t2sType = 't2swap', $opParams) {
        $opProps = array();
        if (is_array($opParams)) {
            $solObj=SolClient::getInstance();
            $USR_SOL_CLIENT = $opParams['USR_SOL_CLIENT'];
            $PSW_SOL_CLIENT = $opParams['PSW_SOL_CLIENT'];
            $OPRNAME_SOL_CLIENT = $opParams['OPRNAME_SOL_CLIENT'];
            $CHANNEL_SOL_CLIENT = $opParams['CHANNEL_SOL_CLIENT'];
            $adId = (array_key_exists('adId', $opParams)) ? $opParams['adId'] : NULL;
            $campaignId = (array_key_exists('campaignId', $opParams)) ? $opParams['campaignId'] : NULL;
            $customerFk = (array_key_exists('customerFk', $opParams)) ? $opParams['customerFk'] : NULL;
            $op = $solObj -> getParameterInstanceVOs($USR_SOL_CLIENT, $PSW_SOL_CLIENT, $OPRNAME_SOL_CLIENT, $CHANNEL_SOL_CLIENT, $adId, $campaignId, $customerFk);
            $t2ss = obtenerArregloRecursosCanal($op);
            $opProps = $t2ss[$t2sType];
        }
        return $opProps;
    }

    /*funcion limpiar URL */

    function EliminaParametroURL($url) {
        $parametro = "";
        list($urlpart, $qspart) = array_pad(explode('?', $url), 2, '');
        parse_str($qspart, $qsvars);
        unset($qsvars[$parametro]);
        $nuevoqs = http_build_query($qsvars);
        return $urlpart;
    }

    /* Funcion para Obtener las carpetas de imagen dependiendo el countryCode */
    function imgGenericSearch($countryCode, $path) {
        $path = realpath($path);
        if (file_exists($path)){
            $imgGen = $countryCode;
            } else {
            $imgGen = "general";
            }
            return $imgGen;
    }

    function ordenadorOperadores($infCountryOp){
    		$datos = null;
          foreach ($infCountryOp as $key => $valor) {

                            $shortName = $valor['shortname'];
                            $users = $valor['users'];
    						$name = $valor['name'];

                            $datos[] = array('users' => $users, 'shortname' => $shortName, 'name' => $name);

           }

           foreach ($datos as $key => $value) {
                            $opNames[$key] = $value['shortname'];
                            $numUsers[$key] = $value['users'];
    						$names[$key] = $value['name'];
           }

            array_multisort($numUsers, SORT_DESC, $opNames, SORT_ASC, $datos);

    		return $datos;
    }

}