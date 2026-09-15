<?php
session_start();
?>

<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Debug Session</title>
</head>
<body>

<h1>Debug Session</h1>

<pre><?php print_r($_SESSION); ?></pre>

</body>
</html>