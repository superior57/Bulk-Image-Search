<?php 

require "vendor/autoload.php";


use PHPHtmlParser\Dom;
/**
* 
*/
class GoogleImageGrabber
{
	
	public static function grab($keyword, $trans, $customSize, $width, $height, $i, $options = [])
	{
		ini_set('default_socket_timeout', 900);	
		$keyword = trim($keyword);
		// $keyword = str_replace(' ', '+', $keyword);
		// var_dump($keyword);exit;
		
		$results = array();		
		$index = 0;
		$url = "https://www.google.com/search?q=" . urlencode($keyword) .  "&as_epq=".$i."&source=lnms&tbm=isch";
		if ( $trans == "true" )
			$url = "https://www.google.com/search?q=" . urlencode($keyword) . "&as_epq=".$i."&tbs=ic:trans&source=lnms&tbm=isch";
		if ( $customSize == "true" )
			$url = "https://www.google.com/search?q=" . urlencode($keyword) .  "&as_epq=".$i."&tbs=isz:ex,iszw:".$width.",iszh:".$height."&source=lnms&tbm=isch";
		if ( $trans == "true" && $customSize == "true" ) {
			$url = "https://www.google.com/search?q=" . urlencode($keyword) . "&as_epq=".$i."&tbs=isz:ex,iszw:".$width.",iszh:".$height.",ic:trans&source=lnms&tbm=isch";
		}
		// $url = "https://www.google.com/search?q=HPE%2BProLiant%2BML30%2BGen10&as_epq=1&source=lnms&tbm=isch";

		$ua = \Campo\UserAgent::random([
		    'os_type' => ['Windows', 'OS X'],
		    'device_type' => 'Desktop'

		]);

		$options  = [
			'http' => [
				'method'     =>"GET",
				'user_agent' =>  $ua,
			],
			'ssl' => [
				"verify_peer"      => FALSE,
				"verify_peer_name" => FALSE,
			],
			'https'=> [
        		"timeout" => 1200]];		
		
        	
		$context  = stream_context_create($options);
		
		$response = file_get_contents($url, FALSE, $context);


		$htmldom = new Dom;
		$htmldom->loadStr($response, []);
		// var_dump($response);exit;

		$results = [];

		foreach ($htmldom->find('.rg_di > .rg_meta') as $n => $dataset) {
			$index++;
			$jsondata = $dataset->text;



			$data = json_decode($jsondata);
			// $extension = explode(".", trim($data->ou));

   			$extension = $data->ity;
   			// var_dump($data);exit;

			// $file =  count($extension) - 2;
			// $filename = explode("/", $extension[$file]);
   			// $extension = explode("/", $extension[count($extension) - 1] );	

   			// $extension = preg_replace("/ /", "%20", $extension[0]);

   			// $filename = $filename[count($filename) - 1];
   			// var_dump($data->ou);
   			// var_dump($filename);exit;
   			// var_dump($extension);exit;

   			if (mb_strpos($extension, "jpg") === FALSE && mb_strpos($extension, "jpeg") === FALSE && mb_strpos($extension, "bmp") === FALSE && mb_strpos($extension, "png") === FALSE && mb_strpos($extension, "GIF") === FALSE && mb_strpos($extension, "TIFF") === FALSE && mb_strpos($extension, "BPG") === FALSE && mb_strpos($extension, "CGM") === FALSE && mb_strpos($extension, "SVG") === FALSE && mb_strpos($extension, "BPG") === FALSE && mb_strpos($extension, "BAT") === FALSE && mb_strpos($extension, "PPM") === FALSE && mb_strpos($extension, "PGM") === FALSE && mb_strpos($extension, "PBM") === FALSE && mb_strpos($extension, "PNM") === FALSE && mb_strpos($extension, "Exif") === FALSE) {

   				continue;
   			}	

   			$filename = explode($extension, trim($data->ou));
   			$filename = explode("/", $filename[0] );
   			$filename = $filename[count($filename) - 1];
		    $results[$n]['url'] = $data->ou;
		    $results[$n]['filetype'] = $data->ity;
		    $results[$n]['filename'] = $filename;
		    $results[$n]['width'] = $data->ow;
		    $results[$n]['height'] = $data->oh;
		    $results[$n]['title'] = $data->pt;
		    $results[$n]['dataUrl'] = $data->ru;

		}			
		return $results;

	}
	
}

function is_url_exist($url){
	    $ch = curl_init($url);    
	    curl_setopt($ch, CURLOPT_NOBODY, true);
	    curl_exec($ch);
	    $code = curl_getinfo($ch, CURLINFO_HTTP_CODE);

	    if($code == 200){
	       $status = true;
	    }else{
	      $status = false;
	    }
	    curl_close($ch);
	   return $status;
}