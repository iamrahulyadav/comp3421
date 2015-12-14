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
    echo "<a href='" . site_url('conference/create') . "'><button>create</button></a>";
}
echo "<table>";
echo '<tr>';
echo '<th>No.</th>';
echo '<th>Date</th>';
echo '<th>Time</th>';
echo '<th>Topic</th>';
echo '<th>Speaker</th>';
echo '<th>Venue</th>';
echo '<th>View Information</th>';
if ($this->auth->isLoggedIn()
    && $this->auth->user()->is_admin
) {
    echo '<th>Edit</th>';
    echo '<th>Delete</th>';
}
echo '</tr>';
for ($i = 0; $i < count($data); $i++) {
    $startDate = date("Y-m-d", strtotime($data[$i]['start_time']));
    $endDate = date("Y-m-d", strtotime($data[$i]['end_time']));
    $startTime = date("H:i", strtotime($data[$i]['start_time']));
    $endTime = date("H:i", strtotime($data[$i]['end_time']));
    $no = $i + 1;
    echo '<tr>';
    echo "<td>{$no}</td>";
    echo "<td>{$startDate} - {$endDate}</td>";
    echo "<td>{$startTime} - {$endTime}</td>";
    echo "<td>{$data[$i]['topic']}</td>";
    echo "<td>{$data[$i]['speaker']}</td>";
    echo "<td>{$data[$i]['location']}</td>";
    $u = site_url('conference/item/' . $data[$i]['id']);
    echo "<td><a href='$u'><button>view information</button></a></td>";
    if ($this->auth->isLoggedIn()
        && $this->auth->user()->is_admin
    ) {
        $u = site_url('conference/edit/' . $data[$i]['id']);
        echo "<td><a href='$u'><button>edit</button></a></td>";
        $u = site_url('conference/delete/' . $data[$i]['id']);
        echo "<td><a href=\"javascript:if(confirm('Are you sure to delete?'))window.location='$u'\"><button>delete</button></a></td>";
    }
}
echo "</table>";
?>