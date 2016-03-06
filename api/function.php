<?php

function getMusicUrl($dfsId)
{
    $result = array();
    exec('python api/encrypt_id.py '.$dfsId, $result);
    return $result[0];
}
function getSongsById($iddd, $type)
{
	$url = 'http://music.163.com/api/song/detail/?ids=[' . $iddd . ']';
	switch ($type)
	{
		case "Obj" :
			return json_decode(curl_get($url))->songs[0];
			break;
		case "Json" :
			return json_encode(json_decode(curl_get($url)->songs[0]));
			break;
		default :
			break;
	}
}

function getPlayListById($iddd, $type)
{
	$url = 'http://music.163.com/api/playlist/detail/?id=' . $iddd ;
	switch ($type)
	{
		case "Obj" :
			return json_decode(curl_get($url));
			break;
		case "Json" :
			return json_encode(json_decode(curl_get($url)));
			break;
		default :
			break;
	}
}


function getAlbumById($iddd, $type)
{	
	$url = 'http://music.163.com/api/album/' . $iddd . '?ext=true&id=' . $iddd . '&offset=0&total=true&limit=9999';
	switch ($type)
	{
		case "Obj" :
			return json_decode(curl_get($url));
			break;
		case "Json" :
			return curl_get($url);
			break;
		default :
			break;
	}
}

function getArtistAlbumById($iddd, $type)
{	
	$url = 'http://music.163.com/api/artist/albums/' . $iddd . '?ext=true&offset=0&total=true&limit=99999&id=' . $iddd;
	switch ($type)
	{
		case "Obj" :
			return json_decode(curl_get($url));
			break;
		case "Json" :
			return curl_get($url);
			break;
		default :
			break;
	}
}


function getJsonUrlById($tempId, $type)
{
	switch ($type)
	{
		case "Songs" :
			return 'http://music.163.com/api/song/detail/?ids=[' . $tempId . ']';
			break;
		case "Lrc" :
			return 'http://music.163.com/api/song/lyric?os=pc&id=' . $tempId . '&lv=-1&kv=-1&tv=-1';
			break;
		default :
			break;
	}
}

function getMusicLrcById($tempId, $type)
{
	$url = "http://music.163.com/api/song/lyric?os=pc&id=" . $tempId . "&lv=-1&kv=-1&tv=-1";
	switch ($type)
	{
		case "Json" :
			return curl_get($url);
			break;
		case "Obj" :
			return json_decode(curl_get($url));
			break;
		default :
			break;
	}
}


//------------------------------------
//以下为引用moonlib.com的部分

function curl_get($url)
{
    $refer = "http://music.163.com/";
    $header[] = "Cookie: " . "appver=1.5.0.75771;";
    $ch = curl_init();
    curl_setopt($ch, CURLOPT_URL, $url);
    curl_setopt($ch, CURLOPT_HTTPHEADER, $header);
    curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
    curl_setopt($ch, CURLOPT_BINARYTRANSFER, true);
    curl_setopt($ch, CURLOPT_REFERER, $refer);
    $output = curl_exec($ch);
    curl_close($ch);
    return $output;
}



function searchMusicByName($word, $offset, $limit, $type, $types)
{
    $url = "http://music.163.com/api/search/suggest/web/ ";
    $post_data = array(
        's' => $word,
        'offset' => $offset,
        'limit' => $limit,
        'type' => $type,
        'total' => 'true',
    );
    $referrer = "http://music.163.com";
    $URL_Info = parse_url($url);
    $values = array();
    $result = '';
    $request = '';
    foreach ($post_data as $key => $value) {
        $values[] = "$key=" . urlencode($value);
    }
    $data_string = implode("&", $values);
    if (!isset($URL_Info["port"])) {
        $URL_Info["port"] = 80;
    }
    $request .= "POST " . $URL_Info["path"] . " HTTP/1.1\n";
    $request .= "Host: " . $URL_Info["host"] . "\n";
    $request .= "Referer: $referrer\n";
    $request .= "Content-type: application/x-www-form-urlencoded\n";
    $request .= "Content-length: " . strlen($data_string) . "\n";
    $request .= "Connection: close\n";
    $request .= "Cookie: " . "appver=2.0.2;\n";
    $request .= "\n";
    $request .= $data_string . "\n";
    $fp = fsockopen($URL_Info["host"], $URL_Info["port"]);
    fputs($fp, $request);
    $i = 1;
    while (!feof($fp)) {
        if ($i >= 15) {
            $result .= fgets($fp);
        } else {
            fgets($fp);
            $i++;
        }
    }
    fclose($fp);
	switch ($types)
	{
		case "Json" :
			return $result;
			break;
		case "Obj" :
			return json_decode($result);
			break;
		default :
			break;
	}
}


?>