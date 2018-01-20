<?php
error_reporting(E_ALL);
ini_set('display_errors', 1);

require_once 'easyar-cloud.php';

	$targetName 	= "mototaxi";
	$imageLocation 	= "https://carrotapp.live/wp-content/uploads/2017/09/451343-bajaj-auto.jpg";
    $metadata 	= "http://carrot.zoftcoapps.com/wp-content/uploads/2017/07/20170603_131415.mp4";


    $easyar = new EasyARCloudAPISample;
    echo $easyar->getDateTime();
    print_r($easyar->targetAdd($targetName,"10",getImage($imageLocation),"1",""));




	function getImage($imageLocation){
		
		$file = file_get_contents( $imageLocation );
		
		if( $file ){

            return $file;
		}
		else
        {
            return 0;
        }
	
	}