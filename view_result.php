<!DOCTYPE html>

<html>
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>View Result - Colors</title>

    <link rel="Shortcut Icon" href="favicon.ico">

    <!-- jquery -->
    <script src="https://cdn.jsdelivr.net/npm/jquery@3.6.0/dist/jquery.min.js"></script>

    <!-- bootstrap v5.0 -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.0-beta2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-BmbxuPwQa2lc/FVzBcNJ7UAyJxM6wuqIj61tLrc4wSX0szH/Ev+nYRRuWlolflfl" crossorigin="anonymous">
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.0-beta2/dist/js/bootstrap.bundle.min.js" integrity="sha384-b5kHyXgcpbZJO/tY9Ul7kGkf1S0CWuKcCD38l8YkeH8z8QjE0GmW1gYU5S9FOnJ0" crossorigin="anonymous"></script>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.4.0/font/bootstrap-icons.css">

    <!-- custom styles -->
    <link rel="stylesheet" href="style.css">

    <script src="codes/graphics.js" charset="utf-8"></script>
</head>
<body>
    <script type="text/javascript">
    <?php

    include_once("codes/hex.php");
    include_once("codes/circles.php");
    include_once("codes/graphics.php");

    $draw_color = "function draw_color(cont) {\n";
    $draw_red   = "function draw_red(cont)   {\n";
    $draw_green = "function draw_green(cont) {\n";
    $draw_blue  = "function draw_blue(cont)  {\n";

    // READ FILE STARTS HERE

    $file = fopen("data.txt","r");

    $data = fgets($file);
    $count = 1;

    $color = data2array($data, 0);
    $red   = data2array($data, 1);
    $green = data2array($data, 2);
    $blue  = data2array($data, 3);

    $view = (isset($_GET["detail"])) ? "single" : "multi";

    $draw_color = $draw_color . drawCode($color, $view);
    $draw_red   = $draw_red   . drawCode($red  , $view);
    $draw_green = $draw_green . drawCode($green, $view);
    $draw_blue  = $draw_blue  . drawCode($blue , $view);

    while(! feof($file))  {

        $data = fgets($file);

        if (empty($data)) { break; } // Break out at the last empty line

        $count += 1;

        $draw_color = $draw_color . drawCode(data2array($data, 0), $view);
        $draw_red   = $draw_red   . drawCode(data2array($data, 1), $view);
        $draw_green = $draw_green . drawCode(data2array($data, 2), $view);
        $draw_blue  = $draw_blue  . drawCode(data2array($data, 3), $view);

        $color = arrays_sum($color, data2array($data, 0));
        $red   = arrays_sum($red  , data2array($data, 1));
        $green = arrays_sum($green, data2array($data, 2));
        $blue  = arrays_sum($blue , data2array($data, 3));
    }

    echo "$draw_color }\n\n $draw_red }\n\n $draw_green }\n\n $draw_blue }\n\n";

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
    </script>

    <p>Colors by <?=$count?> people:</p>

    <ball style="background: <?=$color?>"></ball>
    <ball style="background: <?=$red  ?>"></ball>
    <ball style="background: <?=$green?>"></ball>
    <ball style="background: <?=$blue ?>"></ball>

    <p class="t">
        This is a collaborative project about favorite colors, these results are the calculated average of every color chosen by the participants. Colors are recorded in Hex color code, converted into decimal integers for calculation, and converted back to Hex code.
    </p>

    <?php showCanvas($view); ?>

    <p class="t">
        This visualization of results is designed to represent each entry on the same chart. The circular chart has three axes – Red, Green, Blue – set on its 0°, 120°, and 240° angles. By positioning the decimal values (0~255) on each axis, every color will have 3 corresponding coordinates on this 2D canvas, which are connected by a circle. Pure R/G/B colors with two 0 values are represented by line segments on the axes; and black is shown as a dot in the center.

        <span class="fig-container">
            <img src="img/2.png" width="200px" alt="color chart">
            <img src="img/1.png" width="200px" alt="color on chart">
        </span>

        Figures above show an intuitive representation of the chart and how a color is placed on the chart.
    </p>

    <p>
        <button type="button" class="btn btn-secondary" onclick="window.location.href = './';">Survey Page</button>
    </p>

    <p class="t">
        <b>PRIVACY</b>
        <br><br>

        Every entry has been saved on our server without including <b>ANY</b> personal information. Collected data will not be deleted and might be used in future projects only for research purposes.
        <br>

        <i class="right">
            Jianhao Zheng<br>
            March 11, 2021<br><br>
        </i>
    </p>

    <script type="text/javascript">

    <?php drawOnCanvas($view); ?>

    </script>

    <!-- tooltips -->
    <script src="codes/color-tooltips.js" charset="utf-8"></script>
</body>

</html>
