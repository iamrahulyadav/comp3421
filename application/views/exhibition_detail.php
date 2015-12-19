<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Registration and Attendance Managing Application</title>
    <script type="text/javascript" src="http://www.google.com/jsapi"></script>
    <script src="https://maps.googleapis.com/maps/api/js?key=AIzaSyCzzmr04bM7hfgehfBvpTC7vFLEiugg6KE&callback=initMap"
            async defer></script>
</head>
<body onload="drawMap()">
<?php echo $menu ?>
<h1><?php echo htmlspecialchars($title) ?></h1>
<table>
    <tr><th><?php $data['company']?></th></tr>
    <tr><td><?php $data['start_time']?></td></tr>
    <tr><td><?php $data['end_time']?></td></tr>
    <tr><td><?php $data['venue']?></td></tr>
</table>

<div id="map" style="height: 450px;width: 400px">
</div>

<script>
    var map;
    var geocoder;
    var marker;
    function drawMap() {
        geocoder = new google.maps.Geocoder();

        var myLatlng = new google.maps.LatLng(<?php echo $data['lat'] ?>;, <?php echo $data['lng'] ?>);
        var myOptions = {
            "zoom": 10,
            "center": myLatlng,
            "mapTypeId": google.maps.MapTypeId.ROADMAP
        }
        map = new google.maps.Map(document.getElementById("map"), myOptions);
    }
</script>