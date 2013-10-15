<?php
namespace Landing\Pages\Todosganan\Site\RewardsBundle\Controller;
class RewardServiceClient {
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
        $this->urlWsdl = "https://hive.mobilogy.com/bonobo/services/RewardService?wsdl";
        try {
            $this->client = new \SoapClient($this->urlWsdl);
        }
        catch(SoapFault $fault){
                echo "request failed. Returned error : ".$fault->faultcode."-".$fault->faultstring;
        }
    }

    //deveulve una isntancia de SolCliente sino existe una creada
    public static function getInstance() {
        if(!isset(self::$instance)) {
            try {
                self::$instance = new RewardServiceClient();
            }catch(SoapFault $fault){
                echo "request failed. Returned error : ".$fault->faultcode."-".$fault->faultstring;
            }
        }
        return self::$instance;
    }

    /*FUNCION PARA canjear una recompensa*/
    public function addRewardPoints($runningServiceId,$points,$rewardId,$period){
         try {
            $pCriteria = new \stdClass();
            $pCriteria->runningServiceId = $runningServiceId;
            $pCriteria->points = $points;
            $pCriteria->rewardId = $rewardId;
			$pCriteria->period=$period;
            $result=$this->client->addRewardPoints($pCriteria);
            return $result;
        }
            catch(Exception $fault){
                echo $fault;
                echo "ERROR IN WS addRewardPoints()";
            }
        }

    /*FUNCION PARA buscar una lista de recompensas para un periodo determinado*/
    public function findRunningServiceReward($rsId,$period,$rewardId){
         try {
            $pCriteria = new \stdClass();
            $pCriteria->rsId=$rsId;
            $pCriteria->period=$period;
            $pCriteria->rewardId=$rewardId;
            $result=$this->client->findRunningServiceReward($pCriteria);
            return $result->findRunningServiceRewardReturn->anyType;;

        }
        catch(SoapFault $fault){
            //echo $fault;
            echo "ERROR IN WS findRunningServiceReward";
        }
    }

    public function saveRunningServiceReward($rsId,$rewardId,$period){
        try {
                $pCriteria = new \stdClass();
                $pCriteria->rsId=$rsId;
                $pCriteria->rewardId=$rewardId;
                $pCriteria->period=$period;
                $result=$this->client->saveRunningServiceReward($pCriteria);
                return $result;
        }catch(SoapFault $fault){
            //echo $fault;
            echo "ERROR IN WS saveRunningServiceReward";
        }
    }
	
	
	function getNumPages($numRewards){
		$numDivs = ($numRewards / 4) + 1;
		return intval($numDivs);
	}
	
	function getPagesRewards($rewards){
		$pages = array();
		$page = array();
		$ids = array('sup_izq','sup_der','inf_izq', 'inf_der');
		$numPages = $this->getNumPages(sizeof($rewards));
		$tamPage = 4;
		$i = 0;
		$b = 0;
		for($a = 0; $a < $numPages; $a++){
			while ($i < $tamPage &&  $b < sizeof($rewards)) {
				$reward = $rewards[$b];
				//$description = str_replace('<div>', '<div id="'. $ids[$i]. '" class="'. $ids[$i]. '_'.$a.'">', $reward['description']);
                $description = str_replace('<div>', '<div id="'. $ids[$i]. '" class="rewards">', $reward['description']);
				$reward['description'] = $description;
				$page[$i] = $reward;
				$i++;
				$b++;
			}
			$i = 0;
			$pages[$a] = $page;
			$page = null;
			$page =  array();
		}
		return $pages;
	}
}