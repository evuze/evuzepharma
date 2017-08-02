<!DOCTYPE html>
<html lang="{{ config('app.locale') }}">
<head>
<meta charset="utf-8">
<meta name="viewport" content="width=device-width, initial-scale=1.0">
<meta name="description" content="{{ Voyager::setting("title") }}">
<meta name="author" content="e-vuze dev team">
<link rel="shortcut icon" href="img/favicon_1.ico">
<title>e-vuze- {{ Voyager::setting("title") }}</title>

<!-- Bootstrap core CSS -->
<link href="{{asset('dashboard/css/bootstrap.min.css')}}" rel="stylesheet">
<link href="{{asset('dashboard/css/bootstrap-reset.css')}}" rel="stylesheet">

<!--Animation css-->
<link href="{{asset('dashboard/css/animate.css')}}" rel="stylesheet">

<!--Icon-fonts css-->
<link href="{{asset('dashboard/assets/font-awesome/css/font-awesome.css')}}" rel="stylesheet" />
<link href="{{asset('dashboard/assets/ionicon/css/ionicons.min.css')}}" rel="stylesheet" />
<link href="https://cdnjs.cloudflare.com/ajax/libs/ionicons/2.0.1/css/ionicons.min.css" rel="stylesheet" />
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css" />

<!--Morris Chart CSS -->
<link rel="stylesheet" href="{{asset('dashboard/assets/morris/morris.css')}}">

<!-- sweet alerts -->
<link href="{{asset('dashboard/assets/sweet-alert/sweet-alert.min.css')}}" rel="stylesheet">

<!-- Custom styles for this template -->
<link href="{{asset('dashboard/css/style.css')}}" rel="stylesheet">
<link href="{{asset('dashboard/css/helper.css')}}" rel="stylesheet">



<!-- HTML5 shim and Respond.js IE8 support of HTML5 tooltipss and media queries -->
<!--[if lt IE 9]>
<script src="js/html5shiv.js"></script>
<script src="js/respond.min.js"></script>
<![endif]-->

<script>
//ga scripts to track user activity
</script>
</head>
<body>

<!-- Aside Start-->
<aside class="left-panel  collapsed">

<!-- brand -->
<div class="logo">
<a href="index.html" class="logo-expanded">
<i class="ion-social-buffer"></i>
<span class="nav-label">{{ Voyager::setting("title") }}</span>
</a>
</div>
<!-- / brand -->
</aside>
<!-- Aside Ends-->
<!--Main Content Start -->
<section class="content">
<!-- Header -->
<header class="top-head container-fluid">
<!-- Search -->

<!-- Left navbar -->
<nav class=" navbar-default" role="navigation">
<ul class="nav navbar-nav hidden-xs">
    <li><a href="{{ route('pharmacy.dashboard') }}">{{ ucfirst($user->pharmacy->name) }}</a> </li>
 @if(count(Request::segments()) == 1)
    <li><a href="{{route('voyager.dashboard', [], false)}}"> Dashboard </a></li>
@else
    <li class="active">
        <a href="{{ route('voyager.dashboard')}}"><i class="voyager-boat"></i> Dashboard ></a>
    </li>
@endif
<?php $breadcrumb_url = url(''); ?>
@for($i = 1; $i <= count(Request::segments()); $i++)
    <?php $breadcrumb_url .= '/' . Request::segment($i); ?>
    @if(Request::segment($i) != ltrim(route('voyager.dashboard', [], false), '/') && !is_numeric(Request::segment($i)))

        @if($i < count(Request::segments()) & $i > 0)
            <li class="active"><a
                        href="{{ $breadcrumb_url }}">{{ ucwords(str_replace('-', ' ', str_replace('_', ' ', Request::segment($i)))) }} ></a>
            </li>
        @else
            <li><a>{{ ucwords(str_replace('-', ' ', str_replace('_', ' ', Request::segment($i)))) }}</a></li>
        @endif

    @endif
@endfor
</ul>

<!-- Right navbar -->
<ul class="nav navbar-nav navbar-right top-menu top-right-menu">  
<!-- Notification -->
<li class="dropdown">
<a data-toggle="dropdown" class="dropdown-toggle" href="index.html#">
<i class="fa fa-bell-o"></i>
<span class="badge badge-sm up bg-pink count">3</span>
</a>
<ul class="dropdown-menu extended fadeInUp animated nicescroll" tabindex="5002">
<li class="noti-header">
<p>Notifications</p>
</li>
<li>
<a href="index.html#">
<span class="pull-left"><i class="fa fa-user-plus fa-2x text-info"></i></span>
<span>New user registered<br><small class="text-muted">5 minutes ago</small></span>
</a>
</li>
<li>
<a href="index.html#">
<span class="pull-left"><i class="fa fa-diamond fa-2x text-primary"></i></span>
<span>Use animate.css<br><small class="text-muted">5 minutes ago</small></span>
</a>
</li>
<li>
<a href="index.html#">
<span class="pull-left"><i class="fa fa-bell-o fa-2x text-danger"></i></span>
<span>Send project demo files to client<br><small class="text-muted">1 hour ago</small></span>
</a>
</li>

<li>
<p><a href="index.html#" class="text-right">See all notifications</a></p>
</li>
</ul>
</li>
<!-- /Notification -->

<!-- user login dropdown start-->
<li class="dropdown text-center">
<a data-toggle="dropdown" class="dropdown-toggle" href="">
<img alt="" src="{{ Voyager::image($user->avatar) }}" class="img-circle profile-img thumb-sm">
<span class="username">{{ $user->email }} </span> <span class="caret"></span>
</a>
<ul class="dropdown-menu pro-menu fadeInUp animated" tabindex="5003" style="overflow: hidden; outline: none;">
<li><a href=""><i class="fa fa-user"></i> Profile</a></li>
<li>
<form action="{{ route('pharmacy.logout') }}" method="POST">
        {{ csrf_field() }}
        <button type="submit" class="btn btn-success btn-block">
        <i class="fa fa-sign-out"></i>
            Logout
        </button>
    </form>
</li>
</ul>
</li>
<!-- user login dropdown end -->       
</ul>
<!-- End right navbar -->
</nav>
<!-- end of navbar -->
</header>
<!-- Header Ends -->


<!-- Page Content Start -->
<!-- ================== -->

<div class="wraper container-fluid">
@yield('content')
</div>
<!-- Page Content Ends -->
<!-- ================== -->

<!-- Footer Start -->
<footer class="footer">
{{ date('Y') }} © evuze pharmacy.
</footer>
<!-- Footer Ends -->
</section>
<!-- Main Content Ends -->
<!-- js placed at the end of the document so the pages load faster -->
<script src="{{asset('dashboard/js/jquery.js')}}"></script>
<script src="{{asset('dashboard/js/bootstrap.min.js')}}"></script>
<script src="{{asset('dashboard/js/modernizr.min.js')}}"></script>
<script src="{{asset('dashboard/js/pace.min.js')}}"></script>
<script src="{{asset('dashboard/js/wow.min.js')}}"></script>
<script src="{{asset('dashboard/js/jquery.scrollTo.min.js')}}"></script>
<script src="{{asset('dashboard/js/jquery.nicescroll.js')}}" type="text/javascript"></script>
<script src="{{asset('dashboard/assets/chat/moment-2.2.1.js')}}"></script>

<!-- Counter-up -->
<script src="{{asset('dashboard/js/waypoints.min.js')}}" type="text/javascript"></script>
<script src="{{asset('dashboard/js/jquery.counterup.min.js')}}" type="text/javascript"></script>

<!-- EASY PIE CHART JS -->
<script src="{{asset('dashboard/assets/easypie-chart/easypiechart.min.js')}}"></script>
<script src="{{asset('dashboard/assets/easypie-chart/jquery.easypiechart.min.js')}}"></script>
<script src="{{asset('dashboard/assets/easypie-chart/example.js')}}"></script>


<!--C3 Chart-->
<script src="{{asset('dashboard/assets/c3-chart/d3.v3.min.js')}}"></script>
<script src="{{asset('dashboard/assets/c3-chart/c3.js')}}"></script>

<!--Morris Chart-->
<script src="{{asset('dashboard/assets/morris/morris.min.js')}}"></script>
<script src="{{asset('dashboard/assets/morris/raphael.min.js')}}"></script>

<!-- sparkline --> 
<script src="{{asset('dashboard/assets/sparkline-chart/jquery.sparkline.min.js')}}" type="text/javascript"></script>
<script src="assets/sparkline-chart/chart-sparkline.js" type="text/javascript"></script> 

<!-- sweet alerts -->
<script src="{{asset('dashboard/assets/sweet-alert/sweet-alert.min.js')}}"></script>
<script src="{{asset('dashboard/assets/sweet-alert/sweet-alert.init.js')}}"></script>

<script src="{{asset('dashboard/js/jquery.app.js')}}"></script>
<!-- Chat -->
<script src="{{asset('dashboard/js/jquery.chat.js')}}"></script>
<!-- Dashboard -->
<script src="{{asset('dashboard/js/jquery.dashboard.js')}}"></script>

<!-- Todo -->
<script src="{{asset('dashboard/js/jquery.todo.js')}}"></script>

</body>
</html>
