<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Registration and Attendance Managing Application</title>
</head>
<body>
<?php echo isset($menu) ? $menu : '' ?>
<h1><?php echo htmlspecialchars($title) ?></h1>

<form
    method="<?php echo isset($form['method']) ? $form['method'] : 'post' ?>"
    action="<?php echo isset($form['action']) ? $form['action'] : '' ?>"
    target="async">
    <table>
        <?php

        foreach ($fields as $name => $f) {
            echo '<tr><td>' . htmlspecialchars($f['name']) . '</td>';
            echo '<td>';
            if (empty($f['type'])) $f['type'] = 'text';
            switch ($f['type']) {
                case 'textarea':
                    echo "<textarea name=\"$name\"";
                    if (isset($f['attr'])) {
                        foreach ($f['attr'] as $k => $v)
                            echo " $k=\"$v\"";
                    }
                    echo "></textarea>";
                    break;
                case 'select':
                    echo "<select name=\"$name\"";
                    if (isset($f['attr'])) {
                        foreach ($f['attr'] as $k => $v)
                            echo " $k=\"$v\"";
                    }
                    echo ">";
                    if (isset($f['values'])) {
                        foreach ($f['values'] as $k => $v)
                            echo "<option value=\"$k\">" . htmlspecialchars($v) . "</option>";
                    }
                    echo "</select>";
                    break;
                case 'radio':
                    if (isset($f['values'])) {
                        foreach ($f['values'] as $k => $v) {
                            echo "<label><input type=\"radio\" name=\"$name\" value=\"$k\"";
                            if (isset($f['attr'])) {
                                foreach ($f['attr'] as $ak => $av)
                                    echo " $ak=\"$av\"";
                            }
                            echo " />" . htmlspecialchars($v) . '</label>';
                        }
                    }
                    break;
                default:
                    echo "<input name=\"$name\" type=\"{$f['type']}\"";
                    if (isset($f['attr'])) {
                        foreach ($f['attr'] as $k => $v)
                            echo " $k=\"$v\"";
                    }
                    echo " />";
                    break;

            }
        }

        ?>
    </table>
    <input type="submit" value="<?php echo $button ?>"/>
</form>
<iframe name="async" style="display: none"></iframe>
<?php if (isset($err)) echo '<script>alert(' . json_encode($err) . ');</script>' ?>
</body>
</html>