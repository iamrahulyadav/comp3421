<?php
/**
 * comp3421
 * Created by admin.
 * Date: 14/12/2015 17:07
 */
?>
<h1>Registration and Attendance Managing Application</h1>

<p>Welcome<?php
    $urls = array();
    if ($this->auth->isLoggedIn()) {
        $urls['View Conference Sessions'] = 'sessions';
        $urls['View Exhibitions'] = 'exhibition';
        $urls['View Forums'] = 'forum';
        $urls['View Announcements'] = 'announcement';
        $urls['View Surveys'] = 'survey';
        $urls['View Rewards'] = 'reward';
        $urls['View Messages'] = 'message';
        $urls['View Conference Schedule'] = 'schedule';
        if ($this->auth->user()->is_admin) {
            $urls['View Attendance Info'] = 'attendance';
            $urls['Register Member'] = 'auth/register';
        }
    } else {
    }

    if ($this->auth->isLoggedIn()) {
        echo ' ' . $this->auth->user()->display_name() . '!';
        if ($this->auth->user()->is_admin)
            echo ' [admin]';
        echo ' (<a href="' . site_url('auth/logout') . '">Log out</a>)';
    } else {
        echo '! (<a href="' . site_url('auth/login') . '">Log in</a>)';
    } ?></p>
<ul>
    <?php foreach ($urls as $title => $url) {
        echo '<li><a href="' . site_url($url) . '" title="' . $title . '">' . $title . '</a ></li > ';
    } ?>
</ul>
