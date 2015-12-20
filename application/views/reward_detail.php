<!DOCTYPE html>
<html lang="en">
<head>
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
    <meta charset="UTF-8">
    <title>Registration and Attendance Managing Application</title>
    <script src="<?php echo base_url('jquery/jquery.js') ?>"></script>
</head>
<body>
<?php echo $menu ?>
<h1><?php echo htmlspecialchars($title) ?></h1>

<table>
    <tr>
        <td>Reward ID:</td>
        <td><?php echo $data['id']; ?></td>
    </tr>
    <tr>
        <td>Title:</td>
        <td><?php echo $data['title']; ?></td>
    </tr>
    <tr>
        <td>Content:</td>
        <td><?php echo $data['content']; ?></td>
    </tr>
</table>
<br>
<?php
if ($this->auth->isLoggedIn() && $this->auth->user()->is_admin) {
    echo '<a href="' . site_url("rewards") . '/edit/'.$data['id'].'"><button>Edit</button></a>';
    echo '<a href="' . site_url("rewards") . '/delete/'.$data['id'].'"><button>Delete</button></a>';
}
echo '<a href="' . site_url("rewards") . '"><button>Back</button></a >'
?>
</body>
</html>