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

if ($this->auth->user()->is_admin) {
    echo "<a href=\"$create_url\"><button>create</button></a>";
}
echo "<table>";
echo '<tr>';
echo '<th>No.</th>';
echo '<th>Date</th>';
echo '<th>Time</th>';
echo '<th>Topic</th>';
echo '<th>Speaker</th>';
echo '<th>Venue</th>';
echo '<th>Venue Location</th>';
echo '<th>View Information</th>';
if ($this->auth->user()->is_admin) {
    echo '<th>Edit</th>';
    echo '<th>Delete</th>';
}
echo '</tr>';
$no = 0;
foreach ($data as $item) {
    $no++;
    $startDate = date("Y-m-d", strtotime($item['start_time']));
    $endDate = date("Y-m-d", strtotime($item['end_time']));
    $startTime = date("H:i", strtotime($item['start_time']));
    $endTime = date("H:i", strtotime($item['end_time']));
    echo '<tr>';
    echo "<td>{$no}</td>";
    echo "<td>{$startDate} - {$endDate}</td>";
    echo "<td>{$startTime} - {$endTime}</td>";
    echo "<td>{$item['topic']}</td>";
    echo "<td>{$item['speaker']}</td>";
    echo "<td>{$item['venue']}</td>";
    echo "<td>{$item['location_lat']}, {$item['location_long']}</td>";
    echo '<td><a href="' . str_replace('{id}', $item['id'], $item_url) . '"><button>view information</button></a></td>';
    if ($this->auth->user()->is_admin) {
        echo '<td><a href="' . str_replace('{id}', $item['id'], $edit_url) . '"><button>edit</button></a></td>';
        echo '<td><a href="' . str_replace('{id}', $item['id'], $delete_url) . '"><button>delete</button></a></td>';
    }
}
echo "</table>";
?>