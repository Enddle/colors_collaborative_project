
function draw_circle(context) {

    context.beginPath();
    context.arc(256, 256, 255, 0, 2 * Math.PI);
    context.lineWidth = 1;
    context.strokeStyle = 'white';
    context.stroke();
}

function draw_circle_c(x, y, r, line = 1, color = "white", context) {

    context.beginPath();
    context.arc(x, y, r, 0, 2 * Math.PI);
    context.lineWidth = line;
    context.strokeStyle = color;
    context.stroke();
}

function draw_line(x, y, tox, toy, line = 1, color = "white", context) {

    context.beginPath();
    context.moveTo(x, y);
    context.lineTo(tox, toy);
    context.lineWidth = line;
    context.strokeStyle = color;
    context.stroke();
}

function draw_axis() {

    context.beginPath();
    context.lineWidth = 1;
    context.strokeStyle = 'white';

    context.moveTo(256, 0);
    context.lineTo(256, 256);
    context.stroke();

    context.moveTo(256, 256);
    context.lineTo(35.2, 383.5);
    context.stroke();

    context.moveTo(256, 256);
    context.lineTo(476.8, 383.5);
    context.stroke();
}

function clear_canvas(cont) {

    cont.clearRect(0, 0, canvas.width, canvas.height);
}
