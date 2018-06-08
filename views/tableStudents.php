<?php if(consult_isStart()):?>
    <div class="title">
        <div class="info">
            <div class="date"></div>
            <div class="time"></div>
        </div>
        <div class="add-consultation" >
            <a id="#" href="#"><i class="fa fa-plus addStudent" aria-hidden="true"></i></a>
        </div>
    </div>
    <div class="consultation-table">
        <table>
            <thead>
            <tr>
                <th class="name">Студент</th>
                <th class="group">Группа</th>
                <th class="option">Опции</th>
            </tr>
            </thead>
            <tbody id="table-students">
            <?php foreach ($students as $student):?>
                <tr id="<?=$student['id']?>">
                    <td><?=$student['info']?></td>
                    <td><?=$student['group']?></td>
                    <td class="option btn-close"><a href="#" data-id="<?=$student['id']?>" class="removeStudent"><i class="fa fa-times" aria-hidden="true"></i></a></td>
                </tr>
            <?php endforeach;?>
            <tr>
                <td></td>
                <td></td>
                <td><input type="button" class="button" id="end-consult" value="Завершить"></td>
            </tr>
            </tbody>
        </table>
    </div>
    <script src="/content/js/admin.js"></script>
    <script>
        admin.init();
        admin.modalConfirmDeleteStudent.init();
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
                else
                    window.location.href = "/admin"

            });
        });
    </script>
<?php endif;?>