<?php
/**
 * comp3421
 * Created by admin.
 * Date: 14/12/2015 17:07
 */
?>
<link rel="stylesheet" type="text/css" href="../css/menu.css"/>
<h1>Registration and Attendance Managing Application</h1>

<p>Welcome<?php
    $urls = array();
    if ($this->auth->isLoggedIn()) {
        $urls['View Conference Sessions'] = 'sessions';
        $urls['View Exhibitions'] = 'exhibition';
        $urls['View Forums'] = 'forum';
        $urls['View Announcements'] = 'announcements';
        $urls['View Rewards'] = 'rewards';
        $urls['View Messages'] = 'messages';
        $urls['Do Survey'] = 'doSurvey';
        if ($this->auth->user()->is_admin) {
            $urls['Edit Surveys'] = 'surveys';
            $urls['Register Member'] = 'auth/register';
            $urls['View Members'] = 'members';
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
<table>
    <tr>
    <?php foreach ($urls as $title => $url) {
        echo '<td><a href="' . site_url($url) . '" title="' . $title . '">' . $title . '</a ></td > ';
    } ?>
    </tr>
</table>
