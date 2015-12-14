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
    <title>Chess Game</title>
    <link rel="stylesheet" type="text/css" href="jquery/style.css">
    <link rel="stylesheet" type="text/css" href="jquery/jquery-ui.css">
    <link rel="stylesheet" type="text/css" href="jquery/jquery-ui.structure.css">
    <script src="jquery/jquery.js"></script>
    <script src="jquery/jquery-ui.js"></script>
</head>
<body id="registration">
<h1>Registration</h1>

<div>
    Geographical location
</div>
<div id="map_div" style="height:400px; width: 400px;">
    <div id="map"></div>
</div>
<script type="text/javascript">
    $(document).ready(function () {
        var map;
        var elevator;
        var myOptions = {
            zoom: 1,
            center: new google.maps.LatLng(0, 0),
            mapTypeId: 'terrain'
        };
        map = new google.maps.Map($('#map_canvas')[0], myOptions);

//
//        $.ajax({
//            method: "get",
//            dataType: "json",
//            url: "get_location.php",
//            success: function (data) {
//                for (var i = 0; i < data.length; i++) {
//                    var temp_lat = data[i].lat;
//                    var temp_long = data[i].long;
//                    var latlng = new google.maps.LatLng(temp_lat, temp_long);
//                    new google.maps.Marker({
//                        position: latlng,
//                        map: map
//                    });
//                }
//            }
//        });
    });
</script>
<script src="https://maps.googleapis.com/maps/api/js?key=AIzaSyCzzmr04bM7hfgehfBvpTC7vFLEiugg6KE&callback=initMap" async
        defer></script>
</body>
</html>