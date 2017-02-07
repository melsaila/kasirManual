<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="description" content="">
    <meta name="author" content="">

    <title>Welcome Taksi Rina-Rini</title>

    <!-- Bootstrap Core CSS -->
    <link href="<?php echo base_url('statics/css/bootstrap.min.css')?>" rel="stylesheet">

    <!-- Custom CSS -->
    <link href="<?php echo base_url('statics/css/stylish-portfolio.css')?>" rel="stylesheet">

    <!-- Custom Fonts -->
    <link href="<?php echo base_url('statics/css/font-awesome-4.1.0/css/font-awesome.css')?>" rel="stylesheet" type="text/css">
    <link href="<?php echo base_url('statics/css/google_roboto.css'); ?>" rel='stylesheet' type='text/css'>
</head>

<body>

    <!-- Header -->
    <header id="top" class="header">
        <div class="text-vertical-center">
            <img src="<?php echo base_url('statics/images/logo_rr.png'); ?>" alt="Rina-Rini"/>
            <br/><br/>
            <a href="<?php echo base_url('login'); ?>" class="btn btn-home btn-lg" title="Web Administrator"><span class="glyphicon glyphicon-th-large"></span> &nbsp Administrator</a>
            <a href="<?php echo base_url('taximaps/maps'); ?>" class="btn btn-home btn-lg" title="Monitoring Taksi"><span class="glyphicon glyphicon-map-marker"></span> &nbsp Monitoring</a>
        </div>
    </header>

    <!-- jQuery Version 1.11.0 -->
    <script src="<?php echo base_url('statics/js/jquery-1.11.0.js')?>"></script>

    <!-- Bootstrap Core JavaScript -->
    <script src="<?php echo base_url('statics/js/bootstrap.min.js')?>"></script>
    <script src="https://maps.googleapis.com/maps/api/js"></script>

    <!-- Custom Theme JavaScript -->
    <script>
    // Closes the sidebar menu
    $("#menu-close").click(function(e) {
        e.preventDefault();
        $("#sidebar-wrapper").toggleClass("active");
    });

    // Opens the sidebar menu
    $("#menu-toggle").click(function(e) {
        e.preventDefault();
        $("#sidebar-wrapper").toggleClass("active");
    });

    // Scrolls to the selected menu item on the page
    $(function() {
        $('a[href*=#]:not([href=#])').click(function() {
            if (location.pathname.replace(/^\//, '') == this.pathname.replace(/^\//, '') || location.hostname == this.hostname) {

                var target = $(this.hash);
                target = target.length ? target : $('[name=' + this.hash.slice(1) + ']');
                if (target.length) {
                    $('html,body').animate({
                        scrollTop: target.offset().top
                    }, 1000);
                    return false;
                }
            }
        });

    });

    function initialize() {
        var map_canvas = document.getElementById('contact');
        var myLatLong = new google.maps.LatLng(-6.918263, 107.583450);
        var map_options = {
          center: myLatLong,
          zoom: 15,
          mapTypeId: google.maps.MapTypeId.ROADMAP
        }
        var map = new google.maps.Map(map_canvas, map_options)
        var marker = new google.maps.Marker({
            position: myLatLong,
            map:map,
            title:'Taksi Rina Rini'
        })
      }
      google.maps.event.addDomListener(window, 'load', initialize);
    </script>

</body>

</html>
