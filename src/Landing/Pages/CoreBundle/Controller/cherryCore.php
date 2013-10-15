<?php

namespace Landing\Pages\CoreBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\Request;
######################################################
class cherryCore  extends Controller
{
	public $sysvars;
    public static $instance = NULL;
	/************************************************************************************************************/
    public function __construct(){
        $sysvars = array();
    }
    /************************************************************************************************************/
    public static function getInstance() {
        if(!isset(self::$instance)) {
			self::$instance = new cherryCore();
        }
        return self::$instance;
    }
    /************************************************************************************************************/
	public function setConfig($request,$cat,$cat_bundle,$site,$site_bundle){
		$this->sysvars = array(
			'config'  => array(
				'portal' => array(
					'name' => $cat,
					'bundle' => $cat_bundle
				),
				'site' => array(
					'name' => $site,
					'bundle' => $site_bundle
				),
				'webspot' => array(
					'sol' => array(
						'USR_SOL_CLIENT' => 'mgywebspots',
						'PSW_SOL_CLIENT' => 'webspots5432',

						'USR_SMSUB_CLIENT' => 'mobilogy-suscripciones',
						'PSW_SMSUB_CLIENT' => 'rwqrqw235'
					),
					'channels' => array(
						'rsgueras' => '1181',
						'redsocial' => '1229',
						'rsguerasv2' => '1989',
						'redsocialv2' => '1288',
						'vidaspasadas' => '1646',
						'chicos' => '515',
						'amigos' => '27',
						'tarot-pruebas' => '3787',
						'match-pruebas' => '3787',
						'tarot' => '218',
						'agenciachicas' => '2159',
						'tuentrenadorpersonal' => '2270',
						'rebeca' => '646',
						'table' => '2342',
						'charlasardientes' => '2382',
						'match' => '20851',
						'complacelas' => '22458',
						'vipclub' => '1040186',
						'conderechos' => '1040136',
						'agregaamigos' => '1419878',
						'grady' => '1591451',
						'enigma' => '1777195',
						'flirt' => '60433822',

						'gadgets' => '94688469',
						'subscribe' => '94688469'
					)
				)
			),
			'web'  => array(
				'webspot' => array(
					'formfields' => array(
						//'NOMBRE' => array('key' => 'NOMBRE', 'val' => $request->query->get('campaignId',NULL), 'type' => 'TIPO_CAMPO_FORMULARIO', 'PAGINA_A_DESPLEGAR' => 1),
						'error' => array('key' => 'error', 'val' => NULL, 'msg' => NULL, 'type' => 'none', 'wppage' => 0),
						'campaignId' => array('key' => 'campaignId', 'val' => $request->query->get('campaignId',NULL), 'type' => 'hidden', 'wppage' => 0),
						'adId' => array('key' => 'adId', 'val' => $request->query->get('adId',NULL), 'type' => 'hidden', 'wppage' => 0),
						'msisdn' => array('key' => 'msisdn', 'val' => NULL, 'type' => 'text', 'wppage' => 1),
						'msisdnPattern' => array('key' => 'msisdnPattern', 'val' => NULL, 'type' => 'none', 'wppage' => 0),
						'pin' => array('key' => 'pin', 'val' => NULL, 'type' => 'text', 'wppage' => 2),
						'subscriptionId' => array('key' => 'subscriptionId', 'val' => NULL, 'type' => 'text', 'wppage' => 0),
						'opName' => array('key' => 'opName', 'val' => 0, 'type' => 'hidden', 'wppage' => 0, 'op' => NULL, 'name' => $request->query->get('opName',NULL) ),
				    	'countryCode' => array('key' => 'countryCode', 'val' => $request->query->get('countryCode',NULL), 'type' => 'hidden', 'wppage' => 0),
				    	't2s' => array('key' => 't2s', 'val' => 't2sweb', 'type' => 'hidden', 'wppage' => 0),
				    	'trafficSourceParam' => array('key' => 'trafficSourceParam', 'val' => $request->query->get('trafficSourceParam',NULL), 'type' => 'hidden', 'wppage' => 0),
				    	'customerFk' => array('key' => 'customerFk', 'val' => NULL, 'type' => 'hidden', 'wppage' => 0),
				    	'customId' => array('key' => 'customId', 'val' => $request->query->get('customId',NULL), 'type' => 'hidden', 'wppage' => 0),
				    	'subscriptionUseMoConfirmation' => array('key' => 'subscriptionUseMoConfirmation', 'val' => $request->query->get('trafficSourceParam',NULL), 'type' => 'hidden', 'wppage' => 0),
				    	'terms_ok' => array('key' => 'terms_ok', 'val' => NULL, 'type' => 'checkbox', 'wppage' => 0, 'terms' => 'WEB_TERMS_CKBOX'),
				    	'parameterId' => array('key' => 'parameterId', 'val' => NULL, 'type' => NULL, 'wppage' => 0),
				    	'shortcodeOperatorMappingId' => array('key' => 'shortcodeOperatorMappingId', 'val' => NULL, 'type' => NULL, 'wppage' => 0),
				    	'page' => array('key' => 'page', 'val' => $this->EliminaParametroURL(), 'type' => 'ENTRY', 'wppage' => 0),
				    	'previousPage' => array('key' => 'page', 'val' => NULL, 'type' => NULL, 'wppage' => 0),
				    	'pageType' => array('key' => 'page', 'val' => NULL, 'type' => NULL, 'wppage' => 0),
				    	'access' => array('key' => 'access', 'val' => 'web', 'type' => 'ENTRY', 'wppage' => 0),
				    	'webUserId' => array('key' => 'webUserId', 'val' => NULL, 'type' => NULL, 'wppage' => 0),
				    	'checkbox' => array('key' => 'checkbox', 'val' => '0', 'type' => 'checkbox', 'wppage' => 0, 'op' => NULL),
				    	'subscriptionUseMoConfirmation' => array('key' => 'subscriptionUseMoConfirmation', 'val' => NULL, 'type' => 'none', 'wppage' => 0)
					),
					'legals' => array(
						'web_top_legal' => array('val' => NULL),
						'web_lower_legal' => array('val' => NULL),
						'web_terms_and_conditions' => array('val' => NULL),
						'web_terms_and_conditions_checkbox' => array('val' => NULL),
						'wap_top_legal' => array('val' => NULL),
						'wap_lower_legal' => array('val' => NULL),
						'wap_terms_and_conditions' => array('val' => NULL),
						'wap_title_terms_and_conditions' => array('val' => NULL),
						'wap_content_terms_and_conditions' => array('val' => NULL),
						'wap_title_atc' => array('val' => NULL),
						'wap_content_atc' => array('val' => NULL),
						'wapcr_top_legal' => array('val' => NULL),
						'wapcr_lower_legal' => array('val' => NULL),
						'web_pic_smt' => array('val' => NULL),
						'web_url_smt' => array('val' => NULL),
						'wap_pic_smt' => array('val' => NULL),
						'wap_url_smt' => array('val' => NULL),
						'webTop' => array('val' => 'Servicio exclusivo para mayores de edad')
					)
				)
			)
		);
		$this->getCountryCode();
		$this->getOpName();
		$this->getCheckBox($request);
		return $this->sysvars;
	}
	/************************************************************************************************************/
	public function setPinConfig($request){
		$this->sysvars['web']['webspot']['formfields']['msisdn']['val'] = $request->request->get('msisdn',NULL);
		$this->getOpName();
		$this->getCheckBox($request);
		return $this->sysvars;
	}
	/************************************************************************************************************/
	public function setRegConfig($request){
		$this->sysvars['web']['webspot']['formfields']['pin']['val'] = $request->request->get('pin',NULL);
		$this->getOpName();
		$this->getCheckBox($request);
		return $this->sysvars;
	}
	/************************************************************************************************************/
	public function getLegals($request){
		$this->sysvars['web']['webspot']['formfields']['opName']['name'] = $request->request->get('opName',NULL);
		$this->getOpName();
		$this->getCheckBox($request);
		return $this->sysvars;
	}
	/************************************************************************************************************/
	public function setMsisdnConfig($request){
		//$this->sysvars['web']['webspot']['formfields']['msisdn']['val'] = '5510987654';
        $this->sysvars['web']['webspot']['formfields']['msisdn']['val'] = $this->obtieneNumeroTelefonicoHTTP();
		//$this->getOpName();
		//$this->getCheckBox();
		return $this->sysvars;
	}
	/************************************************************************************************************/
	public function sendMsisdn(){
		$Helper = new Helper();
		$this->sysvars['web']['webspot']['formfields']['error']['val'] = NULL;
		$solObj = SolClientController::getInstance();
		$vosParams = array(
			'USR_SOL_CLIENT' => $this->sysvars['config']['webspot']['sol']['USR_SOL_CLIENT'],
			'PSW_SOL_CLIENT' => $this->sysvars['config']['webspot']['sol']['PSW_SOL_CLIENT'],
			'OPRNAME_SOL_CLIENT' => $this->sysvars['web']['webspot']['formfields']['opName']['name'],
			'CHANNEL_SOL_CLIENT' => $this->sysvars['config']['webspot']['channels'][ $this->sysvars['config']['site']['name'] ],
			'adId' => $this->sysvars['web']['webspot']['formfields']['adId']['val'],
			'campaignId' => $this->sysvars['web']['webspot']['formfields']['campaignId']['val'],
			'customerFk' => $this->sysvars['web']['webspot']['formfields']['customerFk']['val']
		);
		$hitsParams = array(
			'USR_SOL_CLIENT' => $this->sysvars['config']['webspot']['sol']['USR_SOL_CLIENT'],
			'PSW_SOL_CLIENT' => $this->sysvars['config']['webspot']['sol']['PSW_SOL_CLIENT'],
			'webUserId' => $this->sysvars['web']['webspot']['formfields']['webUserId']['val'],
			'CHANNEL_SOL_CLIENT' => $this->sysvars['config']['webspot']['channels'][ $this->sysvars['config']['site']['name'] ],
			'campaignId' => $this->sysvars['web']['webspot']['formfields']['campaignId']['val'],
			'adId' => $this->sysvars['web']['webspot']['formfields']['adId']['val'],
			'parameterId' => $this->sysvars['web']['webspot']['formfields']['parameterId']['val'],
			'shortcodeOperatorMappingId' => $this->sysvars['web']['webspot']['formfields']['shortcodeOperatorMappingId']['val'],
			'page' => $this->sysvars['web']['webspot']['formfields']['page']['val'],
			'previousPage' => '',
			'pageType' => $this->sysvars['web']['webspot']['formfields']['page']['type'],
			'msisdn' => $this->sysvars['web']['webspot']['formfields']['msisdn']['val'],
			'trafficSourceParam' => $this->sysvars['web']['webspot']['formfields']['trafficSourceParam']['val']
		);
		$vos = $solObj->getParameterInstanceVOs(
			$this->sysvars['config']['webspot']['sol']['USR_SOL_CLIENT'],
			$this->sysvars['config']['webspot']['sol']['PSW_SOL_CLIENT'],
			$this->sysvars['web']['webspot']['formfields']['opName']['name'],
			$this->sysvars['config']['webspot']['channels'][ $this->sysvars['config']['site']['name'] ],
			$this->sysvars['web']['webspot']['formfields']['adId']['val'],
			$this->sysvars['web']['webspot']['formfields']['campaignId']['val'],
			$this->sysvars['web']['webspot']['formfields']['customerFk']['val']
		);
		list($vosProps, $hitsProps) = $Helper->getVosPropsByT2sType($t2sType = 't2sweb', $vosParams, $hitsParams);
		$this->sysvars['web']['webspot']['formfields']['msisdnPattern']['val'] = $vosProps['msisdnPattern'];
        $this->sysvars['web']['webspot']['formfields']['campaignId']['val'] = $vosProps['campaignId'];
        $this->sysvars['web']['webspot']['formfields']['adId']['val'] = $vosProps['adId'];
        $this->sysvars['web']['webspot']['formfields']['subscriptionUseMoConfirmation']['val'] = $vosProps['subscriptionUseMoConfirmation'];
 		if($this->sysvars['web']['webspot']['formfields']['subscriptionUseMoConfirmation']['val'] == FALSE){ $this->sysvars['web']['webspot']['formfields']['subscriptionUseMoConfirmation']['val'] = FALSE; }else{ $this->sysvars['web']['webspot']['formfields']['subscriptionUseMoConfirmation']['val'] = TRUE; }
        $respuestaStatHit = $hitsProps->statHitReturn;
        $this->sysvars['web']['webspot']['formfields']['webUserId']['val'] = $respuestaStatHit->id;
		$t2ss = obtenerArregloRecursosCanal($vos);
		$t2swapProps = $t2ss['t2sweb'];
		if(strlen($t2swapProps['t2sFk']) > 0){
	        if(strcasecmp($this->sysvars['web']['webspot']['formfields']['countryCode']['val'],"cr") == 0){
	                $this->sysvars['web']['webspot']['formfields']['msisdn']['val'] =  "506".$this->sysvars['web']['webspot']['formfields']['msisdn']['val'];
	        }
			if(strcasecmp($this->sysvars['web']['webspot']['formfields']['opName']['name'],"nextel-mx") == 0){
	                $this->sysvars['web']['webspot']['formfields']['msisdn']['val'] =  "52".$this->sysvars['web']['webspot']['formfields']['msisdn']['val'];
	        }
			if(!$this->validaFormatoMSISDN($this->sysvars['web']['webspot']['formfields']['msisdn']['val']) || $this->sysvars['web']['webspot']['formfields']['msisdn']['val']=='')
			{
				$errorTxt = base64_encode(1);
				$this->sysvars['web']['webspot']['formfields']['error']['val'] = $errorTxt;
			}
	        if(strcasecmp($this->sysvars['web']['webspot']['formfields']['countryCode']['val'],"ec") == 0){
	                $this->sysvars['web']['webspot']['formfields']['msisdn']['val'] =  substr($this->sysvars['web']['webspot']['formfields']['msisdn']['val'], 1);
	        }
			$subsObj = SmSubscriptionClientController::getInstance();
			try
			{
				$trackingUrl=NULL;
				$moForcePin = FALSE;
				if( !(($this->sysvars['config']['webspot']['channels'][ $this->sysvars['config']['site']['name'] ] == 65352668) || ($this->sysvars['config']['webspot']['channels'][ $this->sysvars['config']['site']['name'] ] == 66596562) || ($this->sysvars['config']['webspot']['channels'][ $this->sysvars['config']['site']['name'] ] == 66594995) || ($this->sysvars['config']['webspot']['channels'][ $this->sysvars['config']['site']['name'] ] == 66593928)) && ($this->sysvars['web']['webspot']['formfields']['opName']['name'] == 'telcel-mx')){
					$moForcePin = TRUE;
					$this->sysvars['web']['webspot']['formfields']['subscriptionUseMoConfirmation']['val'] = FALSE;
				}
				if($this->sysvars['web']['webspot']['formfields']['subscriptionUseMoConfirmation']['val'] == TRUE){
					$moForcePin = FALSE;
				}
				$subscriptionIdObj = $subsObj->subscribeUserAF(
					$this->sysvars['config']['webspot']['sol']['USR_SMSUB_CLIENT'],
					$this->sysvars['config']['webspot']['sol']['PSW_SMSUB_CLIENT'],
					$this->sysvars['web']['webspot']['formfields']['msisdn']['val'],
					$t2swapProps['t2sFk'],
					$moForcePin,
					$trackingUrl
				);
				@$subscriptionId = $subscriptionIdObj->subscribeUserReturn;
				if($subscriptionId == NULL) $subscriptionId = $subscriptionIdObj->subscribeUserAFReturn;
				$this->sysvars['web']['webspot']['formfields']['subscriptionId']['val'] = $subscriptionId;
			}
			catch(\SoapFault $fault)
			{
				$errorTxt = base64_encode( $this->errorHandler($fault) );
				$this->sysvars['web']['webspot']['formfields']['error']['val'] = $errorTxt;
				//var_dump($this->sysvars['web']['webspot']['formfields']['error']['val']);
				//var_dump($fault);
			}
		}
		return $this->sysvars;
	}
	/************************************************************************************************************/
	public function sendPin(){
		$this->sysvars['web']['webspot']['formfields']['error']['val'] = NULL;
		$this->sysvars['web']['webspot']['formfields']['shortcodeOperatorMappingId']['val'] = NULL;
		$this->sysvars['web']['webspot']['formfields']['page']['val'] = $this->EliminaParametroURL();
		$this->sysvars['web']['webspot']['formfields']['previousPage']['val'] = 'WEB';
		$this->sysvars['web']['webspot']['formfields']['pageType']['val'] = 'NAVIGATION';
		$vosParams = array(
			'USR_SOL_CLIENT' => $this->sysvars['config']['webspot']['sol']['USR_SOL_CLIENT'],
			'PSW_SOL_CLIENT' => $this->sysvars['config']['webspot']['sol']['PSW_SOL_CLIENT'],
			'OPRNAME_SOL_CLIENT' => $this->sysvars['web']['webspot']['formfields']['opName']['name'],
			'CHANNEL_SOL_CLIENT' => $this->sysvars['config']['webspot']['channels'][ $this->sysvars['config']['site']['name'] ],
			'adId' => $this->sysvars['web']['webspot']['formfields']['adId']['val'],
			'campaignId' => $this->sysvars['web']['webspot']['formfields']['campaignId']['val'],
			'customerFk' => $this->sysvars['web']['webspot']['formfields']['customerFk']['val']
		);

		$hitsParams = array(
			'login' => $this->sysvars['config']['webspot']['sol']['USR_SOL_CLIENT'],
			'password' => $this->sysvars['config']['webspot']['sol']['PSW_SOL_CLIENT'],
			'webUserId' => $this->sysvars['web']['webspot']['formfields']['webUserId']['val'],
			'channelId' => $this->sysvars['config']['webspot']['channels'][ $this->sysvars['config']['site']['name'] ],
			'campaignId' => $this->sysvars['web']['webspot']['formfields']['campaignId']['val'],
			'adId' => $this->sysvars['web']['webspot']['formfields']['adId']['val'],
			'parameterId' => $this->sysvars['web']['webspot']['formfields']['parameterId']['val'],
			'shortcodeOperatorMappingId' => $this->sysvars['web']['webspot']['formfields']['shortcodeOperatorMappingId']['val'],
			'page' => $this->sysvars['web']['webspot']['formfields']['page']['val'],
			'previousPage' => $this->sysvars['web']['webspot']['formfields']['previousPage']['val'],
			'pageType' => $this->sysvars['web']['webspot']['formfields']['pageType']['val'],
			'msisdn' => $this->sysvars['web']['webspot']['formfields']['msisdn']['val'],
			'trafficSourceParam' => $this->sysvars['web']['webspot']['formfields']['trafficSourceParam']['val']
		);
		if($this->sysvars['web']['webspot']['formfields']['subscriptionId']['val'] != ''){
			if(!$this->validaFormatoCodigoPIN($this->sysvars['web']['webspot']['formfields']['pin']['val'])){
				$errorTxt = base64_encode(2);
				$this->sysvars['web']['webspot']['formfields']['error']['val'] = $errorTxt;
			}

			$subsObj = SmSubscriptionClientController::getInstance();
			try
			{
				$subsObj->subscriptionPinConfirm(
					$this->sysvars['config']['webspot']['sol']['USR_SOL_CLIENT'],
					$this->sysvars['config']['webspot']['sol']['PSW_SOL_CLIENT'],
					$this->sysvars['web']['webspot']['formfields']['subscriptionId']['val'],
					$this->sysvars['web']['webspot']['formfields']['pin']['val']
				);
			}
			catch(\SoapFault $e)
			{
				$errorTxt = base64_encode(3);
				$this->sysvars['web']['webspot']['formfields']['error']['val'] = $errorTxt;
			}
		}else{
			$errorTxt = base64_encode(4);
				$this->sysvars['web']['webspot']['formfields']['error']['val'] = $errorTxt;
		}
        return $this->sysvars;
	}
	/************************************************************************************************************/
	public function getCountryCode(){
		if($this->sysvars['web']['webspot']['formfields']['countryCode']['val'] == NULL){
			//$ip = $_SERVER['REMOTE_ADDR'];
			$ip = '189.203.102.52'; // MX
			$CommonWSClient = SoapController::getInstance();
			$result = $CommonWSClient -> getOperatorVOWithRemoteIp($ip);
			$country = $result ->getOperatorVOWithRemoteIpReturn;
			$this->sysvars['web']['webspot']['formfields']['countryCode']['val'] = $country -> country;
		}
	}
	/************************************************************************************************************/
	public function getOpName(){
		$operadores = 0;
		if($this->sysvars['web']['webspot']['formfields']['opName']['name'] == NULL){
			$Helper = new Helper();
			$params = array('channelId' => $this->sysvars['config']['webspot']['channels'][ $this->sysvars['config']['site']['name'] ], 'countryCode' => $this->sysvars['web']['webspot']['formfields']['countryCode']['val']);
			if ($desicion = $Helper->getOperatorAndCountryData($params) != FALSE) {
				list($obInfCountryOp, $infCountryOp) = $Helper->getOperatorAndCountryData($params);
				if (is_array($obInfCountryOp)){
					$oper = $obInfCountryOp->getChannelAllowedWOperatorVOsForCountryReturn->wOperatorVO;
					$operador = $oper[1]->shortname;
					$opName = $operador;
					$this->sysvars['web']['webspot']['formfields']['opName']['val'] = 1;
	   				$this->sysvars['web']['webspot']['formfields']['opName']['op'] = $opName;
	   				$this->sysvars['web']['webspot']['formfields']['opName']['name'] = $opName;
				}else{
					$operOrdenados =  $Helper->ordenadorOperadores($infCountryOp);
					foreach ($operOrdenados as $valor) {
						$opName = $valor['shortname'];
						$this->sysvars['web']['webspot']['formfields']['opName']['val'] = 1;
	   					$this->sysvars['web']['webspot']['formfields']['opName']['op'] = $opName;
	   					$this->sysvars['web']['webspot']['formfields']['opName']['name'] = $opName;
						break;
					}
				}
				$operadores = 1;
			}
		}
		if($operadores==1 && sizeof($infCountryOp) > 1){
			$datos = null;
		    foreach ($infCountryOp as $key => $valor){
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
	   		//$infCountryOp = $datos;
	   		$this->sysvars['web']['webspot']['formfields']['opName']['val'] = 2;
	   		$this->sysvars['web']['webspot']['formfields']['opName']['op'] = $datos;
	   		$this->sysvars['web']['webspot']['formfields']['opName']['name'] = $datos[0]["shortname"];
		}
	}
	/************************************************************************************************************/
	public function getNav($request){
		if(preg_match('/(alcatel|amoi|android|avantgo|blackberry|benq|cell|cricket|docomo|elaine|htc|iemobile|iphone|ipad|ipaq|ipod|j2me|java|midp|mini|mmp|mobi|motorola|nec-|nokia|palm|panasonic|philips|phone|playbook|sagem|sharp|sie-|silk|smartphone|sony|symbian|t-mobile|telus|up\.browser|up\.link|vodafone|wap|webos|wireless|xda|xoom|zte)/i', $request->headers->get('user-agent'))){
            return "wap";
        }else{
            return "web";
        }
	}
	/************************************************************************************************************/
	public function getCheckBox($reqVars){
		$Helper = new Helper();
		$Traking = new trakingHelper();
		$vosParams = array(
			'USR_SOL_CLIENT' => $this->sysvars['config']['webspot']['sol']['USR_SOL_CLIENT'],
			'PSW_SOL_CLIENT' => $this->sysvars['config']['webspot']['sol']['PSW_SOL_CLIENT'],
			'OPRNAME_SOL_CLIENT' => $this->sysvars['web']['webspot']['formfields']['opName']['name'],
			'CHANNEL_SOL_CLIENT' => $this->sysvars['config']['webspot']['channels'][ $this->sysvars['config']['site']['name'] ],
			'adId' => $this->sysvars['web']['webspot']['formfields']['adId']['val'],
			'campaignId' => $this->sysvars['web']['webspot']['formfields']['campaignId']['val'],
			'customerFk' => $this->sysvars['web']['webspot']['formfields']['customerFk']['val']
		);
		$hitsParams = array(
			'USR_SOL_CLIENT' => $this->sysvars['config']['webspot']['sol']['USR_SOL_CLIENT'],
			'PSW_SOL_CLIENT' => $this->sysvars['config']['webspot']['sol']['PSW_SOL_CLIENT'],
			'webUserId' => $this->sysvars['web']['webspot']['formfields']['webUserId']['val'],
			'CHANNEL_SOL_CLIENT' => $this->sysvars['config']['webspot']['channels'][ $this->sysvars['config']['site']['name'] ],
			'campaignId' => $this->sysvars['web']['webspot']['formfields']['campaignId']['val'],
			'adId' => $this->sysvars['web']['webspot']['formfields']['adId']['val'],
			'parameterId' => $this->sysvars['web']['webspot']['formfields']['parameterId']['val'],
			'shortcodeOperatorMappingId' => $this->sysvars['web']['webspot']['formfields']['shortcodeOperatorMappingId']['val'],
			'page' => $this->sysvars['web']['webspot']['formfields']['page']['val'],
			'previousPage' => '',
			'pageType' => $this->sysvars['web']['webspot']['formfields']['page']['type'],
			'msisdn' => $this->sysvars['web']['webspot']['formfields']['msisdn']['val'],
			'trafficSourceParam' => $this->sysvars['web']['webspot']['formfields']['trafficSourceParam']['val']
		);

		list($vosProps, $hitsProps) = $Helper->getVosPropsByT2sType($t2sType = 't2sweb', $vosParams, $hitsParams);
		$Helper->getLegales($vosProps);
		$showConfirmationCheckbox = $vosProps['showConfirmationCheckbox'];
		if($showConfirmationCheckbox==TRUE){
			$this->sysvars['web']['webspot']['formfields']['checkbox']['val'] = 1;
		}else{
			$this->sysvars['web']['webspot']['formfields']['checkbox']['val'] = 0;
		}

		$legalInfoNames = $vosProps['legalInfoNames'] -> string;
        $legalInfoValues = $vosProps['legalInfoValues'] -> string;
        for ($i = 0; $i < sizeof($legalInfoNames); $i++) {
            $arrayName[$legalInfoNames[$i]] = $legalInfoValues[$i];
        }
        foreach ($arrayName as $key => $value) {
            $this->sysvars['web']['webspot']['legals'][strtolower($key)]['val'] = $value;
        }

        $this->sysvars['web']['webspot']['formfields']['msisdnPattern']['val'] = $vosProps['msisdnPattern'];
        $this->sysvars['web']['webspot']['formfields']['campaignId']['val'] = $vosProps['campaignId'];
        $this->sysvars['web']['webspot']['formfields']['adId']['val'] = $vosProps['adId'];
        $this->sysvars['web']['webspot']['formfields']['subscriptionUseMoConfirmation']['val'] = $vosProps['subscriptionUseMoConfirmation'];
        $respuestaStatHit = $hitsProps->statHitReturn;
        $this->sysvars['web']['webspot']['formfields']['webUserId']['val'] = $respuestaStatHit->id;

        $Traking->setTrackingConfig($vosProps, $reqVars);
	}
	/************************************************************************************************************/
	public function EliminaParametroURL(){
		//$domain = $_SERVER['HTTP_HOST'];
		//$url = "http://" . $domain . $_SERVER['REQUEST_URI'];
		$url = "http://chatearenvivo.com/complacelas/web/webspot.php?&countryCode=mx";
		$parametro = "";
		list($urlpart, $qspart) = array_pad(explode('?', $url), 2, '');
		parse_str($qspart, $qsvars);
		unset($qsvars[$parametro]);
		$nuevoqs = http_build_query($qsvars);
		return $urlpart;
	}
	/************************************************************************************************************/
	public function validaFormatoMSISDN($msisdn){
		$patron = "/^".$this->sysvars['web']['webspot']['formfields']['msisdnPattern']['val']."$/";
		if (preg_match($patron, $msisdn)) {
    		return true;
		}
		return false;
	}
	/************************************************************************************************************/
	public function validaFormatoCodigoPIN($pin){
		$patron = "/^[0-9]{4}$/";
		if (preg_match($patron, $pin)) {
    		return true;
		}
		return false;
	}
	/************************************************************************************************************/
	public function errorHandler($fault){
		$pieces = explode('|', $fault);
		$errorNum = str_replace(':','',strrchr($pieces[0],':'));
		$errorNum = str_replace("-","",$errorNum);
		return $errorNum;
	}
	/************************************************************************************************************/
	function obtieneNumeroTelefonicoHTTP(){
		$arrayCabeceras = NULL;
		$strNumero = NULL;
		$arrayEtiquetasMSISDN = array(
			"HTTP_X_UP_CALLING_LINE_ID",
			"HTTP_MSISDN",
			"HTTP_X_FH_MSISDN",
			"MSISDN",
			"User-Identity-Forward-msisdn",
			"HTTP_X_MSISDN",
			"X-MSISDN",
			"HTTP_X_NOKIA_MSISDN",
			"HTTP_X_UP_SUBNO"
		);
		if(!is_null($arrayCabeceras)){
			$strNumero = "";
			foreach ($arrayEtiquetasMSISDN as $strNombreEtiqueta){
				@$strNumero = $arrayCabeceras[$strNombreEtiqueta];

				if(!is_null($strNumero) && strlen($strNumero) > 0 ){
					if (substr($strNumero,0,2) == '52' || substr($strNumero,0,2) == '57' )  {
						// Validación para numeros de México y Colombia
						return substr($strNumero, 2);
					}else{
						if (substr($strNumero,0,4) == '1829' || substr($strNumero,0,4) == '1849' )  {
						// Validación para numeros de Dominicana
						return substr($strNumero, 1);
					  }
					}
				}
			}
		}
		return false;
	}
	/************************************************************************************************************/
}
######################################################