<div class="modal modal-error" id="error">
    <div class="tab">
        <div>
            <a class="button" href="#">Ошибка!</a>
        </div>
        <div class="btn-close">
            <a href="#"><i  data-modal-close="error" class="fa fa-window-close" aria-hidden="true"></i></a>
        </div>
    </div>
    <p id="modal-text">Текст ошибки: Lorem ipsum dolor sit amet, consectetur adipisicing elit.</p>
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
<?php if(consult_is_start()):?>
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
                        <option value="one">ЕК-2344</option>
                        <option value="one">ЕК-2344</option>
                        <option value="one">ЕК-2344</option>
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
    <div class="content">
        <div class="title">
            <div class="info">
                <div class="date">25.03.2018</div>
                <div class="time">12:15</div>
            </div>
            <div class="add-consultation" >
                <a id="#" href="#"><i class="fa fa-plus" aria-hidden="true" data-modal-open="addStudent"></i></a>
            </div>
        </div>
        <div class="consultation-table">
            <table>
                <tr>
                    <th class="name">Студент</th>
                    <th class="group">Группа</th>
                    <th class="option">Опции</th>
                </tr>
                <?php foreach ($students as $student):?>
                 <tr>
                     <td><?=$student["info"]?></td>
                     <td><?=$student["group"]?></td>
                     <td class="option btn-close"><a href="#"><i class="fa fa-times" aria-hidden="true" data-modal-open="confirm" data-id = "<?=$student["id"]?>"></i></a></td>
                 </tr>

                <?php endforeach;?>
                <tr>
                    <td></td>
                    <td></td>
                    <td><input class="button" type="submit" value="Завершить"></td>
                </tr>
            </table>
        </div>
        <script>
            modal.init();
            tabs.init();
            /**
             * Скрытие и появление выбора групы
             */
            document.getElementById("check-addNewGroup").addEventListener("click",function (e) {
                let groupList = document.getElementById("groups-add-stud");
                let groupInput = document.getElementById("group-name");
                if(e.target.checked){
                    groupList.style.display = "none";
                    groupInput.style.display = "block";
                    return false;
                }
                groupList.style.display = "block";
                groupInput.style.display = "none";
            });

            document.getElementById("addNewStudent").addEventListener("click", function () {
                let checkGroup = document.getElementById("check-addNewGroup");
                let group = document.getElementById("groups-add-stud").value;
                let info = document.getElementById("info-user").value;
                if(checkGroup.checked)
                    group = document.getElementById("group-name").value;

                AJAX.post("/admin/addStudentInConsultAndJson",{group:group,info:info},function (text) {
                    text = JSON.parse(text);
                    if(text.status == '1') {
                        modal.close(document.getElementById("addStudent"));
                        AJAX.post("/admin/consult",[],function (text) {
                            document.querySelector(".content").innerHTML=text;
                        });
                        return false;
                    }
                    alert(text.error);
                });
            });
            page.printDate(document.querySelector(".date"));
            page.printTime(document.querySelector(".time"));
        </script>
    </div>
<?php else:?>
    <div class="content">
        <div class="title">
            <div class="info">
                <div class="date">25.03.2018</div>
                <div class="time">12:15</div>
            </div>
            <div class="add-consultation" >
                <input id="startConsult" type="button" class="button" value="Начать консультацию">
            </div>
        </div>
    </div>
    <script>
        modal.init();
        page.printDate(document.querySelector(".date"));
        page.printTime(document.querySelector(".time"));
        document.getElementById("startConsult").addEventListener("click",function () {
            AJAX.post("/admin/start",[],function (text) {
                text = JSON.parse(text);
                if(text.start === '0'){
                    modal.open(document.getElementById("error"), text.error);
                    return false;
                }
                else {
                    window.location.href = "/admin"
                }
            });
        });
    </script>
<?php endif;?>
