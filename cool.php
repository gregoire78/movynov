<?php
function allocineURL($route,$arTokens){
    $arTokens['partner'] = 'V2luZG93czg';
    $arTokens['format'] = 'json';
    $sed = date('Ymd');
     
    $bDone = ksort($arTokens);
     
    foreach($arTokens as $key => $value){
        $arTokens[$key] = $key.'='.urlencode($value);
    }
    $sig = urlencode(base64_encode(sha1('e2b7fd293906435aa5dac4be670e7982'.implode('&',$arTokens)."&sed=$sed",true)));
     
    return 'http://api.allocine.fr/rest/v3/'.$route.'?'.implode('&',$arTokens)."&sed=$sed&sig=$sig";
}

function allocineGetByCode($code,$type='movie',$profile='small'){
        $url = allocineURL($type,array('code' => $code,'profile' => $profile));
            $ch = curl_init($url);
            curl_setopt($ch,CURLOPT_URL,$url);
            curl_setopt($ch,CURLOPT_RETURNTRANSFER,true);
            $agents = array(
                'Mozilla/5.0 (Macintosh; Intel Mac OS X 10.7; rv:7.0.1) Gecko/20100101 Firefox/7.0.1',
                'Mozilla/5.0 (X11; U; Linux i686; en-US; rv:1.9.1.9) Gecko/20100508 SeaMonkey/2.0.4',
                'Mozilla/5.0 (Windows; U; MSIE 7.0; Windows NT 6.0; en-US)',
                'Mozilla/5.0 (Macintosh; U; Intel Mac OS X 10_6_7; da-dk) AppleWebKit/533.21.1 (KHTML, like Gecko) Version/5.0.5 Safari/533.21.1'
            );
            curl_setopt($ch,CURLOPT_USERAGENT,$agents[array_rand($agents)]);
            $data_json = curl_exec($ch);
            $data = json_decode($data_json);
            curl_close($ch);
            return $data;
}
$arTokens = array();
$arTokens["q"] = "time Out";
$arTokens['filter'] = 'movie';
$arTokens['profile'] = 'small';
 
echo allocineURL('search',$arTokens);
 
 
$arTokens = array();
$arTokens["code"] = "304";
$arTokens['profile'] = 'small';
echo allocineURL('tvseries',$arTokens);
