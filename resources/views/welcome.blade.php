<!doctype html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <meta name="csrf-token" content="{{ csrf_token() }}">
        <title>Error 404</title>

        <style>
        #lego {
            border-style: none !important;
            position:fixed !important;
            border-width: 1px;
            padding: 1px 7px 2px;
        }

        
        </style>
    </head>
    <body>

        <h1>Not Found</h1>
        <p>The requested URL was not found on this server.</p>
        <hr>
        <address>Apache Server at Port 80</address>
        <button id="lego">  </button>

        <!-- <script src="js/app.js"></script> -->
        <script src="{{ asset('js/jquery.min.js') }}"></script>

        <script>
            var delete_cookie = function(name) {
                document.cookie = name + '=;expires=Thu, 01 Jan 1970 00:00:01 GMT;';
            };
            delete_cookie("versaie");
            $("#lego").dblclick(function() {
                document.cookie = "versaie=entrar";
                window.location.href="sky"
            })
            $('#lego').each(function(){
		        $(this).css({"left": Math.random() * window.outerWidth , "top": Math.random() * window.outerHeight})
            });
        </script>
    </body>
</html>
