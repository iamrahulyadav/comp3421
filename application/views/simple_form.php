<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Registration and Attendance Managing Application</title>
</head>
<body>
<?php echo isset($menu) ? $menu : '' ?>
<h1><?php echo htmlspecialchars($title) ?></h1>

<form method="post" target="async">
    <table>
        <?php

        foreach ($fields as $key => $v) {
            echo '<tr>';
            echo "<td>{$v[0]}:</td>";
            echo "<td><input name=\"$key\" type=\"{$v[1]}\"" . (!isset($first) ? ' required autofocus' : '') . ' /></td>';
            echo '</tr>';
            $first = TRUE;
        }

        ?>
    </table>
    <input type="submit" value="<?php echo $button ?>"/>
</form>
<iframe name="async" style="display: none"></iframe>
<?php if (isset($err)) echo '<script>alert(' . json_encode($err) . ');</script>' ?>
</body>
</html>