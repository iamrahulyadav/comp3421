<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Registration and Attendance Managing Application</title>
    <script src="<?php echo base_url('jquery/jquery.js') ?>"></script>
</head>
<body>
<?php echo isset($menu) ? $menu : '' ?>
<h1><?php echo htmlspecialchars($title) ?></h1>

<form
    method="<?php echo isset($form['method']) ? $form['method'] : 'post' ?>"
    action="<?php echo isset($form['action']) ? $form['action'] : '' ?>"
    target="async">
    <table>
        <?php

        foreach ($fields as $name => $f) {
            if (empty($f['type'])) continue;
            if (isset($f['label']) && $f['type'] != 'hidden') {
                echo '<tr><td>' . ($f['label']) . '</td>';
                echo '<td>';
            }
            switch ($f['type']) {
                case 'textarea':
                    echo "<textarea name=\"$name\"";
                    if (isset($f['attr'])) {
                        foreach ($f['attr'] as $k => $v)
                            echo " $k=\"$v\"";
                    }
                    echo ">" . (isset($data[$name]) ? htmlspecialchars($data[$name]) : '') . "</textarea>";
                    break;
                case 'select':
                    echo "<select name=\"$name\"";
                    if (isset($f['attr'])) {
                        foreach ($f['attr'] as $k => $v)
                            echo " $k=\"$v\"";
                    }
                    echo ">";
                    if (isset($f['values'])) {
                        if (isset($data[$name])) {
                            foreach ($f['values'] as $k => $v)
                                echo "<option value=\"$k\"" . ($data[$name] == $k ? ' selected' : '') . ">" . htmlspecialchars($v) . "</option>";
                        } else {
                            foreach ($f['values'] as $k => $v)
                                echo "<option value=\"$k\">" . htmlspecialchars($v) . "</option>";
                        }
                    }
                    echo "</select>";
                    break;
                case 'radio':
                    if (isset($f['values'])) {
                        foreach ($f['values'] as $k => $v) {
                            echo "<label><input type=\"radio\" name=\"$name\" value=\"$k\"";
                            if (isset($f['attr'])) {
                                foreach ($f['attr'] as $ak => $av)
                                    echo " $ak=\"$av\"";
                            }
                            if (isset($data[$name]) && $data[$name] = $k)
                                echo " checked";
                            echo " />" . htmlspecialchars($v) . '</label>';
                        }
                    }
                    break;
                case 'map':
                    $div_id = 'map_' . $name;
                    $map_id[$div_id] = NULL;
                    echo "<div id=\"$div_id\" lat=\"{$f['lat']}\" lng=\"{$f['lng']}\"";
                    foreach ($f['attr'] as $k => $v)
                        echo " $k=\"$v\"";
                    echo "></div>";
                    break;
                case 'datetime':
                case 'datetime-local':
                    if (isset($data[$name]))
                        $data[$name] = date('Y-m-d\\TH:i:s', strtotime($data[$name]));
                default:
                    echo "<input name=\"$name\" type=\"{$f['type']}\"";
                    if (isset($f['attr'])) {
                        foreach ($f['attr'] as $k => $v)
                            echo " $k=\"$v\"";
                    }
                    if (isset($data[$name]))
                        echo ' value="' . htmlspecialchars($data[$name]) . '"';
                    echo " />";
                    break;
            }
            if (isset($f['label']) && $f['type'] != 'hidden') {
                echo '</td></tr>';
            }
        }

        ?>
    </table>
    <input type="submit" value="<?php echo $button ?>"/>
    <input type="reset" value="Reset"/>
</form>
<iframe name="async" style="display: none"></iframe>
<?php if (isset($err)) echo '<script>alert(' . json_encode($err) . ');</script>' ?>
<?php if (!empty($map_id)) { ?>
    <script type="text/javascript" src="http://www.google.com/jsapi"></script>
    <script src="https://maps.googleapis.com/maps/api/js?key=AIzaSyCzzmr04bM7hfgehfBvpTC7vFLEiugg6KE&callback=initMap"
            async defer></script>
    <script>
        var maps = <?php echo json_encode($map_id) ?>;
        function initMap() {
            for (var id in maps) {
                var $map = $("#" + id);
                var $lat = $('[name=' + $map.attr('lat') + ']');
                var $lng = $('[name=' + $map.attr('lng') + ']');
                var p = {
                    lat: parseFloat($lat.val()),
                    lng: parseFloat($lng.val())
                };
                var mymarker = null;
                if (!isNaN(p.lat) && !isNaN(p.lng)) {
                    mymarker = new google.maps.Marker({map: maps[id], position: p});
                } else {
                    if (google.loader.ClientLocation)
                        p = {lat: google.loader.ClientLocation.latitude, lng: google.loader.ClientLocation.longitude};
                    else
                        p = {lat: 22.36, lng: 114.13};
                }
                var map = maps[id] = new google.maps.Map($map[0], {
                    center: p,
                    zoom: 10
                });
                maps[id].mymarker = mymarker;
                maps[id].addListener('click', function (e) {
                    var div = $(this.getDiv());
                    $('[name=' + div.attr('lat') + ']').val(e.latLng.lat());
                    $('[name=' + div.attr('lng') + ']').val(e.latLng.lng());
                    if (!this.mymarker) {
                        this.mymarker = new google.maps.Marker({map: this});
                    }
                    this.mymarker.setPosition(e.latLng);
                });

                $lat.add($lng).on('change', function () {
                    if (!isNaN($lat.val()) && !isNaN(($lng.val()))) {
                        var pp = {lat: parseFloat($lat.val()), lng: parseFloat($lng.val())};
                        if (!map.mymarker)
                            map.mymarker = new google.maps.Marker({
                                map: map,
                                position: pp
                            });
                        else
                            map.mymarker.setPosition(pp);
                    }
                });
            }
        }
    </script>
<?php } ?>
</body>
</html>