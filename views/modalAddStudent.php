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
                <option value="null" selected disabled>Выберите группу</option>
            </select>
            <select name="students" id="students">
                <option value="null" selected disabled>Выберите студента</option>
            </select>
        </div>
        <div class="footer-tab">
            <a href="#" id="sendStudent" class="button">Добавить</a>
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
                <option value="null" selected disabled>Выберите группу</option>
            </select>
            <input type="text" id="group-name" name="addNewGroup" style="display: none" placeholder="Название новой группы">
            <input type="text" id="info-user" name="addNewGroup" placeholder="Фамилия Имя">
        </div>
        <div class="footer-tab">
            <a id="addNewStudent" href="#" class="button">Добавить</a>
        </div>
    </div>
</div>