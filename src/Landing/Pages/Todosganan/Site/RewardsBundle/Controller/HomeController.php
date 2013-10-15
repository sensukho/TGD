<?php

namespace Landing\Pages\Todosganan\Site\RewardsBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;

class HomeController extends Controller
{
    public function indexAction()
    {
    	$client = RewardServiceClient::getInstance();
		$rsId = 444788434;
		$period = '2013-08';
		$rewardId = 0;
    	$rewards = $client->findRunningServiceReward($rsId,$period,$rewardId);
		$rewards = array(array('active' => 'false', 'description' => '<div><img class="imgs" src="/bundles/todosganan/rewards/img/rew/2.png" /></div>','id' => '292700436', 'image' => 'a', 'reward' => '50,000 puntos para el Mega Premio Mensual', 'rewardPoints' => '50000', 'type' => 'HIGH', 'valid' => 'true'),
						 array('active' => 'false', 'description' => '<div><img class="imgs" src="/bundles/todosganan/rewards/img/rew/1.png" /></div>','id' => '374857791', 'image' => 'a', 'reward' => '40% de descuento en productos Hello Kitty en Caramelrocker', 'rewardPoints' => '0', 'type' => 'HIGH', 'valid' => 'true'),
						 array('active' => 'false', 'description' => '<div><img class="imgs" src="/bundles/todosganan/rewards/img/rew/4.png" /></div>','id' => '374861529', 'image' => 'a', 'reward' => '50% de descuento en media docena de cupcakes en Caramelrocker', 'rewardPoints' => '0', 'type' => 'HIGH', 'valid' => 'true'),
						 array('active' => 'false', 'description' => '<div><img class="imgs" src="/bundles/todosganan/rewards/img/rew/3.png" /></div>','id' => '374864750', 'image' => 'a', 'reward' => 'Descuentos en Privalia', 'rewardPoints' => '0', 'type' => 'HIGH', 'valid' => 'true'),
						 array('active' => 'false', 'description' => '<div><img class="imgs" src="/bundles/todosganan/rewards/img/rew/4.png" /></div>','id' => '374865475', 'image' => 'a', 'reward' => '2x1 en desayunos, ensaladas,wraps o pastas en Kuh Salads!', 'rewardPoints' => '0', 'type' => 'HIGH', 'valid' => 'true'),
						 array('active' => 'false', 'description' => '<div><img class="imgs" src="/bundles/todosganan/rewards/img/rew/3.png" /></div>','id' => '434825944', 'image' => 'a', 'reward' => '¡2 Coches por el precio de 1 en Autocinema Coyote!', 'rewardPoints' => '0', 'type' => 'HIGH', 'valid' => 'true'),
						 array('active' => 'false', 'description' => '<div><img class="imgs" src="/bundles/todosganan/rewards/img/rew/2.png" /></div>','id' => '434835958', 'image' => 'a', 'reward' => '¡Palomitas gratis en Autocinema Coyote!', 'rewardPoints' => '0', 'type' => 'HIGH', 'valid' => 'true'),
						 array('active' => 'false', 'description' => '<div><img class="imgs" src="/bundles/todosganan/rewards/img/rew/3.png" /></div>','id' => '434825944', 'image' => 'a', 'reward' => '¡2 Coches por el precio de 1 en Autocinema Coyote!', 'rewardPoints' => '0', 'type' => 'HIGH', 'valid' => 'true'),
						 array('active' => 'false', 'description' => '<div><img class="imgs" src="/bundles/todosganan/rewards/img/rew/3.png" /></div>','id' => '434825944', 'image' => 'a', 'reward' => '¡2 Coches por el precio de 1 en Autocinema Coyote!', 'rewardPoints' => '0', 'type' => 'HIGH', 'valid' => 'true'));
		//$rewards = $client->sortRewards($rewards);
		$numDivs = $client->getNumPages(sizeof($rewards));
		$pages = $client->getPagesRewards($rewards);
		$i = 0;
		$j = 0;
        return $this->render('LandingPagesTodosgananSiteRewardsBundle:Home:index.html.twig', array('pages'=>$pages, 'numPages' => $numDivs, 'i' => $i, 'j' => $j));
    }

    public function viewrewardAction()
    {
    	$reward = '
			<div id="convert-image">
				<div>
					<img id="si" src="/bundles/todosganan/rewards/img/rew/si_btn.png">
					<img id="no" src="/bundles/todosganan/rewards/img/rew/no_btn.png">
				</div>
			</div>
    	';
        return $this->render('LandingPagesTodosgananSiteRewardsBundle:Home:reward.html.twig', array('reward' => $reward));
    }

    public function okrewardAction()
    {
    	$reward = '
			<div id="ok-image">
				<img id="close-image" src="/bundles/todosganan/rewards/img/rew/close.png" alt="Cerrar" />
			</div>
    	';
        return $this->render('LandingPagesTodosgananSiteRewardsBundle:Home:reward.html.twig', array('reward' => $reward));
    }
}
