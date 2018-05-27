<?php if(auth_is_auth()) header("Location:/admin")?>
<div class="form entry" >
    <div class="enter">ВХОД</div>
    <div class="add" >
        <a href="/" style="color: #45805e">Вход</a>
        <a href="/register" style="color: #45805e">Регистрация</a>
        <input type="text" placeholder="LOGIN..." style="margin-bottom: 10px">
        <input type="password" placeholder="PASSWORD...">
        <input class="submit button" type="submit" value="Entry">
    </div>
</div>