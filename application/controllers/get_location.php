<?php

/**
 * comp3421
 * Created by LKHO.
 * Date: 9/12/2015 19:11
 */

$sql = "SELECT lat, long FROM comp3421_conference_location";
$result = mysqli_query($conn, $sql);
mysqli_close($conn);
while ($row = $result->fetch_assoc()) {
    $myArray[] = $row;
}
header('Content-Type: application/json; charset=utf-8');
echo json_encode($myArray);