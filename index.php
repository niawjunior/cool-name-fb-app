<!DOCTYPE html>
<html>
<head>
<title>App</title>
<meta charset="UTF-8">
<meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
<meta property="og:title" content="<?php echo 'ชื่อสากลที่เหมาะกับคุณคือ '.$_GET['name'];?>" />
<meta property="og:type" content="article" />
<meta property="og:url" content="<?php echo 'http://' . $_SERVER['HTTP_HOST'] . $_SERVER['REQUEST_URI'];?>" />
<meta property="og:image" content="<?php echo 'http://' .$_SERVER['HTTP_HOST'].'/img/'.$_GET['play_id'].$time.'.jpg';?>" />
<meta property="og:description" content="<?php echo  'เล่นเกมส์ใหม่ๆได้ที่นี่ ->';?>" />
<meta property="og:image:width" content="300px" />
<meta property="og:image:height" content="300px" />
<meta property="fb:app_id" content="1702339276748394" />
<script src="jquery-1.12.4.js"></script>
<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0-beta/css/bootstrap.min.css" integrity="sha384-/Y6pD6FV/Vv2HJnA6t+vslU6fwYXjCFtcEpHbNJ0lyAFsXTsjBbfaDjzALeQsN6M" crossorigin="anonymous">
<script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.11.0/umd/popper.min.js" integrity="sha384-b/U6ypiBEHpOf/4+1nzFpr53nxSS+GLCkfwBdFNTxtclqqenISfwAzpKaMNFNmj4" crossorigin="anonymous"></script>
<script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0-beta/js/bootstrap.min.js" integrity="sha384-h0AbiXch4ZDo7tp9hKZ4TsHbi047NrKGLO3SEJAg45jXxnGIfYzk4Si90RDIqNm1" crossorigin="anonymous"></script>
<link href="https://fonts.googleapis.com/css?family=Kanit" rel="stylesheet">
<link rel="stylesheet" href="app.css">
<script src="html2canvas.min.js"></script>
</head>
<?php
if($_GET['play_id']){
  $head_text = 'ชื่อสากลที่เหมาะกับคุณคือ ';
  $images = $_GET['play_id'].'.jpg';
}else{
  $head_text = 'ชื่อสากลใดที่เหมาะกับคุณ! ';
  $images = 'unnamed.jpg';
}
?>

<body>
<div id="divLoading"></div>
  <div class="container">
    <div class="col-lg-12">
    <center>
      <h1 style="margin-top:2%"><?php echo $head_text;?></h1>
      <div class="col-md-6">
              <div style="margin-top:2%" id="canvas" class="container-fluid">
                    <img id="profile" class="img-fluid" style="margin-top:2%;max-width:100%;height: auto;" src="img/<?php echo $images;?>" alt="">  
                    <div class="col-md-3">
                      <h1 id="name" style=""></h1>    
                    </div>
              </div>
      </div>
 
  <br/>
  <?php if($_GET['play_id']){
    ?>
  <button style="cursor: pointer;" id="share" class="btn btn-primary btn-lg">SHARE <img width="20px" src="social.png"></button>
  <button style="cursor: pointer;" onclick="window.location.href='index.php'" class="btn btn-primary btn-lg">HOME <img width="20px" src="home-xxl.png"></button>
    <?php
  }else{
    ?>
    <div id="login" style="" class="fb-login-button" data-max-rows="1" data-size="large" data-button-type="continue_with" data-show-faces="false" data-auto-logout-link="false" data-use-continue-as="true" onlogin="checkLoginState();"></div>
    <br/>
    <button style="cursor: pointer;" id="play" class="btn btn-primary btn-lg">PLAY <img width="20px" src=""></button>
    <?php
  }
  ?>
      </center>
    </div>

  </div>
</div><div id="fb-root"></div>
<script src="app.js"></script>
</body>
</html>

<?php
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $time = $_POST['time'];
    $img = $_POST['img'];
    $id = $_POST['id'];
    $img = substr(explode(";",$img)[1], 7);
    $target=$id.$time.'.jpg';
    file_put_contents('img/'.$target, base64_decode($img)); 
}
?>
<script>
          function load() {
            $("#divLoading").addClass('show');
        }
</script>
