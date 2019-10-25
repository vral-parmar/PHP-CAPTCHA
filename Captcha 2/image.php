<?php
if(isset($_POST['generateCaptcha']))
{
  header('content-type:image/jpeg'); //to define react page as image
  $font_size=20;
  $width  =120;
  $height= 50;
  $total_line = 30;

  $image = imagecreate($width,$height); //define image with height and width

  imagecolorallocate($image,215,215,215); // draw image with specific backgroud

  $font_Color = imagecolorallocate($image,0,0,0); //assign a color to the font
  $font_line_Color = imagecolorallocate($image,46,46,96); //assign color to the line over image

  for ($i=0; $i <= $total_line ; $i++) {
    $x1 = rand(0,80);// generate random line for draw over image
    $x2 = rand(0,250);
    $y1 = rand(0,100);
    $y2 = rand(0,100);
    imageline($image,$x1,$y1,$x2,$y2,$font_line_Color); //draw lines over image
  }
  $ans= generateRandomString(); //function for generate random string
  imagettftext($image,$font_size,rand(0,8),10,36,$font_Color,'font.ttf',$ans); //draw captcha on image
  //imagejpeg($image); //represent the image

  $data=array(
    'captcha_code' => $ans,
    'captcha_image' => base64_encode(imagejpeg($image))
  );

  echo json_encode($data);
}

/*Function for random string generate in captcha */
function generateRandomString($length = 6) {
  $characters = '0123456789abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ';
  $charactersLength = strlen($characters);
  $randomString = '';
  for ($i = 0; $i < $length; $i++) {
      $randomString .= $characters[mt_rand(0, $charactersLength - 1)];
  }
  return $randomString;
}
?>
