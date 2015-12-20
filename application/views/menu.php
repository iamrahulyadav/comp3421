<?php
/**
 * comp3421
 * Created by admin.
 * Date: 14/12/2015 17:07
 */
?>
<link rel="stylesheet" type="text/css" href="../css/menu.css"/>
<?php
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
}
?>
<table id="menuBar">
    <tr>
        <?php
        foreach ($urls as $title => $url) {
            echo '<td><a href="' . site_url($url) . '" title="' . $title . '">' . $title . '</a ></td > ';
        }
        if ($this->auth->isLoggedIn()) {
            echo '<td>' . $this->auth->user()->display_name() ;
            if ($this->auth->user()->is_admin)
                echo ' [admin]';
            echo '</td>';
            echo ' <td><a href="' . site_url('auth/logout') . '">Logout</a></td>';
        } else {
            echo '<td><a href="' . site_url('auth/login') . '">Login</a></td>';
        }
        ?>
    </tr>
</table>
