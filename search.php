<?php include ("header.php"); ?>
<?php include("api/function.php"); ?>
<?php 
$getWord = $_GET['word']; 
$getType = $_GET['type']; 
if ($getType == ''){$getType = '1';}
?>

<div class="container" align="center">
  <div class="row">
  
    <h4>NeteaseMusic Search Beta</h4>
    
	<form id="InputWord" name="InputWord" method="get">
	
		<div class="col s12 m8">
		  <nav>
			<div class="nav-wrapper">
				<div class="input-field">
				<input id="search" type="search" name="word" value="<?php echo $getWord; ?>" required>
				<label for="search"><i class="material-icons">search</i></label>
				<i class="material-icons">Input Words</i>
				</div>
			</div>
		  </nav>
		</div>
		
		
		<div class="col s12 m4">
		  <div class="input-field col s6">
			<select class="browser-default" name="types">
			<option value="1" selected="selected">单曲</option>
			<option value="10">专辑</option>
			<option value="100">歌手</option>
			<option value="1000">歌单</option>
			<option value="1002">用户</option>
			<option value="1004">MV</option>
			<option value="1006">歌词</option>
			<option value="1009">电台</option>
			</select>
		  </div>
		
		  <div class="col s6">
      <br>
			<button class="waves-effect waves-teal btn-flat" type="submit" name="action">Submit
				<i class="material-icons">send</i>
			</button>
		  </div>
		
		</div>
    </form>
  </div>
  
  <p><?php echo 'GET: ' . $getWord; ?></p>
  
<?php
	$searchObj = searchMusicByName($getWord,"0","10",$getType,"Obj");
?>
  
  <div>
  <h3>搜索结果</h3>
  <p><?php echo searchMusicByName($getWord,"0","10",$getType,"Json") . '0'; ?></p>
  
  <table>
        <thead>
          <tr>
              <th data-field="id">Number</th>
              <th data-field="name">Name</th>
              <th data-field="price">Artist</th>
          </tr>
        </thead>

        <tbody>

<?php
switch ($getType)
{
	case "1" :
	$ii = 0;
	while ($searchObj->result->songs[$ii] != '')
	{
     echo '<tr><td>' ;
		echo $ii+1 . '</td>';
		echo '<td><a href="http://music.touko.moe/index.php?id=' . $searchObj->result->songs[$ii]->id . '">' . $searchObj->result->songs[$ii]->name . '</a></td>';
		echo '<td>' . $searchObj->result->songs[$ii]->artists[0]->name . '</td>';
     echo ' </tr>';
		$ii++;
	}
	break;
	
	default :
	echo "制作未完成";
	break;
}
?>

        </tbody>
      </table>
  

  
  </div>
  
</div>




<?php include ("footer.php"); ?>