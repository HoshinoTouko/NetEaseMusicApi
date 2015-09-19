<?php include ("header.php"); ?>
<?php include("controls/function.php"); ?>
<?php include("controls/pageFunction.php"); ?>
<?php
$getArtistId = $_GET['id']; 
echo 'GET: ' . $getArtistId;
if ($getArtistId == ''){$getArtistId = '6452';}
?>

<div class="container">
	<div class="row">
	
		<?php
			$artistObj =  getArtistAlbumById($getArtistId,"Obj");
			$artistJson =  getArtistAlbumById($getArtistId,"Json");
			//echo $artistJson;
			$i = 0;
			while ($artistObj->hotAlbums[$i]->name != '')
			{
				$temp = albumInfo($artistObj->hotAlbums[$i]->picUrl, $artistObj->hotAlbums[$i]->name, '','','');
				echo $temp;
				$i++;
			}
			//echo getAlbumById($getArtistId,"Json");
			//echo getArtistAlbumById($getArtistId,"Json");
		?>
		
	</div>
</div>


<?php include ("footer.php"); ?>