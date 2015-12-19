<!DOCTYPE html>
<html lang="en">
<head>
    <style type="text/css">
        #map {
            height : 100%;
        }
    </style>
    <meta charset="UTF-8">
    <title>Announcement</title>
    <link rel="stylesheet" type="text/css" href="<?php echo base_url('jquery/jquery-ui.css') ?>">
    <link rel="stylesheet" type="text/css" href="<?php echo base_url('jquery/jquery-ui.structure.css') ?>">
    <script src="<?php echo base_url('jquery/jquery.js') ?>"></script>
    <script src="<?php echo base_url('jquery/jquery-ui.js') ?>"></script>
</head>
<body>
<?php echo $menu ?>
<h1><?php echo htmlspecialchars($title) ?></h1>
<table>
    <button>view speaker's information</button>
    <p>Conference Notes</p>
</table>
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
            url: "<?php echo site_url('conference/get_location/'.$data['id'])?>",
            success: function (data) {
                var temp_lat = data.location_lat;
                var temp_long = data.location_long;
                var latlng = new google.maps.LatLng(temp_lat, temp_long);
                new google.maps.Marker({
                    position: latlng,
                    map: map
                });
            }
        });
    }
</script>
<script src="https://maps.googleapis.com/maps/api/js?key=AIzaSyCzzmr04bM7hfgehfBvpTC7vFLEiugg6KE&callback=initMap" async
        defer></script>
</body>
</html>