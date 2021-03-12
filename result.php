<!DOCTYPE html>

<?php

if (!isset($_POST["color"])) {

    echo "<script>window.location.href = 'view_result.php';</script>";
    exit();
}

$file = fopen("data.txt", "a") or die("Unable to open file!");

$txt = $_POST["color"].$_POST["red"].$_POST["green"].$_POST["blue"]."\n";
fwrite($file, $txt);

fclose($file);

?>

<html>
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Your Choices - Colors</title>

    <link rel="Shortcut Icon" href="favicon.ico">
    <link rel="stylesheet" href="style.css">
</head>
<body>
    <img src="img/2.png" alt="colors" style="display:none;">

    <p>Your choices:</p>

    <ball style="background: <?php echo $_POST["color"]; ?>"></ball>
    <ball style="background: <?php echo $_POST["red"]; ?>"></ball>
    <ball style="background: <?php echo $_POST["green"]; ?>"></ball>
    <ball style="background: <?php echo $_POST["blue"]; ?>"></ball>

    <?php

    include_once("codes/hex.php");

    // READ FILE STARTS HERE

    $file = fopen("data.txt","r");

    $data = fgets($file);
    $count = 1;

    $color = data2array($data, 0);
    $red   = data2array($data, 1);
    $green = data2array($data, 2);
    $blue  = data2array($data, 3);

    while(! feof($file))  {

        $data = fgets($file);

        if (empty($data)) { break; } // Break out at the last empty line

        $count += 1;

        $color = arrays_sum($color, data2array($data, 0));
        $red   = arrays_sum($red  , data2array($data, 1));
        $green = arrays_sum($green, data2array($data, 2));
        $blue  = arrays_sum($blue , data2array($data, 3));
    }

    fclose($file);

    $color = arrays_average($color, $count);
    $red   = arrays_average($red  , $count);
    $green = arrays_average($green, $count);
    $blue  = arrays_average($blue , $count);

    $color = array2hex($color);
    $red   = array2hex($red  );
    $green = array2hex($green);
    $blue  = array2hex($blue );

    ?>

    <p>Colors by <?=$count?> people:</p>

    <ball style="background: <?=$color?>"></ball>
    <ball style="background: <?=$red  ?>"></ball>
    <ball style="background: <?=$green?>"></ball>
    <ball style="background: <?=$blue ?>"></ball>

    <p>
        <button onclick="window.location.href = 'view_result.php';">Result Page</button>
    </p>

</body>

</html>