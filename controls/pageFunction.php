<?php 
function albumInfo($imgSrc, $title, $link, $linkText, $info)
{
$text = '<div class="card col s6 m3 offset-m1">
    <div class="card-image waves-effect waves-block waves-light">
      <img class="activator" src="' . $imgSrc . '">
    </div>
    <div class="card-content">
      <span class="card-title activator grey-text text-darken-4">' . $title . '<i class="material-icons right">more_vert</i></span>
      <p><a href="' . $link . '"></a>' . $linkText . '</p>
    </div>
    <div class="card-reveal">
      <span class="card-title grey-text text-darken-4">' . $title  . '<i class="material-icons right">close</i></span>
      <p>' . $info . '</p>
    </div>
  </div>';
return $text;
}
?>

 
 