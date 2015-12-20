<!DOCTYPE html>
<html lang="en">
<head>
    <style>
        table {
            border       : 1px solid black;
            table-layout : fixed;
            width        : 400px;
        }

        table.item{
            border       : 1px solid black;
            table-layout : fixed;
            width        : 100%;
        }

        td {
            border   : 1px solid black;
            overflow : hidden;
            width    : 50px;
        }
    </style>
    <meta charset="UTF-8">
    <title>Registration and Attendance Managing Application</title>
    <script src="<?php echo base_url('jquery/jquery.js') ?>"></script>
</head>
<body>
<?php echo $menu ?>
<h1><?php echo htmlspecialchars($title) ?></h1>


<table>
    <tr>
        <td><?php echo $data['id']; ?></td>
        <td><?php echo $data['topic']; ?></td>
        <td><?php echo $data['time']; ?></td>
    </tr>
</table>
<?php
for($i=0;$i<sizeof($data['item']);$i++){
echo"<br>
<table class='item'>
    <tr>
        <td>No.</td>
        <td>{$data['item'][$i]['id']}</td>
    </tr>
    <tr>
        <td>Topic</td>
        <td>{$data['item'][$i]['title']}</td>
    </tr>
    <tr>
        <td>Time</td>
        <td>{$data['item'][$i]['content']}</td>
    </tr>
</table>
";
}
?>
<?php
echo '<a href="' . site_url("forum") . '"><button>Back</button></a >'
?>
</body>
</html>
