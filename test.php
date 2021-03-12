<!DOCTYPE html>

<html>
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link rel="stylesheet" href="style.css">
    <title>Colors</title>
    <script src="codes/graphics.js" charset="utf-8"></script>
</head>
<body>

    <canvas id="canvas" width="512" height="512"></canvas>
    <br><br>

    <input id="rr" type="number" value="180" onchange="input_change(value, 'r');">
    <input id="gg" type="number" value="180" onchange="input_change(value, 'g');">
    <input id="bb" type="number" value="180" onchange="input_change(value, 'b');">
    <input type="button" value="calculate" onclick="calculate();">


    <script>

    var canvas = document.getElementById('canvas');
    var context = canvas.getContext('2d');

    draw_circle(context);

    // context.fillRect(256, 256, 1, 1);

    // draw_axis(context);

    function gety(n, t) {

        if (t == "r")
            return 256 - n;

        if (t == "g")
            return 256 + n / 2;

        if (t == "b")
            return 256 + n / 2;
    }

    function getx(n, t) {

        if (t == "r")
            return 256

        if (t == "g")
            return (256 - Math.sqrt(3).toFixed(3) * (n / 2)).toFixed(1);

        if (t == "b")
            return (256 + Math.sqrt(3).toFixed(3) * (n / 2)).toFixed(1);
    }

    function input_change(n, t) {

        var x = getx(n, t);
        var y = gety(n, t);

        // context.fillRect(x, y, 1, 1);
        // console.log("draw point on (" + x + ", " + y + ").");
    }

    function not_zero(a, b, c) {

        return a != 0 ? 1 : b != 0 ? 2 : c != 0 ? 3 : -1;
    }

    function calculate() {

        var rr = document.getElementById("rr").value;
        var gg = document.getElementById("gg").value;
        var bb = document.getElementById("bb").value;


        console.log("is 0: " + (((rr * gg) + (gg * bb) + (rr * bb)) == 0));
        if (((rr * gg) + (gg * bb) + (rr * bb)) == 0) {

            var not = not_zero(rr, gg, bb);
            if (not == -1) {

                context.beginPath();
                context.arc(256, 256, 1, 0, 2 * Math.PI);
                context.lineWidth = 2;
                context.strokeStyle = 'black';
                context.stroke();
                return;
            }

            var xx, yy;

            switch (not) {
                case 1:
                    xx = getx(rr, "r");
                    yy = gety(rr, "r");
                    break;
                case 2:
                    xx = getx(gg, "g");
                    yy = gety(gg, "g");
                    break;
                case 3:
                    xx = getx(bb, "b");
                    yy = gety(bb, "b");
                    break;
                default:
            }

            context.beginPath();
            context.lineWidth = 2;
            context.moveTo(256, 256);
            context.lineTo(xx, yy);
            context.stroke();

            return;
        }

        var x1 = getx(rr, "r"); // 256
        var y1 = gety(rr, "r");
        var x2 = getx(gg, "g");
        var y2 = gety(gg, "g");
        var x3 = getx(bb, "b");
        var y3 = gety(bb, "b");

        // console.log("x1 "+ x1 + " y1 " + y1);
        // console.log("x2 "+ x2 + " y2 " + y2);
        // console.log("x3 "+ x3 + " y3 " + y3);

        var xc = ((y2-y1)*(y3*y3-y1*y1+x3*x3-x1*x1)-(y3-y1)*(y2*y2-y1*y1+x2*x2-x1*x1))/(2.0*((x3-x1)*(y2-y1)-(x2-x1)*(y3-y1)));
        xc = xc.toFixed(1);

        var yc = ((x2-x1)*(x3*x3-x1*x1+y3*y3-y1*y1)-(x3-x1)*(x2*x2-x1*x1+y2*y2-y1*y1))/(2.0*((y3-y1)*(x2-x1)-(y2-y1)*(x3-x1)));
        yc = yc.toFixed(1);

        var rc = Math.sqrt( Math.pow((x1 - xc), 2) + Math.pow((y1 - yc), 2) );
        rc = rc.toFixed(1);

        context.beginPath();
        context.arc(xc, yc, rc, 0, 2 * Math.PI);
        context.stroke();
        console.log("draw circle on (" + xc + ", " + yc + ") with a radius of " + rc + ".");
    }

    </script>
</body>
</html>
