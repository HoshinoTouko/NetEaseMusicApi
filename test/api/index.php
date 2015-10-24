<?php
require("function.php");

header('content-type:text/html;charset="utf-8"');
error_reporting(0);

$idd = $_GET['id'];
if ($idd == '') {$idd = '28563201';}

$resultAll = array(getJsonSongs("28563201"), getJsonSongs("186001"), getJsonSongs("857619"));


echo urldecode(json_encode($resultAll, JSON_UNESCAPED_UNICODE));


function getJsonSongs($idd)
{
$songsobj = getSongsById($idd,"Obj");
if ($songsobj == ''){echo '<p align="center">The mp3 donot exist</p>';die;}

$result = array(
		"mp3URL" => urlencode(str_ireplace('http://m', 'http://p', $songsobj->mp3Url)),
		"img" => urlencode($songsobj->album->blurPicUrl),
		"Artist" => $songsobj->artists[0]->name,
		"Album" => $songsobj->album->name,
		//"LRC" => getMusicLrcById($idd,"Obj")->lrc->lyric,
		//"tLRC" => getMusicLrcById($idd,"Obj")->tlyric->lyric,
		"Name" => $songsobj->name
		
	);

return $result;

}

?>