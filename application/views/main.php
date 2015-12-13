<?php
/**
 * comp3421
 * Created by LKHO.
 * Date: 9/12/2015 23:16
 */
defined('BASEPATH') OR exit('No direct script access allowed');
?>
<!DOCTYPE html>
<html>
<head>
    <meta charset="UTF-8">
    <title>Registration and Attendance Managing Application</title>
</head>
<body>
<h1>Registration and Attendance Managing Application</h1>

<p>Welcome<?php if (isset($user)) {
        echo ' ' . $user->display_name() . '!';
        if ($user->is_admin)
            echo ' [admin]';
        echo ' (<a href="' . site_url('auth/logout') . '">Log out</a>)';
    } else {
        echo '! (<a href="' . site_url('auth/login') . '">Log in</a>)';
    } ?></p>
<ul>
    <?php foreach ($urls as $title => $href) {
        echo "<li><a href=\"$href\" title=\"$title\">$title</a></li>";
    } ?>
</ul>
</body>
</html>