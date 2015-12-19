<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Registration and Attendance Managing Application</title>
    <style>
        table {
            border       : 1px solid black;
            table-layout : fixed;
            width        : 400px;
        }

        td {
            border   : 1px solid black;
            overflow : hidden;
            width    : 50px;
        }
    </style>
    <script type="text/javascript" src="http://maps.google.com/maps/api/js?sensor=false"></script>
    <script>
        var map;
        var marker;
        function drawMap() {
            var lat =<?php echo $data['venue_lat'] ?>;
            var lng =<?php echo $data['venue_lng'] ?>;
            var myLatlng = new google.maps.LatLng(lat, lng);
            var myOptions = {
                "zoom": 10,
                "center": myLatlng,
                "mapTypeId": google.maps.MapTypeId.ROADMAP
            }
            map = new google.maps.Map(document.getElementById("map"), myOptions);
            marker = new google.maps.Marker({
                position: myLatLng,
                map: map
            });
        }
    </script>
</head>
<body onload="drawMap()">
<?php echo $menu ?>
<h1><?php echo htmlspecialchars($title) ?></h1>
<table>
    <tr>
        <td>Company: </td>
        <td><?php $data['company'] ?></td>
    </tr>
    <tr>
        <td>Start Time: </td>
        <td><?php $data['start_time'] ?></td>
    </tr>
    <tr>
        <td>End Time: </td>
        <td><?php $data['end_time'] ?></td>
    </tr>
    <tr>
        <td>Venue: </td>
        <td><?php $data['venue'] ?></td>
    </tr>
</table>

<div id="map" style="height: 300px;width: 450px">
</div>
</body>

