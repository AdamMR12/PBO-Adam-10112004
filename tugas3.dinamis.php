<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
</head>
<body>
    <!-- <form action="" method="post">
        <select name="jensu1" id="">
            <option value="c" name="c">celcius</option>
            <option value="f" name="f">fahrenheit</option>
        </select>
        <input type="number" name="suhu1">

        <select name="jensu2" id="">
            <option value="c" name="c">celcius</option>
            <option value="f" name="f">fahrenheit</option>
        </select>
        <input type="number" name="suhu2" value="<?php echo $s2; ?>">
        <input type="submit" name="submit">
    </form>
        $s1 = $_POST["suhu1"];
        $j1 = $_POST["jensu1"];
        $j2 = $_POST["jensu2"];
        
        if ($j1 == "c") {
            switch($j2){
                case "f":
                    $s2 = (9/5*$s1)+32;
                break;
            }
        }elseif($j1 == "f"){
            switch($j2){
                case "c":
                    $s2 = 5/9*($s1-32);
                break;
            }
        }
    ?> -->
<?php
    $s2 = '';

    if(isset($_POST['submit'])) {
        $s1 = $_POST["suhu1"];
        $j1 = $_POST["jensu1"];
        $j2 = $_POST["jensu2"];
        //section celcius
        if ($j1 == "c" && $j2 == "f") {
            $s2 = (9/5 * $s1) + 32;
            
        }if ($j1 == "c" && $j2 == "r") {
            $s2 = (4/5)*$s1;
            
        }if ($j1 == "c" && $j2 == "k") {
            $s2 = $s1 + 273.15;
           
        }if ($j1 == "c" && $j2 == "ra") {
            $s2 = ($s1 + 273.15)*9/5;
           
        }

        // section fahrenheit
        elseif ($j1 == "f" && $j2 == "c") {
            $s2 = (5/9) * ($s1 - 32);
            
        }elseif ($j1 == "f" && $j2 == "k") {
            $s2 = ($s1 + 459.67)*5/9;
            
        }elseif ($j1 == "f" && $j2 == "r") {
            $s2 = 4/9*($s1 - 32);
            
        }elseif ($j1 == "f" && $j2 == "ra") {
            $s2 = $s1 + 459.67;
            
        }

        //section kelvin
        elseif ($j1 == "k" && $j2 == "c") {
            $s2 = $s1 - 273.15;
            
        }elseif ($j1 == "k" && $j2 == "f") {
            $s2 = ($s1 * 9/5) - 459.67;
            
        }elseif ($j1 == "k" && $j2 == "r") {
            $s2 = 4/5*($s1 - 273);
            
        }elseif ($j1 == "k" && $j2 == "ra") {
            $s2 = $s1 * 9/5;
            
        }

        //section reamur
        elseif ($j1 == "r" && $j2 == "c") {
            $s2 = $s1/0.8;
           
        }elseif ($j1 == "r" && $j2 == "f") {
            $s2 = ($s1 * 2.25) + 32;
            
        }elseif ($j1 == "r" && $j2 == "k") {
            $s2 = ($s1 / 0.8) + 273.15;
            
        }elseif ($j1 == "r" && $j2 == "ra") {
            $s2 = ($s1 / 0.8)+491.67;
            
        }
        
        //section rankine
        elseif ($j1 == "ra" && $j2 == "c") {
            $s2 = ($s1 - 491.67)*5/9;
            
        }elseif ($j1 == "ra" && $j2 == "f") {
            $s2 = $s1 - 459.67;
            
        }elseif ($j1 == "ra" && $j2 == "k") {
            $s2 = $si * 5/9;
            
        }elseif ($j1 == "ra" && $j2 == "r") {
            $s2 = ($s1 / 1.8 + 273.15) * 0.8;
            
        } elseif ($j1 == $j2) {
            $s2 = $s1;
            
        }
    }
?>

<form action="" method="post">
    <select name="jensu1" id="">
        <option value="c"<?php if($j1 == 'c') echo 'selected'; ?>>celcius</option>
        <option value="f"<?php if($j1 == 'f') echo 'selected'; ?>>fahrenheit</option>
        <option value="k"<?php if($j1 == 'k') echo 'selected'; ?>>>kelvin</option>
        <option value="r"<?php if($j1 == 'r') echo 'selected'; ?>>reamur</option>
        <option value="ra"<?php if($j1 == 'ra') echo 'selected'; ?>>rankine</option>
    </select>
    <input type="number" name="suhu1" step="any" value="<?php echo isset($s1) ? $s1 : ''; ?>">

    <select name="jensu2" id="">
        <option value="c"<?php if($j2 == 'c') echo 'selected'; ?>>celcius</option>
        <option value="f"<?php if($j2 == 'f') echo 'selected'; ?>>fahrenheit</option>
        <option value="k"<?php if($j2 == 'k') echo 'selected'; ?>>kelvin</option>
        <option value="r"<?php if($j2 == 'r') echo 'selected'; ?>>reamur</option>
        <option value="ra"<?php if($j2 == 'ra') echo 'selected'; ?>>rankine</option>
    </select>
    <input type="number" name="suhu2" step="any" value="<?php echo $s2; ?>">
    <input type="submit" name="submit">
</form>
</body>
</html>