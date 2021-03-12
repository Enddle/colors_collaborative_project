<!DOCTYPE html>

<html>
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link rel="stylesheet" href="style.css">
    <title>View Result - Colors</title>
</head>
<body>

    <?php

    // Functions

    function data2array($data, $n) {

        $data_length = 7;

        $a = $data_length * $n;

        return array(
            hexdec(substr($data, $a + 1, 2)),
            hexdec(substr($data, $a + 3, 2)),
            hexdec(substr($data, $a + 5, 2))
        );
    }

    function arrays_sum($prev, $add) {

        for ($i = 0; $i < 3; $i++) {

            $temp[$i] = (int) ($prev[$i] + $add[$i]);
        }
        return $temp;
    }

    function arrays_average($sum, $n) {

        for ($i = 0; $i < 3; $i++) {

            $temp[$i] = (int) ($sum[$i] / $n);
        }
        return $temp;
    }

    function array2hex($array) {

        for ($i = 0; $i < 3; $i++) {

            $t = dechex($array[$i]);

            $temp[$i] = strlen($t) == 1 ? "0".$t : $t;
        }

        // return sprintf('#%02x%02x%02x', $temp[0], $temp[1], $temp[2]);

        return "#". $temp[0]. $temp[1]. $temp[2];
    }


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
        This is a collaborative project about favorite colors, final results are the calculated average of every color chosen by the participants.<br><br>

        Colors are recorded in Hex color code, then converted into integers for the average calculation. The decimal values are converted back to Hex code and presented visually on this page.<br><br>

        Every entry has been saved on our server without including <b>ANY</b> personal information. Collected data will not be deleted and might be used in future projects only for research purposes.<br>

        <i class="right">
            Jianhao Zheng<br>
            March 11, 2021
        </i>
    </p>

</body>

</html>
