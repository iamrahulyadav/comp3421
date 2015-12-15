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
    echo "<a href='$create_url'><button>Create</button></a>";
}
?>
<table>
    <tr>
        <th>No.</th>
        <th>Date</th>
        <th>Time</th>
        <th>Type</th>
        <th>Company</th>
        <th>Location</th>
        <th>Booth</th>
        <th>View Information</th>
        <?php
        if ($this->auth->user()->is_admin) { ?>
            <th>Edit</th>
            <th>Delete</th>
        <?php } ?>
    </tr>
    <?php
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
        echo "<td>{$data[$i]['type']}</td>";
        echo "<td>{$data[$i]['company']}</td>";
        echo "<td>{$data[$i]['location']}</td>";
        echo "<td>{$data[$i]['booth']}</td>";
        $u = str_replace('{id}', $data[$i]['id'], $item_url);
        echo "<td><a href='$item_url'><button>view information</button></a></td>";
        if ($this->auth->user()->is_admin) {
            $u = str_replace('{id}', $data[$i]['id'], $edit_url);
            echo "<td><a href='$u'><button>edit</button></a></td>";
            $u = str_replace('{id}', $data[$i]['id'], $delete_url);
            echo "<td><a href=\"javascript:if(confirm('Are you sure to delete?'))window.location='$u'\"><button>delete</button></a></td>";
        }
    }
    ?>
</table>
</body>
</html>