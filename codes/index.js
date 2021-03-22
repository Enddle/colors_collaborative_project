
var colorPicker = new iro.ColorPicker('#picker', {
    // Set the size of the color picker
    width: 280,
    // Set the initial color to pure red
    color: "#fff"
});

$("ball span").hide();
$(".color-background.transition").hide();

var current = 0;
var title_pre = "Choose your favourite ";
var title_color = ["color", "<b style='color: red'>red</b>", "<b style='color: green'>green</b>", "<b style='color: blue'>blue</b>"];
var title_submit = "Make changes or Submit now";

var icons = ["bi-arrow-right-short", "bi-check"];

$("ball").click(function() {
    set = $(this).attr("data-set");
    if (set == null) return;
    setCurrent($(this).attr("data-set"));
});

function setCurrent(n) {

    current = parseInt(n);

    if (n >= 4) {
        $("h1.title").html(title_submit);
        $("ball .bi").removeClass(icons[0]);
        $("ball .bi").addClass(icons[1]);
        return;
    }

    $("ball .bi").removeClass(icons[1]);
    $("ball .bi").addClass(icons[0]);

    $("h1.title").html(title_pre + title_color[n]);

    colorPicker.color.hexString = $("input[type=color]")[current].value;
}

function getColor() {

    if (current >= 4) {
        $("input[type=submit]").click();
    }

    var hex = colorPicker.color.hexString;

    $("input[type=color]")[current].value = hex;

    colorTransition($("ball span").eq(current), $("ball").eq(current), hex);

    if (current == 0) {
        colorTransition($(".color-background.transition"), $(".color-background.custom"), hex, 5000);
    }

    setCurrent(current + 1);
}

function colorTransition(transitionLayer, backgroundLayer, colorHex, inSpeed = 400, outSpeed = 0) {

    outSpeed = inSpeed;

    transitionLayer.css("background", colorHex);
    transitionLayer.fadeIn(inSpeed, function() {
        backgroundLayer.css("background", colorHex);
        $(this).fadeOut(outSpeed);
    });
}
