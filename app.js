function statusChangeCallback(response) {
  console.log('statusChangeCallback');
  console.log(response);
  if (response.status === 'connected') {
    $("#divLoading").removeClass("show");
    document.getElementById('login').style = 'display:none';
    document.getElementById('play').style = 'display:true';
    $("#play").click(function () {
      document.getElementById("canvas").style.backgroundColor = '#4797F3';
      testAPI();
    });
  } else {
   console.log('please login');
   $("#divLoading").removeClass("show");
   document.getElementById('play').style = 'display:none';
  }
}
function checkLoginState() {

  FB.getLoginStatus(function(response) {
    statusChangeCallback(response);
  });
}


window.fbAsyncInit = function() {
FB.init({
  appId      : '1702339276748394',
  cookie     : true,  // enable cookies to allow the server to access 
                      // the session
  xfbml      : true,  // parse social plugins on this page
  version    : 'v2.8' // use graph api version 2.8
});

FB.getLoginStatus(function(response) {
  statusChangeCallback(response);
});
};

(function(d, s, id) {
  var js, fjs = d.getElementsByTagName(s)[0];
  if (d.getElementById(id)) return;
  js = d.createElement(s); js.id = id;
  js.src = "//connect.facebook.net/en_US/sdk.js";
  fjs.parentNode.insertBefore(js, fjs);
}(document, 'script', 'facebook-jssdk'));

function again(){
  window.location.href="index.php";
}
function testAPI() {
  load();
  
	FB.api('/me', 'GET', {
    fields: 'first_name,last_name,name,id,picture.width(320),gender'
  }, 
  function (response) {
    document.getElementById('login').style = 'display:none';
    var name_f = [
     'Daisy',
     'Rose',
     'Violet',
     'Jasmine',
     'Fern',
     'Helen',
     'Clara',
     'Clara',
     'Grace',
     'Ella',
     'Eliza'

    ];

    var name_m = [
      'Dion',
      'Cosmo',
      'Cruz',
      'Gaston',
      'Gunnar',
      'Luciano',
      'Nicasino',
      'Niko',
      'Odin',
      'Paolo',
      'Pascal',
      'Jame',
      'Denial',
      'Tadeo'
    ]
    if(response.gender == 'male'){
      var name = name_m;
    }else{
      var name = name_f;
    }
    var randomNumber = Math.floor(Math.random()*name.length);
    console.log(response);
    $('#profile').attr('src', response.picture.data.url);
    var name = name[randomNumber];
    document.getElementById('name').innerHTML = name;
      var d = new Date();
      var time = d.getTime();
      $(function () {
        var captureArea = $("#canvas");
        html2canvas(captureArea, {
          onrendered: function (canvas) {
            // $("#canvas").html("").append(canvas);
            var img = canvas.toDataURL("image/jpg", 1.0);
            $.ajax({
              type: 'POST',
              url: "index.php",
              data: {
                "img": img,
                "id": response.id,
                "time": time
              },
              success: function (data) {
                setTimeout(function(){
                  window.location.href="index.php?play_id="+response.id+time+"&name="+name;
              }, 2000);
                 
              }
            });
          },
          useCORS: true
        });
      });
  });
}

(function(d, s, id) {
var js, fjs = d.getElementsByTagName(s)[0];
if (d.getElementById(id)) return;
js = d.createElement(s); js.id = id;
js.src = "//connect.facebook.net/th_TH/sdk.js#xfbml=1&version=v2.10&appId=1702339276748394";
fjs.parentNode.insertBefore(js, fjs);
}(document, 'script', 'facebook-jssdk'));

$("#share").click(function () {
  FB.ui({
    method: 'feed',
    link: document.URL,
    caption: '',
  }, function(response){
    window.location.href = "index.php";
  });
});