<?php
/**
 * comp3421
 * Created by LKHO.
 * Date: 9/12/2015 23:16
 */
defined('BASEPATH') OR exit('No direct script access allowed');
?>
<!DOCTYPE html>
<html>
<head>
    <style type="text/css">
        #map {
            height : 100%;
        }
    </style>
    <meta charset="UTF-8">
    <title>Conference location</title>
    <link rel="stylesheet" type="text/css" href="<?php echo base_url('jquery/jquery-ui.css') ?>">
    <link rel="stylesheet" type="text/css" href="<?php echo base_url('jquery/jquery-ui.structure.css') ?>">
    <script src="<?php echo base_url('jquery/jquery.js') ?>"></script>
    <script src="<?php echo base_url('jquery/jquery-ui.js') ?>"></script>
</head>
<body id="registration">
<h1>Conference location</h1>

<div>
    Geographical location
</div>
<div id="map_div" style="height:400px; width: 400px;">
    <div id="map"></div>
</div>
<script type="text/javascript">
    var map;
    function initMap() {
        var myPos = {lat: 0, lng: 0};
        map = new google.maps.Map(document.getElementById('map'), {
            center: myPos,
            zoom: 1
        });


        $.ajax({
            method: "get",
            dataType: "json",
            url: "<?php echo site_url('map/get_location')?>",
            success: function (data) {
                for (var i = 0; i < data.length; i++) {
                    var temp_lat = data[i].location_lat;
                    var temp_long = data[i].location_long;
                    var latlng = new google.maps.LatLng(temp_lat, temp_long);
                    new google.maps.Marker({
                        position: latlng,
                        map: map
                    });
                }
            }
        });
    }
</script>
<script src="https://maps.googleapis.com/maps/api/js?key=AIzaSyCzzmr04bM7hfgehfBvpTC7vFLEiugg6KE&callback=initMap" async
        defer></script>
</body>
</html>