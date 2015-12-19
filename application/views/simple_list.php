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
<?php if ($this->auth->user()->is_admin) {
    echo "<a href=\"$create_url\"><button>Create</button></a>";
} ?>
<table border="1">
    <?php
    echo '<tr>';
    foreach ($fields as $name => $f) {
        if (isset($f['title']))
            echo '<th>' . htmlspecialchars($f['title']) . '</th>';
    }
    if ($this->auth->isLoggedIn() && $this->auth->user()->is_admin) {
        echo "<th>Edit</th><th>Delete</th>";
    }
    echo '</tr>';
    foreach ($data as $v) {
        echo '<tr>';
        foreach ($fields as $dbcolumn => $f) {
            if (isset($f['title']))
                echo "<td>{$v[$dbcolumn]}</td>";
        }
        if ($this->auth->isLoggedIn() && $this->auth->user()->is_admin) {
            echo '<td><a href="' . str_replace('{id}', $v['id'], $edit_url) . '"><button>Edit</button></a></td>';
            echo '<td><a href="' . str_replace('{id}', $v['id'], $delete_url) . '"><button>Delete</button></a></td>';
        }
        echo '</tr>';
    }
    ?>
</table>
</body>
</html>