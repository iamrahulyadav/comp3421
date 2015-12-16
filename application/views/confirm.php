<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Confirm Delete?</title>
</head>
<body <?php echo isset($color) ? "style=\"background-color: $color\"" : '' ?>>
<form
    method="<?php echo isset($form['method']) ? $form['method'] : 'post' ?>"
    action="<?php echo isset($form['action']) ? $form['action'] : '' ?>"></form>
<script>
    if (confirm(<?php echo json_encode($msg) ?>)) {
        document.forms[0].submit();
    } else {
        window.location = <?php echo json_encode($cancel_url) ?>;
    }
</script>
</body>
</html>