<div class="title">
    <div class="info">
        <div class="date"></div>
        <div class="time"></div>
    </div>
    <div class="add-consultation" >
        <a id="#" href="#"><i class="fa fa-plus" aria-hidden="true" data-modal-open="addStudent"></i></a>
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
            <?=$table_students?>
        </tbody>
        <tfoot>
            <tr>
                <td></td>
                <td></td>
                <td><input type="button" class="button" id="end-consult" value="Завершить"></td>
            </tr>
        </tfoot>
    </table>
</div>
<script src="/content/js/admin.js"></script>
<script>
    modal.init();
    tabs.init();
    admin.init();
    // /**
    //  * Скрытие и появление выбора групы
    //  */
    // document.getElementById("check-addNewGroup").addEventListener("click",function (e) {
    //     let groupList = document.getElementById("groups-add-stud");
    //     let groupInput = document.getElementById("group-name");
    //     if(e.target.checked){
    //         groupList.style.display = "none";
    //         groupInput.style.display = "block";
    //         return false;
    //     }
    //     groupList.style.display = "block";
    //     groupInput.style.display = "none";
    // });
    //
    // document.getElementById("addNewStudent").addEventListener("click", function () {
    //     let checkGroup = document.getElementById("check-addNewGroup");
    //     let group = document.getElementById("groups-add-stud").value;
    //     let info = document.getElementById("info-user").value;
    //     if(checkGroup.checked)
    //         group = document.getElementById("group-name").value;
    //
    //     AJAX.post("/admin/addStudentInConsultAndJson",{group:group,info:info},function (text) {
    //         text = JSON.parse(text);
    //         if(text.status == '1') {
    //             modal.close(document.getElementById("addStudent"));
    //             AJAX.post("/admin/consult",[],function (text) {
    //                 document.querySelector(".content").innerHTML=text;
    //             });
    //             return false;
    //         }
    //         alert(text.error);
    //     });
    // });
    // page.printDate(document.querySelector(".date"));
    // page.printTime(document.querySelector(".time"));
    //
    // //Открытие модального окна подтверждения удаления студента из консультации
    // document.addEventListener("click", function (e) {
    //     if(!e.target.matches("a[data-id].removeStudent i")) return false;
    //     let modalConfirm = document.getElementById("confirm");
    //     if(modalConfirm === undefined) return false;
    //     let id = e.target.parentNode.getAttribute("data-id");
    //     modalConfirm.querySelector("#confirm-yes").setAttribute("data-id",id);
    //     modal.open(modalConfirm, "Удалить студента "+id+" из консультации?");
    // });
    // //Удаление студента
    // document.getElementById("confirm-yes").addEventListener("click", function (e) {
    //     let id = e.target.getAttribute("data-id");
    //     let modalElem = document.getElementById("confirm");
    //     AJAX.post("/admin/deleteStudentFromConsult",{id:id},function (text) {
    //         text = JSON.parse(text);
    //         if(text.status == 1) {
    //             let tr = document.getElementById(id);
    //             tr.style.display = "none";
    //             modal.close(modalElem)
    //         }
    //         else{
    //             modal.close(modalElem);
    //             modal.open(document.getElementById("error"),"Ошибка удаления студента "+text.id)
    //         }
    //     })
    // });
    // //Завершение консультации
    // document.getElementById("end-consult").addEventListener("click",function () {
    //     AJAX.post("/admin/endConsult",[],function (text) {
    //         text = JSON.parse(text);
    //         if(text.status == 1)
    //             window.location.href = '/admin/';
    //         else
    //             modal.open(document.getElementById("error"),"Ошибка завершения косультации");
    //     })
    // });
</script>