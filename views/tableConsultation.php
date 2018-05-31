<?php if(consult_is_start()):?>
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
            <?php foreach ($activeStudents as $student):?>
                <tr>
                    <td><?=$student['info']?></td>
                    <td><?=$student['group']?></td>
                    <td class="option btn-close"><a href="#"><i class="fa fa-times" aria-hidden="true" data-modal-open="confirm"></i></a></td>
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
<?php else:?>
    <div class="title">
        <div class="info">
            <div class="date">25.03.2018</div>
            <div class="time">12:15</div>
        </div>
        <div class="add-consultation" >
            <input id="startConsult" type="button" class="button" value="Начать консультацию">
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