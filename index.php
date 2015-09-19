<?php include("header.php"); ?>

<?php 
include("controls/function.php"); 
$idd = $_GET['id'];
if ($idd == '') {$idd = '28563201';}
$songsobj = getSongsById($idd,"Obj");
if ($songsobj == ''){echo '<p align="center">The mp3 donot exist</p>';}
else {echo '<p align="center"><a href="' . getJsonUrlById($idd,"Songs") . '">JsonUrl</a></p>';}
$mp3URL = str_ireplace('http://m', 'http://p', $songsobj->mp3Url);
?>



<div class="container">

	<div class="row">
		<div class="col s12 m6">
			<div class="card">
				<div class="card-image">
					<img class="responsive-img" src="<?php echo $songsobj->album->blurPicUrl; ?>">
				</div>
				<div class="card-content">
					<h4 class="black-text"><?php echo $songsobj->name; ?></h4>
					<h6>
						<a href="<?php echo 'artist.php?id=' . $songsobj->artists[0]->id?>" class="deep-orange-text">
							<?php echo 'Artist: ' . $songsobj->artists[0]->name; ?>
						</a>
						<?php echo 'Album: ' . $songsobj->album->name; ?>
					</h6>
				</div>
				<div class="card-action">
					<p><audio src="<?php echo $mp3URL; ?>" controls="controls"></audio></p>
					<h6><a href="<?php echo $mp3URL; ?>" class="deep-orange-text">Download</a></h6>
				</div>
			</div>
		</div>

		
		<div class="col s12 m6">
			<ul class="collapsible" data-collapsible="accordion">
				<li>
					<div class="collapsible-header">歌词</div>
					<div class="collapsible-body"><p><?php echo  str_ireplace("[", "<br>[", getMusicLrcById($idd,"Obj")->lrc->lyric); ?></p></div>
				</li>
				<li>
					<div class="collapsible-header">中文歌词（如果有翻译）</div>
					<div class="collapsible-body"><p><?php echo str_ireplace("[", "<br>[", getMusicLrcById($idd,"Obj")->tlyric->lyric); ?></p></div>
				</li>
			</ul>
		</div>
	</div>
  
  <div>
  <h3>专辑内包含歌曲</h3>
	<?php
		$ii = 0;
		$albumObj = getAlbumById($songsobj->album->id,"Obj");
		while ($albumObj->album->songs[$ii] != '')
		{
			echo $ii+1 . '  ';
			echo '<a href="http://music.touko.moe/?id=' . $albumObj->album->songs[$ii]->id . '">' . $albumObj->album->songs[$ii]->name . '</a>';
			echo '<br>';
			$ii++;
		}
	
	?>
  
  </div>
  
  


  
  
</div>



<div class="container" align="center">
  <div class="row">
    <p>&nbsp;</p>
    <form id="inputID" name="inputID" method="get">
        <h3 class="col m12 l4">Input ID</h3>
        <input class="col m12 l8" type="text" name="id" id="textfield" value="<?php echo $idd; ?>">
		<div class="col s12">
			<button class="btn-large waves-effect waves-light col s4 offset-s4" type="submit" name="action">
				Submit<i class="material-icons">send</i>
			</button>
		</div>
    </form>
  </div>
</div>


  <!--  Scripts-->
  
  

<?php include("footer.php"); ?>



