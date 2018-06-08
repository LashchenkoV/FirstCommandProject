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
<div class="modal" id = "addStudent">
    <div class="tab">
        <div>
            <a class="button links" data-tab="select" >Добавить в список</a>
            <a class="button links" data-tab="add">Новый студент</a>
        </div>
        <div class="btn-close">
            <a href="#"><i  data-modal-close="addStudent" class="fa fa-window-close" aria-hidden="true"></i></a>
        </div>
    </div>
    <div id="select" class="tabcontent">
        <div class="info">
            <div class="header-tab">
                <select name="groups" id="groups">
                    <option selected disabled>Выберите группу</option>
                </select>
                <select name="students" id="students">
                    <option selected disabled>Выберите студента</option>
                </select>
            </div>
            <div class="footer-tab">
                <a href="#" id="addNewStudentInConsult" class="button">Добавить</a>
            </div>
        </div>
    </div>
    <div id="add" class="tabcontent">
        <div class="info">
            <div class="header-tab">
                <p>
                    <input type="checkbox" id="check-addNewGroup" name="addNewGroup">
                    <label for="addNewGroup"> Не учитывать выбранную группу</label>
                </p>
                <select name="groups" id="groups-add-stud">
                    <option selected disabled>Выберите группу</option>
                </select>
                <input type="text" id="group-name" name="addNewGroup" style="display: none" placeholder="Название новой группы">
                <input type="text" id="info-user" name="addNewGroup" placeholder="Фамилия Имя">
            </div>
            <div class="footer-tab">
                <a id="addNewStudent" href="#" class="button">Добавить</a>
            </div>
        </div>
    </div>
</div>