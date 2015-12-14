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

if ($this->auth->isLoggedIn()
    && $this->auth->user()->is_admin
) {
    echo "<button>create</button>";
}
echo "<table>";
echo '<th>';
echo '<td>No.</td>';
echo '<td>Date</td>';
echo '<td>Time</td>';
echo '<td>Topic</td>';
echo '<td>Speaker</td>';
echo '<td>Venue</td>';
echo '<td>View Information</td>';
if ($this->auth->isLoggedIn()
    && $this->auth->user()->is_admin
) {
    echo '<td>Edit</td>';
    echo '<td>Delete</td>';
}
echo '</th>';
for ($i = 0; $i < count($data); $i++) {
    $startDate = date("Y-m-d",strtotime($data[$i]['start_time']));
    $endDate = date("Y-m-d",strtotime($data[$i]['end_time']));
    $startTime = date("H:i",strtotime($data[$i]['start_time']));
    $endTime = date("H:i",strtotime($data[$i]['end_time']));
    $no=$i+1;
    echo '<tr>';
    echo "<td>{$no}</td>";
    echo "<td>{$data[$i]['date']}</td>";
    echo "<td>{$data[$i]['start_time']} - {$data[$i]['end_time']}</td>";
    echo "<td>{$data[$i]['topic']}</td>";
    echo "<td>{$data[$i]['exhibitor']}<button>view exhibitor's information</button></td>";
    echo "<td>{$data[$i]['location']}<button>view location in map</button></td>";
    echo "<td><button>view information</button></td>";
    if ($this->auth->isLoggedIn()
        && $this->auth->user()->is_admin
    ) {
        echo "<td><button>edit</button></td>";
        echo "<td><button>delete</button></td>";
    }
}
echo "</table>";
?>