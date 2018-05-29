<?php if(auth_is_auth()) header("Location:/admin")?>
<!doctype html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport"
          content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title><?=$title?></title>
    <link rel="stylesheet" href="/content/css/font-awesome.min.css">
    <link rel="stylesheet" href="/content/css/main.css">
    <script type="text/javascript" src="/content/js/script.js"></script>
    <script type="text/javascript" src="/content/js/ajax.js"></script>
    <script type="text/javascript" src="/content/js/register.js"></script>
    <script type="text/javascript" src="/content/js/entry.js"></script>
    <script type="text/javascript" src="/content/js/modal.js"></script>
</head>
<body>
<div id="bg-layer"></div>
<div class="modal modal-error" id="error">
    <div class="tab">
        <div>
            <a class="button" href="#">Ошибка!</a>
        </div>
        <div class="btn-close">
            <a href="#"><i  data-modal-close="error" class="fa fa-window-close" aria-hidden="true"></i></a>
        </div>
    </div>
    <p id="modal-text"></p>
</div>
    <?=$content?>
<script>
    modal.init();
</script>
</body>
</html>
