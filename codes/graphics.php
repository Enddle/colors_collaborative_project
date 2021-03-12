<?php
function showCanvas($view) {
    if ($view == "single") {
        echo "
        <div class='canvas-container'>\n

            <canvas id='canvas' width='512' height='512'></canvas>
            <button class='next' onclick='next();'>➔</button>
        </div>

        <small id='caption'></small>

        <button onclick='window.location.href = \"?#canvas1\";'>Overview</button>";

    } else {
        echo "
        <div class='canvas-container'>

            <canvas id='canvas1' width='256' height='256'></canvas>
            <canvas id='canvas2' width='256' height='256'></canvas>
            <canvas id='canvas3' width='256' height='256'></canvas>
            <canvas id='canvas4' width='256' height='256'></canvas>
        </div>

        <button onclick='window.location.href = \"?detail#canvas\";'>Detail</button>";
    }
}

function drawOnCanvas($view) {
    if ($view == "single") {
        echo "
        var canvas = document.getElementById('canvas');
        var context = canvas.getContext('2d');

        var n = 0;
        var captionText = document.getElementById('caption');

        next();

        function next() {

            clear_canvas(context);

            switch (n) {
                case 0:
                case 4:
                    n = 0;
                    draw_color(context);
                    captionText.innerHTML = 'favourite color';
                    break;
                case 1:
                    draw_red(context);
                    captionText.innerHTML = 'favourite red';
                    break;
                case 2:
                    draw_green(context);
                    captionText.innerHTML = 'favourite green';
                    break;
                case 3:
                    draw_blue(context);
                    captionText.innerHTML = 'favourite blue';
                    break;
            }
            n++;
        }
        ";

    } else {
        echo "
        var canvas1 = document.getElementById('canvas1');
        var context1 = canvas1.getContext('2d');

        var canvas2 = document.getElementById('canvas2');
        var context2 = canvas2.getContext('2d');

        var canvas3 = document.getElementById('canvas3');
        var context3 = canvas3.getContext('2d');

        var canvas4 = document.getElementById('canvas4');
        var context4 = canvas4.getContext('2d');

        draw_color(context1);
        draw_red(context2);
        draw_green(context3);
        draw_blue(context4);
        ";
    }
}

function drawCode($color, $view) {

    $scale = ($view == "single") ? 2 : 4;
    $canvas_size = ($view == "single") ? 512 : 256;
    $center = $canvas_size / 2;
    $shift = $canvas_size / 4;

    $line = ($view == "single") ? 3 : 2;
    $c = array2hex($color);

    $have = haveZeros($color);

    if (!$have) {

        $circle = getCircle($color);
        $x = $circle[0] / $scale + $shift;
        $y = $circle[1] / $scale + $shift;
        $r = $circle[2] / $scale;
        // $r = 5;

        return "\tdraw_circle_c($x, $y, $r, $line, '$c', cont);\n";
    }

    $pos = getArrayPositions($color);

    switch ($have) {
        case -1:
            return "\tdraw_circle_c($center, $center, 1.5, $line, '$c', cont);\n";
        case 1:
        case 2:
        case 3:
            $tox = $pos[$have - 1][0] / $scale + $shift;
            $toy = $pos[$have - 1][1] / $scale + $shift;
            return "\tdraw_line($center, $center, $tox, $toy, $line, '$c', cont);\n";
        default:
            return;
    }
}
?>
