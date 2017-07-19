<!DOCTYPE html>
<html lang="{{ config('app.locale') }}">
<head>
<meta charset="utf-8">
<meta name="viewport" content="width=device-width, initial-scale=1.0">
<meta name="description" content="Tiba Loan Applcation System">
<meta name="author" content="evuze devs">

<link rel="shortcut icon" href="{{ asset('dashboard/img/favicon.ico')}}" type="image/x-icon">
<link rel="icon" href="{{ asset('dashboard/img/favicon.ico')}}" type="image/x-icon">

<title>Pharmacy dashboard</title>

<!-- Bootstrap core CSS -->
<link href="{{ asset('dashboard/css/bootstrap.min.css')}}" rel="stylesheet">
<link href="{{ asset('dashboard/css/bootstrap-reset.css')}}" rel="stylesheet">
<link href="https://netdna.bootstrapcdn.com/bootstrap/3.0.0/css/bootstrap-glyphicons.css" rel="stylesheet">

<!--Animation css-->
<link href="{{ asset('dashboard/css/animate.css')}}" rel="stylesheet">

<!--Icon-fonts css-->
<script src="https://use.fontawesome.com/c63e40f3de.js"></script>
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/ionicons/2.0.1/css/ionicons.min.css">

@stack('styles')
<!-- Custom styles for this template -->
<link href="{{ asset('dashboard/css/style.css')}}" rel="stylesheet">
<link href="{{ asset('dashboard/css/helper.css')}}" rel="stylesheet">
<link href="{{ asset('dashboard/assets/timepicker/bootstrap-datepicker.min.css')}}" rel="stylesheet" />
<!-- HTML5 shim and Respond.js IE8 support of HTML5 tooltipss and media queries -->
<!--[if lt IE 9]>
<script type="text/javascript" src="https://cdnjs.cloudflare.com/ajax/libs/html5shiv/3.7.3/html5shiv.js"></script>
<script type="text/javascript" src="https://cdnjs.cloudflare.com/ajax/libs/respond.js/1.4.2/respond.min.js"></script>
<![endif]-->

</head>

<body>
<!--Main Content Start -->
<section class="content">
<!-- Header -->
<header class="top-head container-fluid">
<!-- Left navbar -->
<nav class=" navbar-default" role="navigation">
<ul class="nav navbar-nav hidden-xs">
</ul>
<!-- Right navbar -->
<ul class="nav navbar-nav navbar-right top-menu top-right-menu">  
<!-- user login dropdown start-->
<li class="dropdown text-center">
<a data-toggle="dropdown" class="dropdown-toggle" href="#">
<img alt="" src="{{ asset('dashboard/img/User_Avatar.png')}}" class="img-circle profile-img thumb-sm">
<span class="username">## </span> <span class="caret"></span>
</a>
<ul class="dropdown-menu pro-menu fadeInUp animated" tabindex="5003" style="overflow: hidden; outline: none;">
<li><a href="{{ Auth::logout() }}"><i class="fa fa-sign-out"></i> Log Out</a></li>
</ul>
</li>
<!-- user login dropdown end -->       
</ul>
<!-- End right navbar -->
</nav>

</header>
<!-- Header Ends -->