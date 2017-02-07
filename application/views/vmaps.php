<!DOCTYPE html>
<head>
    <title>Rina-Rini Maps</title>
    <style type="text/css">

    body{
        font-family: Helvetica, Arial, sans-serif;
    }
#map_wrapper {
    min-height: 442px;
    height: 442px;
/*        min-height: 202px;
    height: 202px;*/
    }

    #map_canvas {
        width: 100%;
        height: 100%;
    }
    @-moz-keyframes pulsate {
        from {
            -moz-transform: scale(0.25);
            opacity: 1.0;
        }
        95% {
            -moz-transform: scale(1.3);
            opacity: 0;
        }
        to {
            -moz-transform: scale(0.3);
            opacity: 0;
        }
    }
    @-webkit-keyframes pulsate {
        from {
            -webkit-transform: scale(0.25);
            opacity: 1.0;
        }
        95% {
            -webkit-transform: scale(1.3);
            opacity: 0;
        }
        to {
            -webkit-transform: scale(0.3);
            opacity: 0;
        }
    }
    /* get the container that's just outside the marker image,
        which just happens to have our Marker title in it */
    #map_canvas div.gmnoprint[title^="Status: ISI"] {
        -moz-animation: pulsate 1.5s ease-in-out infinite;
        -webkit-animation: pulsate 1.5s ease-in-out infinite;
        border:1pt solid #fff;
        /* make a circle */
        -moz-border-radius:51px;
        -webkit-border-radius:51px;
        border-radius:51px;
        /* multiply the shadows, inside and outside the circle */
        -moz-box-shadow:inset 0 0 10px #E30909, inset 0 0 10px #E30909, inset 0 0 10px #E30909, 0 0 10px #E30909, 0 0 10px #E30909, 0 0 10px #E30909;
        -webkit-box-shadow:inset 0 0 10px #E30909, inset 0 0 10px #E30909, inset 0 0 10px #E30909, 0 0 10px #E30909, 0 0 10px #E30909, 0 0 10px #E30909;
        box-shadow:inset 0 0 10px #E30909, inset 0 0 10px #E30909, inset 0 0 10px #E30909, 0 0 10px #E30909, 0 0 10px #E30909, 0 0 10px #E30909;
        /* set the ring's new dimension and re-center it */
        height:51px!important;
        margin:-18px 0 0 -18px;
        width:51px!important;
    }
     #map_canvas div.gmnoprint[title^="Status: JEMPUT"] {
        -moz-animation: pulsate 1.5s ease-in-out infinite;
        -webkit-animation: pulsate 1.5s ease-in-out infinite;
        border:1pt solid #FCE956;
        /* make a circle */
        -moz-border-radius:51px;
        -webkit-border-radius:51px;
        border-radius:51px;
        /* multiply the shadows, inside and outside the circle */
        -moz-box-shadow:inset 0 0 10px #AD9900, inset 0 0 10px #AD9900, inset 0 0 10px #AD9900, 0 0 10px #AD9900, 0 0 10px #AD9900, 0 0 10px #AD9900;
        -webkit-box-shadow:inset 0 0 10px #AD9900, inset 0 0 10px #AD9900, inset 0 0 10px #AD9900, 0 0 10px #AD9900, 0 0 10px #AD9900, 0 0 10px #AD9900;
        box-shadow:inset 0 0 10px #AD9900, inset 0 0 10px #AD9900, inset 0 0 10px #AD9900, 0 0 10px #AD9900, 0 0 10px #AD9900, 0 0 10px #AD9900;
        /* set the ring's new dimension and re-center it */
        height:51px!important;
        margin:-18px 0 0 -18px;
        width:51px!important;
    }
     #map_canvas div.gmnoprint[title^="No.Taksi:"] {
        -moz-animation: pulsate 1.5s ease-in-out infinite;
        -webkit-animation: pulsate 1.5s ease-in-out infinite;
        border:1pt solid #fff;
        /* make a circle */
        -moz-border-radius:51px;
        -webkit-border-radius:51x;
        border-radius:51px;
        /* multiply the shadows, inside and outside the circle */
        -moz-box-shadow:inset 0 0 10px #3BA800, inset 0 0 10px #3BA800, inset 0 0 10px #3BA800, 0 0 10px #3BA800, 0 0 10px #3BA800, 0 0 10px #3BA800;
        -webkit-box-shadow:inset 0 0 10px #3BA800, inset 0 0 10px #3BA800, inset 0 0 10px #3BA800, 0 0 10px #3BA800, 0 0 10px #3BA800, 0 0 10px #3BA800;
        box-shadow:inset 0 0 10px #3BA800, inset 0 0 10px #3BA800, inset 0 0 10px #3BA800, 0 0 10px #3BA800, 0 0 10px #3BA800, 0 0 10px #3BA800;
        /* set the ring's new dimension and re-center it */
        height:51px!important;
        margin:-18px 0 0 -18px;
        width:51px!important;
    }
    #map_canvas div.gmnoprint[title^="Status: OFFLINE"] {
        -moz-animation: pulsate 1.5s ease-in-out infinite;
        -webkit-animation: pulsate 1.5s ease-in-out infinite;
        border:1pt solid #fff;
        /* make a circle */
        -moz-border-radius:51px;
        -webkit-border-radius:51px;
        border-radius:51px;
        /* multiply the shadows, inside and outside the circle */
        -moz-box-shadow:inset 0 0 10px #82007A, inset 0 0 10px #82007A, inset 0 0 10px #82007A, 0 0 10px #82007A, 0 0 10px #82007A, 0 0 10px #82007A;
        -webkit-box-shadow:inset 0 0 10px #82007A, inset 0 0 10px #82007A, inset 0 0 10px #82007A, 0 0 10px #82007A, 0 0 10px #82007A, 0 0 10px #82007A;
        box-shadow:inset 0 0 10px #82007A, inset 0 0 10px #82007A, inset 0 0 10px #82007A, 0 0 10px #82007A, 0 0 10px #82007A, 0 0 10px #82007A;
        /* set the ring's new dimension and re-center it */
        height:51px!important;
        margin:-18px 0 0 -18px;
        width:51px!important;
    }
     #map_canvas div.gmnoprint[title^="Status: DEFAULT"] {
        -moz-animation: pulsate 1.5s ease-in-out infinite;
        -webkit-animation: pulsate 1.5s ease-in-out infinite;
        border:1pt solid #fff;
        /* make a circle */
        -moz-border-radius:51px;
        -webkit-border-radius:51px;
        border-radius:51px;
        /* multiply the shadows, inside and outside the circle */
        -moz-box-shadow:inset 0 0 5px #06f, inset 0 0 5px #06f, inset 0 0 5px #06f, 0 0 5px #06f, 0 0 5px #06f, 0 0 5px #06f;
        -webkit-box-shadow:inset 0 0 5px #06f, inset 0 0 5px #06f, inset 0 0 5px #06f, 0 0 5px #06f, 0 0 5px #06f, 0 0 5px #06f;
        box-shadow:inset 0 0 5px #06f, inset 0 0 5px #06f, inset 0 0 5px #06f, 0 0 5px #06f, 0 0 5px #06f, 0 0 5px #06f;
        /* set the ring's new dimension and re-center it */
        height:51px!important;
        margin:-18px 0 0 -18px;
        width:51px!important;
    }
    /* hide the superfluous marker image since it would expand and shrink with its containing element */
/*  #map_canvas div[style*="987654"][title] img {*/
    #map_canvas div.gmnoprint[title^="Taksi"] img {
        display:none;
    }
    ul{
        font-size: 1em;
        list-style:none;
        font-weight: 600;
    }
    ul > li{
      display: inline;
      margin:-5px 0px 0px 0px;
      display:block;
      float: right;
      width: 150px;
    }
    #legends{
        text-align: center;
        height: 25px;
        width: auto;
        border-bottom: 2px solid #ccc;
        line-height: 2;
    }
    </style>
    <script src="http://code.jquery.com/jquery-1.8.2.min.js"></script>
    <script type="text/javascript">
jQuery(function($) {
    // Asynchronously Load the map API
    var script = document.createElement('script');
    script.src = "http://maps.googleapis.com/maps/api/js?sensor=false&callback=initialize";
    script.type = "text/javascript";
    script.async = true;
    document.body.appendChild(script);
    $('#map_wrapper').css({
        'height': (screen.height - 200) + 'px',
        'width': (screen.width - 210) + 'px'
    });
});

function initialize() {
    var map;
    var bounds = new google.maps.LatLngBounds();
    var mapOptions = {
        zoom: 4,
        mapTypeId: google.maps.MapTypeId.ROADMAP
    };

    // Display a map on the page
    map = new google.maps.Map(document.getElementById("map_canvas"), mapOptions);
    // var trafficLayer = new google.maps.TrafficLayer();
    // trafficLayer.setMap(map);
    map.setTilt(45);

    $.get('<?php echo base_url("taximaps/taxis")?>', function(rsp) {
        var ptaxis = $.parseJSON(rsp);
        var locations = [];
        var infoWindowContent = [];
        var jt = 0;
        var image = "";
        var tx_status = "KOSONG";
        $.each(ptaxis, function(i, c) {
            if (i == 0) {
                locations.push(new Array('No.Taksi: ' + c.taxi_number+'\nNama: ' + c.name + '\nTelepon: ' + c.phone, c.latitude, c.longitude));
                infoWindowContent.push(new Array('<div class="info_content"><h3>' + c.name + ' - ' + c.nik + '</h3><p>No.Polisi: ' + c.license_plate + '</p><p>Telepon: ' + c.phone + '</p></div>'));
            } else if (i > 0) {
                jt = Math.abs(i - 1);
                if ((ptaxis[jt].longitude != ptaxis[i].longitude) && (ptaxis[jt].latitude != ptaxis[i].latitude)) {
                    locations.push(new Array( 'No.Taksi: ' + c.taxi_number +'\nNama: ' + c.name + '\nTelepon: ' + c.phone, c.latitude, c.longitude));
                    infoWindowContent.push(new Array('<div class="info_content"><h3>' + c.name + ' - ' + c.nik + '</h3><p>No.Polisi: ' + c.license_plate + '</p><p>Telepon: ' + c.phone + '</p></div>'));
                }
            }
        });
        // Display multiple markers on a map
        var infoWindow = new google.maps.InfoWindow(),
            marker, i, j, arrmarkers = new Array();

        // Loop through our array of markers & place each one on the map
        var iconstatus = {
            'ST00': '<?php echo base_url("statics/images/markerisi.png"); ?>',
            'ST01': '<?php echo base_url("statics/images/markerkosong.png"); ?>',
            'ST02': '<?php echo base_url("statics/images/markerjemput.png"); ?>',
            'ST04': '<?php echo base_url("statics/images/markeroffline.png"); ?>'
        };
        var position = "";
        for (var i = 0; i < locations.length; i++) {
            position = new google.maps.LatLng(locations[i][1], locations[i][2]);
            bounds.extend(position);
            image = new google.maps.MarkerImage(
                iconstatus['ST01'],
                null, // size
                null, // origin
                new google.maps.Point(8, 8), // anchor (move to center of marker)
                new google.maps.Size(17, 17) // scaled size (required for Retina display icon)
            );
            // then create the new marker
            marker = new google.maps.Marker({
                flat: true,
                icon: image,
                map: map,
                optimized: false,
                position: position,
                title: locations[i][0],
                visible: true
            });
            arrmarkers.push(marker);

            marker.setAnimation(google.maps.Animation.DROP);
            j = i + 1;
            marker.setValues({
                type: "point",
                markerID: "rinarini" + j.toString()
            });
            // Allow each marker to have an info window
            google.maps.event.addListener(marker, 'click', (function(marker, i) {
                return function() {
                    infoWindow.setContent(infoWindowContent[i][0]);
                    infoWindow.open(map, marker);
                }
            })(marker, i));
            // Automatically center the map fitting all markers on the screen
            // map.fitBounds(bounds);
        }
        $.each(arrmarkers, function(index, marker) {
            bounds.extend(marker.position);
        });
        //  Fit these bounds to the map
        map.fitBounds(bounds);

        // Override our map zoom level once our fitBounds function runs (Make sure it only runs once)
        var boundsListener = google.maps.event.addListener((map), 'bounds_changed', function(event) {
            this.setZoom(14);
            google.maps.event.removeListener(boundsListener);
        });
    });
    $.get('<?php echo base_url("taximaps/getLatLongkonsumen")?>', function(rsp) {
        var ptaxis = $.parseJSON(rsp);
        var locations = [];
        var infoWindowContent = [];
        var jt = 0;
        var image = "";
        var tx_status = "JEMPUT";
        $.each(ptaxis, function(i, c) {
            if (i == 0) {
                locations.push(new Array('Nama: ' + c.name + '\nTelepon: ' + c.phone_number + '\nNo.Taksi: ' + c.taxi_number, c.latitude, c.longitude));
                infoWindowContent.push(new Array('<div class="info_content"><h3>' + c.name + '</p><p>Telepon: ' + c.phone_number + '</p></div>'));
            } else if (i > 0) {
                jt = Math.abs(i - 1);
                if ((ptaxis[jt].longitude != ptaxis[i].longitude) && (ptaxis[jt].latitude != ptaxis[i].latitude)) {
                    locations.push(new Array('Nama: ' + c.name + '\nTelepon: ' + c.phone + '\nNo.Taksi: ' + c.taxi_number, c.latitude, c.longitude));
                    infoWindowContent.push(new Array('<div class="info_content"><h3>'+'</p><p>Nama : ' + c.name +'</p>'+ '</p><p>Telepon : ' + c.phone_number + '</p></div>'));
                }
            }
        });
        // Display multiple markers on a map
        var infoWindow = new google.maps.InfoWindow(),
            marker, i, j, arrmarkers = new Array();

        // Loop through our array of markers & place each one on the map
        var iconstatus = {
            'ST00': '<?php echo base_url("statics/images/markerisi.png"); ?>',
            'ST01': '<?php echo base_url("statics/images/markerkosong.png"); ?>',
            'ST02': '<?php echo base_url("statics/images/markerjemput.png"); ?>',
            'ST04': '<?php echo base_url("statics/images/markeroffline.png"); ?>'
        };
        var position = "";
        for (var i = 0; i < locations.length; i++) {
            position = new google.maps.LatLng(locations[i][1], locations[i][2]);
            bounds.extend(position);
            image = new google.maps.MarkerImage(
                iconstatus['ST02'],
                null, // size
                null, // origin
                new google.maps.Point(8, 8), // anchor (move to center of marker)
                new google.maps.Size(25, 25) // scaled size (required for Retina display icon)
            );
            // then create the new marker
            marker = new google.maps.Marker({
                flat: true,
                icon: image,
                map: map,
                optimized: false,
                position: position,
                title: locations[i][0],
                visible: true
            });
            arrmarkers.push(marker);

            marker.setAnimation(google.maps.Animation.DROP);
            j = i + 1;
            marker.setValues({
                type: "point",
                markerID: "rinarini" + j.toString()
            });
            // Allow each marker to have an info window
            google.maps.event.addListener(marker, 'click', (function(marker, i) {
                return function() {
                    infoWindow.setContent(infoWindowContent[i][0]);
                    infoWindow.open(map, marker);
                }
            })(marker, i));
            // Automatically center the map fitting all markers on the screen
            // map.fitBounds(bounds);
        }
        $.each(arrmarkers, function(index, marker) {
            bounds.extend(marker.position);
        });
        //  Fit these bounds to the map
        map.fitBounds(bounds);

        // Override our map zoom level once our fitBounds function runs (Make sure it only runs once)
        var boundsListener = google.maps.event.addListener((map), 'bounds_changed', function(event) {
            this.setZoom(14);
            google.maps.event.removeListener(boundsListener);
        });
    });
}

</script>
</head>
<body>
    <div id="map_wrapper">
    <div id="map_canvas" class="mapping">Download map..</div>
</div>
</body>
</html>
