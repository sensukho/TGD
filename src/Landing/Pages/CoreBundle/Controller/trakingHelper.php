<?php

namespace Landing\Pages\CoreBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\Request;

class trakingHelper  extends Controller
{
	public $sysvars;

	public function setTrackingConfig($vosProps, $reqVars){
		$Helper = new Helper();

		$trackingImages = $Helper->getTrackingImages($Helper->getTrackingUrls($vosProps, $reqVars));
		$trackingUrls = $Helper->getTrackingUrls($vosProps, $reqVars);

		if ((isset($trackingUrls['pixelChargedUrl']) && strstr($trackingUrls['pixelChargedUrl'], '__custom__') != FALSE) || (isset($trackingUrls['pixelConversionUrl']) && strstr($trackingUrls['pixelConversionUrl'], '__custom__') != FALSE) || (isset($trackingUrls['pixelTrackingUrl']) && strstr($trackingUrls['pixelTrackingUrl'], '__custom__') != FALSE)) {
			$faultChargedUrl = (isset($trackingUrls['pixelChargedUrl']) && strstr($trackingUrls['pixelChargedUrl'], '__custom__') != FALSE) ? 'Cargo ' . $trackingUrls['pixelChargedUrl'] : '';
			$faultConversionUrl = (isset($trackingUrls['pixelConversionUrl']) && strstr($trackingUrls['pixelConversionUrl'], '__custom__') != FALSE) ? 'Conversion ' . $trackingUrls['pixelConversionUrl'] : '';
			$faultTrackingUrl = (isset($trackingUrls['pixelTrackingUrl']) && strstr($trackingUrls['pixelTrackingUrl'], '__custom__') != FALSE) ? 'Rastreo ' . $trackingUrls['pixelTrackingUrl'] : '';
		}

		$trackingImage = $Helper->getUnserSessVar($arrayName='trackingImages',$elementName='pixelTrackingUrl');
		$trackingUrl = $Helper->getUnserSessVar($arrayName='trackingUrls',$elementName='pixelTrackingUrl');
		$Helper->doTrackingRequest($trackingUrl,$trackingImage);
	}
}