
function RGB2Color(r,g,b) {
    return '#' + this.byte2Hex(r) + this.byte2Hex(g) + this.byte2Hex(b);
}

function byte2Hex (n) {
    var nybHexString = "0123456789ABCDEF";
    return String(nybHexString.substr((n >> 4) & 0x0F,1)) + nybHexString.substr(n & 0x0F,1);
}

// Add tooltip texts

$("ball").each(function() {
    var c = $(this).attr("style").split(": ")[1];
    $(this).attr({"data-bs-toggle": "tooltip", "data-bs-placement": "bottom", "title": c });
});

// Enable tooltips

var tooltipTriggerList = [].slice.call(document.querySelectorAll('[data-bs-toggle="tooltip"]'));
var tooltipList = tooltipTriggerList.map(function (tooltipTriggerEl) {
    return new bootstrap.Tooltip(tooltipTriggerEl);
});

// Copy colors

// $("body").append("<input id='input-copy' style='display: none;' value=''></input>");
//
// $("ball").click(function() {
//     var c = $(this).attr("style").split(": ")[1];
//     var i = document.getElementById("input-copy");
//     i.value = c;
//     i.focus();
//     i.select();
//     document.execCommand("copy");
//
//     console.log(i.value);
// });
