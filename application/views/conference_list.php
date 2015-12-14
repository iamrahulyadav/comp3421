<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Registration and Attendance Managing Application</title>
</head>
<body>
<?php echo $menu ?>
<h1><?php echo htmlspecialchars($title) ?></h1>
    <?php

    for($i = 0;$i < count($data);$i++){
        echo "<table>";

        echo '<tr>';
        echo "<td>{$i}</td>";
        echo "<td colspan='2'>{$data[$i]['topic']}</td>";
        echo '</tr>';

        echo '<tr>';
        echo "<td></td>";
        echo "<td>Date:</td>";
        echo "<td>{$data[$i]['date']}</td>";
        echo '</tr>';

        echo '<tr>';
        echo "<td></td>";
        echo "<td>Time:</td>";
        echo "<td>{$data[$i]['start_time']} - {$data[$i]['end_time']}</td>";
        echo '</tr>';

        echo '<tr>';
        echo "<td></td>";
        echo "<td>Venue:</td>";
        echo "<td>{$data[$i]['location']}</td>";
        echo '</tr>';

        echo '<tr>';
        echo "<td></td>";
        echo "<td>Speaker:</td>";
        echo "<td>{$data[$i]['speaker']}</td>";
        echo '</tr>';

        echo '<tr>';
        echo "<td></td>";
        echo "<td>Information:</td>";
        echo "<td>{$data[$i]['info']}</td>";
        echo '</tr>';

        echo "</table>";
    }

    ?>