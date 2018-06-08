<?php if(!auth_is_auth()) header("Location:/")?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title><?=$title?></title>
    <link rel="stylesheet" href="/content/css/font-awesome.min.css">
    <link rel="stylesheet" href="/content/css/main.css">
    <script type="text/javascript" src="/content/js/ajax.js"></script>
    <script type="text/javascript" src="/content/js/script.js"></script>
    <script type="text/javascript" src="/content/js/modal.js"></script>
    <script type="text/javascript" src="/content/js/tabs.js"></script>
    <script type="text/javascript" src="/content/js/handlePagination.js"></script>
</head>
<body>
<div id="bg-layer"></div>
<div id="content">
    <?=$content?>
</div>
</body>
</html>