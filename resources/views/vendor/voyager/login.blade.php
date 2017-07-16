<!DOCTYPE html>
<html lang="{{ config('app.locale') }}">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <meta name="description" content="">
        <meta name="author" content="evuze developers">
        <link rel="shortcut icon" href="img/favicon_1.ico">
        <title>e-vuze - {{ Voyager::setting("title") }}</title>
        <!-- Bootstrap core CSS -->
        <link href="{{ asset('dashboard/css/bootstrap.min.css')}}" rel="stylesheet">
        <link href="{{asset('dashboard/css/bootstrap-reset.css')}}" rel="stylesheet">
        <!--Animation css-->
        <link href="{{asset('dashborad/css/animate.css')}}" rel="stylesheet">
        <!--Icon-fonts css-->
        <link href="{{asset('dashboard/assets/font-awesome/css/font-awesome.css')}}" rel="stylesheet" />
        <link href="{{asset('dashboard/assets/ionicon/css/ionicons.min.css')}}" rel="stylesheet" />
        <!--Morris Chart CSS -->
        <link rel="stylesheet" href="{{asset('dashboard/assets/morris/morris.css')}}">
        <!-- Custom styles for this template -->
        <link href="{{asset('dashboard/css/style.css')}}" rel="stylesheet">
        <link href="{{asset('dashboard/css/helper.css')}}" rel="stylesheet">        

        <!-- HTML5 shim and Respond.js IE8 support of HTML5 tooltipss and media queries -->
        <!--[if lt IE 9]>
          <script src="{{asset('dashboard/js/html5shiv.js')}}"></script>
          <script src="{{asset('dashboard/js/respond.min.js')}}"></script>
        <![endif]-->
    </head>
    <body>
        <div class="wrapper-page animated fadeInDown">
            <div class="panel panel-color panel-primary">
                <div class="panel-heading"> 
                   <h3 class="text-center m-t-10"> Sign In to <strong>{{ Voyager::setting('admin_title', 'e-vuze pharmacy') }}</strong> </h3>
                </div> 
                <form  class="form-horizontal m-t-40" action="{{ route('voyager.login') }}" method="POST">
                 {{ csrf_field() }}
                    <div class="form-group ">
                        <div class="col-xs-12">
                            <input class="form-control" type="text" placeholder="E-mail" name="email" value="{{ old('email') }}" required>
                        </div>
                    </div>
                    <div class="form-group ">
                        <div class="col-xs-12">
                            <input class="form-control" type="password" placeholder="Password" name="password" required>
                        </div>
                    </div>

                    @if(!$errors->isEmpty())
                    <div class="alert alert-black">
                    <ul class="list-unstyled">
                    @foreach($errors->all() as $err)
                    <li>{{ $err }}</li>
                    @endforeach                
                    </ul>
                    </div>            
                    @endif
                    <div class="form-group text-right">
                        <div class="col-xs-12">
                        <button type="submit" class="btn btn-block login-button">
                        <span class="signingin hidden"><span class="glyphicon glyphicon-refresh"></span> Loggin in...</span>
                        <span class="signin">Login</span>
                        </button>
                        </div>
                    </div>
                </form>
            </div>
        </div>
        <script>
            var btn = document.querySelector('button[type="submit"]');
            var form = document.forms[0];
            btn.addEventListener('click', function(ev){
                if (form.checkValidity()) {
                    btn.querySelector('.signingin').className = 'signingin';
                    btn.querySelector('.signin').className = 'signin hidden';
                } else {
                    ev.preventDefault();
                }
            });
        </script>
        <!-- js placed at the end of the document so the pages load faster -->
        <script src="{{asset('dashboard/js/jquery.js')}}"></script>
        <script src="{{asset('dashboard/js/bootstrap.min.js')}}"></script>
        <script src="{{asset('dashboard/js/pace.min.js')}}"></script>
        <script src="{{asset('dashboard/js/wow.min.js')}}"></script>
        <script src="{{asset('dashboard/js/jquery.nicescroll.js')}}" type="text/javascript"></script>
        <!--common script for all pages-->
        <script src="{{asset('dashboard/js/jquery.app.js')}}"></script>
    </body>
</html>
