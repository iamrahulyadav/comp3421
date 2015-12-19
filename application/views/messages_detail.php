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
</head>
<body>
<?php echo $menu ?>
<h1><?php echo htmlspecialchars($title) ?></h1>
<table>
    <tr>
        <td>Message ID:</td>
        <td><?php echo $data['id']; ?></td>
    </tr>
    <tr>
        <td>Sender ID:</td>
        <td><?php echo $data['sender_id']; ?></td>
    </tr>
    <tr>
        <td>Receiver ID:</td>
        <td><?php echo $data['receiver_id']; ?></td>
    </tr>
    <tr>
        <td>Title:</td>
        <td><?php echo $data['title']; ?></td>
    </tr>
    <tr>
        <td>Content:</td>
        <td><?php echo $data['content']; ?></td>
    </tr>
    <tr>
        <td>Sent Time:</td>
        <td><?php echo $data['time']; ?></td>
    </tr>
</table>
<br>
<?php
if ($this->auth->isLoggedIn() && $this->auth->user()->is_admin) {
    echo '<a href="' . site_url("messages") . '/edit/'.$data['id'].'"><button>Edit</button></a>';
    echo '<a href="' . site_url("messages") . '/delete/'.$data['id'].'"><button>Delete</button></a>';
}
echo '<a href="' . site_url("messages") . '"><button>Back</button></a >'
?>
</body>
</html>
