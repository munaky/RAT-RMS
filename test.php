<?php 
session_start(); 
include('Database.php');
?>
<script>
    var xxx = JSON.parse('<?php echo json_encode($_SESSION['data']) ?>');
    console.log(xxx);
</script>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
</head>
<body>
    <?php echo str_replace('"', '\\"', json_encode($_SESSION['data']))?>
</body>
</html>