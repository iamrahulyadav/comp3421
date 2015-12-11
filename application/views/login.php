<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Registration and Attendance Managing Application</title>
</head>
<body>
<form method="post">
    Email: <input name="email" type="email" required/><br/>
    Password: <input name="pw" type="password"/><br/>
    <input type="submit" value="Log In"/>
</form>
<?php if (isset($err)) echo '<script>alert(' . json_encode($err) . ');</script>' ?>
</body>
</html>