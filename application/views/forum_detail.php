<!DOCTYPE html>
<html lang="en">
<head>
    <style>
        table {
            border       : 1px solid black;
            table-layout : fixed;
            width        : 400px;
        }

        table.item {
            border       : 1px solid black;
            table-layout : fixed;
            width        : 100%;
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
        <td><?php echo $data['id']; ?></td>
        <td><?php echo $data['topic']; ?></td>
        <td><?php echo $data['time']; ?></td>
    </tr>
</table>
<br>

<?php if ($this->auth->isLoggedIn() && isset($create_url)) {
    echo "<a href=\"$create_url\"><button>Post</button></a>";
} ?>

<?php
for ($i = 0; $i < sizeof($data['item']); $i++) {
    $ii = $i + 1;
    $level = 50 * $data['item'][$i]['level'];
    echo "<br>
<table class='item' style='margin-left: {$level}px'>
    <tr>
        <td>No. {$ii}</td>
        <td>id: {$data['item'][$i]['id']}</td>
        <td>{$data['item'][$i]['writer_id']['id']}
        {$data['item'][$i]['writer_id']['first_name']}
        {$data['item'][$i]['writer_id']['last_name']}</td>
        <td>{$data['item'][$i]['time']}</td>
    </tr>
    ";
    if (isset($data['item'][$i]['reply_to'])) {
        echo "
        <tr>
        <td colspan='4'>Reply to: {$data['item'][$i]['reply_to']}</td>
    </tr>
        ";
    }
    echo "
    <tr>
        <td colspan='4'>Title: {$data['item'][$i]['title']}</td>
    </tr>
    <tr>
        <td colspan='4'>{$data['item'][$i]['content']}</td>
    </tr>
    <tr>
        <td colspan='4'>";
    if ($this->auth->isLoggedIn()) {
        echo '<a href="' . str_replace('{reply_id}', $data['item'][$i]['id'], $reply_url) . '"><button>Reply</button></a>';
    }
    if ($this->auth->isLoggedIn() && $this->auth->user()->id == $data['item'][$i]['writer_id']['id']) {
        echo '<a href="'
            . str_replace('{forum_id}', $data['item'][$i]['forum_id'],
                str_replace('{article_id}', $data['item'][$i]['id'], $edit_article_url))
            . '"><button>Edit</button></a>';
    }
    if ($this->auth->isLoggedIn() && $this->auth->user()->id == $data['item'][$i]['writer_id']['id']) {
        echo '<a href="'
            . str_replace('{forum_id}', $data['item'][$i]['forum_id'],
                str_replace('{article_id}', $data['item'][$i]['id'], $delete_article_url))
            . '"><button>Delete</button></a>';
    }
    echo "</td>
    </tr>
</table>
";
}
?>
<?php
echo '<a href="' . site_url("forum") . '"><button>Back</button></a >'
?>
</body>
</html>
