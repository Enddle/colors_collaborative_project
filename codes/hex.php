<?php

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

?>
