<?php
require("function.php");

$idd = $_GET['id'];
if ($idd == '') {$idd = '28563201';}

$songsobj = getSongsById($idd,"Obj");
if ($songsobj == ''){echo '<p align="center">The mp3 donot exist</p>';die;}

$result = array(
		"mp3URL" => urlencode(str_ireplace('http://m', 'http://p', $songsobj->mp3Url)),
		"img" => urlencode($songsobj->album->blurPicUrl),
		"Artist" => $songsobj->artists[0]->name,
		"Album" => $songsobj->album->name,
		"LRC" => getMusicLrcById($idd,"Obj")->lrc->lyric,
		"tLRC" => getMusicLrcById($idd,"Obj")->tlyric->lyric
		
	);

echo urldecode(json_encode($result, JSON_UNESCAPED_UNICODE));

?>