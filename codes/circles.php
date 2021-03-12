<?php
function haveZeros($array) {

    if ((($array[0] * $array[1]) + ($array[1] * $array[2]) + ($array[0] * $array[2])) != 0) {
        return FALSE;
    }

    return ($array[0] != 0) ? 1 :
        (($array[1] != 0) ? 2 :
        (($array[2] != 0) ? 3 : -1));
}

function getCircle($array) {

    $pos = getArrayPositions($array);

    $x1 = $pos[0][0];
    $x2 = $pos[1][0];
    $x3 = $pos[2][0];
    $y1 = $pos[0][1];
    $y2 = $pos[1][1];
    $y3 = $pos[2][1];

    $circleX = (( $y2- $y1)*( $y3* $y3- $y1* $y1+ $x3* $x3- $x1* $x1)-( $y3- $y1)*( $y2* $y2- $y1* $y1+ $x2* $x2- $x1* $x1))/(2.0*(( $x3- $x1)*( $y2- $y1)-( $x2- $x1)*( $y3- $y1)));
    $circleX = round($circleX, 1);

    $circleY = (( $x2- $x1)*( $x3* $x3- $x1* $x1+ $y3* $y3- $y1* $y1)-( $x3- $x1)*( $x2* $x2- $x1* $x1+ $y2* $y2- $y1* $y1))/(2.0*(( $y3- $y1)*( $x2- $x1)-( $y2- $y1)*( $x3- $x1)));
    $circleY = round($circleY, 1);

    $radius = sqrt( pow(($x1 - $circleX),2) + pow(($y1 - $circleY),2) );
    $radius = round($radius, 1);

    return [$circleX, $circleY, $radius];
}

function getArrayPositions($array) {
    return array(
        [getX($array[0], "r"), getY($array[0], "r")],
        [getX($array[1], "g"), getY($array[1], "g")],
        [getX($array[2], "b"), getY($array[2], "b")]
    );
}

function getX($value, $type) {

    switch ($type) {
        case 'r':
            return 256;
        case 'g':
            return round(256 - round(sqrt(3), 3) * $value / 2, 1);
        case 'b':
            return round(256 + round(sqrt(3), 3) * $value / 2, 1);
        default:
            break;
    }
}

function getY($value, $type) {

    switch ($type) {
        case 'r':
            return 256 - $value;
        case 'g':
        case 'b':
            return 256 + $value / 2;
        default:
            break;
    }
}
?>
