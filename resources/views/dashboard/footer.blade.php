<!-- Footer Start -->
<footer class="footer">
&copy; {{ date('Y') }} Allright reserved to e-vuze  Team.

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
<script src="{{asset('dashboard/assets/timepicker/bootstrap-datepicker.js')}}"></script>
<!-- sweet alerts -->
<script src="{{ asset('dashboard/assets/sweet-alert/sweet-alert.min.js')}}"></script>
<script src="{{ asset('dashboard/assets/sweet-alert/sweet-alert.init.js')}}"></script>

<script src="{{ asset('dashboard/js/jquery.app.js')}}"></script>
<!-- Chat -->
<script src="{{ asset('dashboard/js/jquery.chat.js')}}"></script>
<!-- Dashboard -->
<script src="{{ asset('dashboard/js/jquery.dashboard.js')}}"></script>

<script type="text/javascript">
    jQuery(document).ready(function($) {
         jQuery('#datepicker').datepicker();
         jQuery('#datepicker2').datepicker();
    });
</script>
@stack('scripts')
</body>
</html>