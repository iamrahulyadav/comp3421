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
        <td>Session ID:</td>
        <td><?php echo $data['id']; ?></td>
    </tr>
    <tr>
        <td>Topic:</td>
        <td><?php echo $data['topic']; ?></td>
    </tr>
    <tr>
        <td>Information:</td>
        <td><?php echo $data['info']; ?></td>
    </tr>
    <tr>
        <td>Start time:</td>
        <td><?php echo $data['start_time']; ?></td>
    </tr>
    <tr>
        <td>End time:</td>
        <td><?php echo $data['end_time']; ?></td>
    </tr>
    <tr>
        <td>Speaker:</td>
        <td><?php echo $data['speaker']->display_name(); ?> <a href="">View detail</a></td>
    </tr>
    <tr class='toggle'>
        <td>Speaker ID:</td>
        <td><?php echo $data['speaker']->id ?></td>
    </tr>
    <tr class='toggle'>
        <td>Title:</td>
        <td><?php echo $data['speaker']->title ?></td>
    </tr>
    <tr class='toggle'>
        <td>First name:</td>
        <td><?php echo $data['speaker']->first_name ?></td>
    </tr>
    <tr class='toggle'>
        <td>Last name:</td>
        <td><?php echo $data['speaker']->last_name ?></td>
    </tr>
    <tr class='toggle'>
        <td>address:</td>
        <td><?php echo $data['speaker']->address ?></td>
    </tr>
    <tr class='toggle'>
        <td>City:</td>
        <td><?php echo $data['speaker']->city ?></td>
    </tr>
    <tr class='toggle'>
        <td>Country:</td>
        <td><?php echo $data['speaker']->country ?></td>
    </tr>
    <tr class='toggle'>
        <td>Attendee type:</td>
        <td><?php echo $data['speaker']->attendee_type ?></td>
    </tr>
    <tr class='toggle'>
        <td>Department:</td>
        <td><?php echo $data['speaker']->department ?></td>
    </tr>
    <tr class='toggle'>
        <td>Company:</td>
        <td><?php echo $data['speaker']->company ?></td>
    </tr>
    <tr class='toggle'>
        <td>E-mail:</td>
        <td><?php echo $data['speaker']->email ?></td>
    </tr>
    <tr class='toggle'>
        <td>Phone number</td>
        <td><?php echo $data['speaker']->phone_number ?></td>
    </tr>
    <tr class='toggle'>
        <td>Fax number:</td>
        <td><?php echo $data['speaker']->fax_number ?></td>
    </tr>
</table>
<br>
<?php
if ($this->auth->isLoggedIn() && $this->auth->user()->is_admin) {
    echo '<a href="' . site_url("sessions") . '/edit/'.$data['id'].'"><button>Edit</button></a>';
    echo '<a href="' . site_url("sessions") . '/delete/'.$data['id'].'"><button>Delete</button></a>';
}
echo '<a href="' . site_url("sessions") . '"><button>Back</button></a >'
?>
<script>
    $(".toggle").hide();
    $("a").click(function () {
        $(".toggle").toggle("slow");
    });
</script>
</body>
</html>