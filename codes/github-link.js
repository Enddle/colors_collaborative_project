
var html = `
<style>
    .github-footer {
        position: relative;
        /* bottom: 0; */
        /* right: 0; */
        float: right;
        padding: 5px 10px;
        font-family: monospace;
        cursor: pointer;
    }
</style>

<div onclick="window.location.href = 'https://github.com/Enddle/colors_collaborative_project';" class="github-footer">Enddle &copy; 2021 <i class="bi bi-github"></i></div>
`;

$("body").append(html);
