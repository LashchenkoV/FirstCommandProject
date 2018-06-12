<div class="modal modal-error" id="error">
    <div class="tab">
        <div>
            <a class="button" href="#">Ошибка!</a>
        </div>
        <div class="btn-close">
            <a href="#"><i  data-modal-close="error" class="fa fa-window-close" aria-hidden="true"></i></a>
        </div>
    </div>
    <p class="modal-text"></p>
</div>
<div class="modal modal-confirm" id="info">
    <div class="tab">
        <div>
            <a class="button" href="#">Консультация завершена</a>
        </div>
        <div class="btn-close">
            <a href="#"><i class="fa fa-window-close endConsultOk" aria-hidden="true"></i></a>
        </div>
    </div>
    <p class="modal-text"></p>
    <div class="buttons">
        <a href="#" class="button endConsultOk">Ок</a>
    </div>
</div>
<div class="modal modal-confirm" id="confirm">
    <div class="tab">
        <div>
            <a class="button" href="#">Подтвердите:</a>
        </div>
    </div>
    <p class="modal-text"></p>
    <div class="buttons">
        <a href="#" class="button" id="confirm-yes" data-id="">Да</a>
        <a href="#" class="button red" data-modal-close="confirm">Нет</a>
    </div>
</div>
<div class="nav">
    <ul id="navigation" class="left-menu">
        <li class="selected">
            <a href="/admin">
                <i class="fa fa-address-card-o" aria-hidden="true"></i>
                Добавить
            </a>
        </li>
        <li>
            <a href="/admin/list">
                <i class="fa fa-list" aria-hidden="true"></i>
                Список
            </a>
        </li>
        <li>
            <a href="/logout">
                <i class="fa fa-sign-out" aria-hidden="true"></i>
                Выход
            </a>
        </li>
    </ul>
</div>
<div class="modal" id = "addStudent"></div>
<div class="content">
    <?=$content?>
</div>
