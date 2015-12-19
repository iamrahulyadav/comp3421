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
    <table>
        <?php
        echo '<th>';
        foreach ($list as $name => $f) {
            echo '<td>' . htmlspecialchars($f['title']) . '</td>';
        }
        if ($this->auth->isLoggedIn()&& $this->auth->user()->is_admin) {
            echo '<td>Edit</td>';
            echo '<td>Delete</td>';
        }
        echo '</th>';
        for($i=0;$i<count($data);$i++){
            echo '<tr>';
            foreach ($list as $name => $f)
                echo '<td>{$data[$i][$f["db_column_name"]}</td>';
            
            if ($this->auth->isLoggedIn() && $this->auth->user()->is_admin) {
                echo "<td><button>edit</button></td>";
                echo "<td><button>delete</button></td>";
            }
            echo '</tr>';
        }
        ?>
    </table>
</body>
</html>