<?php session_start(); ?>
<script>
    var subd1 = JSON.parse('<?php echo json_encode($_SESSION['subd1']) ?>');
    console.log(subd1);
</script>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
</head>
<body>
<?php echo array_sum($_SESSION['subd1']['a']) ?>
</body>
</html>