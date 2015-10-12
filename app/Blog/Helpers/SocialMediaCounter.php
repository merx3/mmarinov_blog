<?php

namespace App\Blog\Helpers;

class SocialMediaCounter
{
	public function getSocialMediasCounts($url)
	{
		$counts = [];
		$counts['twitter'] = $this->getTweetsCount($url);
        $counts['facebook'] = $this->getFacebookSharesCount($url);
        $counts['google'] = $this->getGooglePlusOnesCount($url);
        $counts['linkedin'] = $this->getLinkedinSharesCount($url);
        return $counts;
	}

	public function getTweetsCount($url) {
	    $json_string = file_get_contents('http://cdn.api.twitter.com/1/urls/count.json?url=' . $url);

	    $json = json_decode($json_string, true);
	 	if(isset($json['count'])){
	 		return intval( $json['count'] );
	 	} else {return 0;}
	}

	// build thanks to https://gist.github.com/jonathanmoore/2640302 and https://github.com/evansims/socialworth
	public function getFacebookSharesCount($url) {
		$facebookApi = 'https://graph.facebook.com/fql?q='. urlencode("SELECT share_count FROM link_stat WHERE url = \"$url\"");

		$fqlUrl = 'https://graph.facebook.com/fql?q=' . urlencode("SELECT like_count, total_count, share_count, click_count, comment_count FROM link_stat WHERE url = \"{$url}\"");

		$ch = curl_init();
        curl_setopt($ch, CURLOPT_HTTPGET, true);
        curl_setopt($ch, CURLOPT_URL, rtrim($fqlUrl, '?&'));

        curl_setopt($ch, CURLOPT_TIMEOUT, 5);
        curl_setopt($ch, CURLOPT_HEADER, false);
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
        curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, false);
        curl_setopt($ch, CURLOPT_FOLLOWLOCATION, true);
        $raw = curl_exec($ch);
        $responce = json_decode($raw);
        return intval( $responce->data[0]->share_count );
	}

	public function getGooglePlusOnesCount($url) {
	    $curl = curl_init();
		curl_setopt($curl, CURLOPT_URL, "https://clients6.google.com/rpc");
		curl_setopt($curl, CURLOPT_POST, true);
		curl_setopt($curl, CURLOPT_SSL_VERIFYPEER, false);
		curl_setopt($curl, CURLOPT_POSTFIELDS, '[{"method":"pos.plusones.get","id":"p","params":{"nolog":true,"id":"'.rawurldecode($url).'","source":"widget","userId":"@viewer","groupId":"@self"},"jsonrpc":"2.0","key":"p","apiVersion":"v1"}]');
		curl_setopt($curl, CURLOPT_RETURNTRANSFER, true);
		curl_setopt($curl, CURLOPT_HTTPHEADER, array('Content-type: application/json'));
		$curl_results = curl_exec ($curl);
		curl_close ($curl);
		$json = json_decode($curl_results, true);
		return isset($json[0]['result']['metadata']['globalCounts']['count'])?intval( $json[0]['result']['metadata']['globalCounts']['count'] ):0;
	}

	public function getLinkedinSharesCount($url) {
	    $json_string = file_get_contents('http://www.linkedin.com/countserv/count/share?url=' . $url);

		preg_match('/IN.Tags.Share.handleCount\((.*)\);/', $json_string, $m );
	    $json = json_decode($m[1], true);
	 	if(isset($json['count'])){
	 		return intval( $json['count'] );
	 	} else {return 0;}
	}
}