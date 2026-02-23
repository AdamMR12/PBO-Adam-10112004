<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Pegadaian</title>
</head>
<body>
    <h1>Pegadaian</h1>
    <form action="" method="post">
        pinjaman:   <pre><input type="number" name="pjm"></pre>
        Bunga:      <pre><input type="number" name="bng"></pre>
        Bulan:      <pre><input type="number" name="bln"></pre>
        jatuh tempo:<pre><input type="number" name="tmp"></pre>
    </form>
    <?php
        if(empty($_POST['pjm']) && empty($_POST['bng']) && empty($_POST['bln']) && empty($_POST['tmp'])){
            echo "input besar dan bunga";
            exit;
        }
        class gadai{
            
        }
    ?>
</body>
</html>