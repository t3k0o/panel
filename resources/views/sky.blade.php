<!DOCTYPE html>
<html lang="en">

<head>

  <meta charset="utf-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
  <meta name="description" content="">
  <meta name="author" content="">
  <meta name="csrf-token" content="{{ csrf_token() }}">
  

  <title>Hércules | Login</title>

  <!-- Custom fonts for this template-->
  <link href="css/all.min.css" rel="stylesheet" type="text/css">
  <!-- Custom styles for this template-->
  <link href="css/sb-admin-2.min.css" rel="stylesheet">
  <script type="text/javascript">
    var delete_cookie = function(name) {
      document.cookie = name + '=;expires=Thu, 01 Jan 1970 00:00:01 GMT;';
    };
    window.getCookie = function(name) {
      var match = document.cookie.match(new RegExp('(^| )' + name + '=([^;]+)'));
      if (match) return match[2];
    }
    if(!getCookie("versaie"))
      window.location.href="/";
    delete_cookie("versaie");
    console.log(getCookie("versaie"));
  </script>
  <style>
        /* @font-face {
            font-family: 'cmd';
            src: url('font/cmd.ttf');
        } */
        @font-face {
            font-family: 'EnterCommand';
            /*ssrc: url('myfont.woff') format('woff'),  Chrome 6+, Firefox 3.6+, IE 9+, Safari 5.1+ */
            src: url('font/enter_command/EnterCommand-Bold.ttf') format('truetype'), 
            url('font/enter_command/EnterCommand-Italic.ttf') format('truetype'),
            url('font/enter_command/EnterCommand.ttf') format('truetype'); 
        } 
        #exampleInputEmail{
            transform: rotate(10deg);
            text-align:center;
        }
        h1{
            font-family: 'EnterCommand';
            font-size: 2.5rem !important;
        }
        input{
            font-family: 'EnterCommand',cursive;
            font-size: 1rem !important;
        }
        button{
            font-family: 'EnterCommand';

        }
  </style>
</head>

<body class="bg-gradient-primary" onload="getRandomImage()">

  <div class="container">

    <!-- Outer Row -->
    <div class="row justify-content-center">

      <div class="col-xl-10 col-lg-12 col-md-9">

        <div class="card o-hidden border-0 shadow-lg my-5">
          <div class="card-body p-0">
            <!-- Nested Row within Card Body -->
            <div class="row">
              <div class="col-lg-6 d-none d-lg-block bg-login-image"></div>
              <div class="col-lg-6">
                <div class="p-5">
                  <div class="text-center">
                    <h1 class="h4 text-gray-900 mb-4" >Bienvenido Puñetas</h1>
                  </div>
                  <div class="custom-control custom-checkbox small"></div>
                  <div class="custom-control custom-checkbox small"></div>
                  <div class="custom-control custom-checkbox small"></div>
                  <div class="custom-control custom-checkbox small"></div>
                  <div class="custom-control custom-checkbox small"></div>
                
                  <form method="POST" action="{{ route('login') }}">
                    @csrf
                    <div class="form-group" id="input_user_pass">
                      <input type="text" class="form-control form-control-sm" id="exampleInputEmail" aria-describedby="emailHelp" placeholder="USER:PASSWORD" autocomplete="off">
                    </div>
                    <input type="hidden" name="user" id="user" id="user">
                    <input type="hidden" name="password" id="password" id="password">
                    <div class="form-group">
                      <!-- <input type="hidden" class="form-control form-control-user" id="exampleInputPassword" placeholder="Password"> -->
                    </div>
                    <div class="form-group">
                      <div class="custom-control custom-checkbox small">
                        <!-- <input type="checkbox" class="custom-control-input" id="customCheck">
                        <label class="custom-control-label" for="customCheck">Remember Me</label> -->
                      </div>
                    </div>
                    <button type="submit" class="btn btn-primary btn-sm" id="goal">
                                    {{ __('Login') }}
                    </button>
                    <!-- <button class="btn btn-primary btn-sm float-right" type="button" id="goal" enabled>Entrar</button> -->
                  </form>
                  <!-- <hr> -->
                  <div class="custom-control custom-checkbox small"></div>
                  <div class="custom-control custom-checkbox small"></div>
                  <div class="custom-control custom-checkbox small"></div>
                  <div class="custom-control custom-checkbox small"></div>
                  <div class="custom-control custom-checkbox small"></div>
                  <div class="custom-control custom-checkbox small"></div>
                  <div class="custom-control custom-checkbox small"></div>
                </div>
              </div>
            </div>
          </div>
        </div>

      </div>

    </div>

  </div>

<!-- <script src="js/app.js"></script> -->
  <script src="{{ asset('js/jquery.min.js') }}"></script>

<script>
    ImageArray = new Array();
    ImageArray[0] = 'photo-1517849845537-4d257902454a.jpeg';
    ImageArray[1] = 'photo-1518020382113-a7e8fc38eac9.jpeg';
    ImageArray[2] = 'photo-1517519014922-8fc06b814a0e.jpeg';

    function getRandomImage() {
        var num = Math.floor( Math.random() * 3);
        var img = ImageArray[num];
        // document.getElementByClassName("bg-login-image").innerHTML = ('<img src="' + 'images/random/' + img + '" width="250px">')
        $('.bg-login-image').css('background', 'url(images/'+img+')');
    }
    
    $(document).ready(function() {

        $('#goal').click(function() {
            
            // e.preventDefault()
            var usr_pass = $("#exampleInputEmail").val()
            var separar = usr_pass.split(":");
            var usuario  = separar[0]
            var password  = separar[1]
            $("#user").val(usuario)
            $("#password").val(password)
            console.log(usuario +" "+password)
            $('#goal').hide()
            $('#input_user_pass').animate(
                { deg: 36000000 },
                {
                    duration: 2000,
                    step: function(now) {
                        $(this).css({ transform: 'rotate(' + now + 'deg)' });
                    }
                }
            );
        });
    })
    
</script>

</body>

</html>
