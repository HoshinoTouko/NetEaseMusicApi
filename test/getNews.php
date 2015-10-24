<?php
header('content-type:text/html;charset="utf-8"');
error_reporting(0);

$news = array(
	array('mp3URL'=>'http://p2.music.126.net/L3AY8Azva4vmhAZfoL-o9A==/6067105162467887.mp3','img'=>'image/bag3.jpg','Artist'=>'雨宮天'),
	array('mp3URL'=>'http://p2.music.126.net/sgN1Pmz4adgRwQYgGWF-4g==/7880199837360436.mp3','img'=>'image/bag2.jpg','Artist'=>'雨宮天'),
	array('mp3URL'=>'http://p2.music.126.net/VJBfTk2V-gWOQG3tfhZH-Q==/5848302348378964.mp3','img'=>'image/bag3.jpg','Artist'=>'雨宮天'),
	array('mp3URL'=>'http://p2.music.126.net/L3AY8Azva4vmhAZfoL-o9A==/6067105162467887.mp3','img'=>'image/bag3.jpg','Artist'=>'雨宮天'),

);

echo json_encode($news);
