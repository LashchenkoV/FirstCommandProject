let admin = {
    init:function () {
        this.modalAddStudent.init();
        this.endConsult.init();
        modal.init();
        page.printTime(document.querySelector(".time"));
        page.printDate(document.querySelector(".date"));
    },
};

admin.endConsult = {
    init:function () {
        this.btnEndConsult = document.getElementById("end-consult");
        this.btnCloseModalInfo = ".endConsultOk";
        this.bindEvent();
    },
    bindEvent:function () {
        this.btnEndConsult.addEventListener("click",this.eventSend.bind(this))
        document.addEventListener("click",this.eventOk.bind(this))
    },
    eventSend:function(){
        AJAX.post("/admin/endConsult",[],function (text) {
            text = JSON.parse(text);
            if(text.status != 1){
                modal.open(document.getElementById("error"),"Ошибка завершения косультации");
                return false;
            }
            modal.open(document.getElementById('info'),"Время консультации: "+text.text.time+" Колличество посетивших: "+text.text.countStudent);
        }.bind(this))
    },
    eventOk:function (e) {
        if(e.target.matches(this.btnCloseModalInfo))
            window.location.href = '/admin/';
    }
};
admin.modalAddStudent = {
    init:function () {
        this.buttonModalOpen = document.querySelector(".addStudent");
        this.modal = document.getElementById("addStudent");
        this.modalError = document.getElementById("error");
        this.table = document.querySelector(".content");
        this.bindEvent();
    },
    bindEvent:function () {
        this.buttonModalOpen.addEventListener("click",this.eventOpenModal.bind(this));
    },
    eventOpenModal:function(){
        AJAX.post("/admin/modalAddStudent",[],function (text) {
            this.modal.innerHTML = text;
            modal.open(this.modal);
            tabs.init();
            admin.modalAddStudent.tabReadyListStudent.init();
            admin.modalAddStudent.tabNewStudent.init();
            admin.modalAddStudent.tabReadyListStudent.eventSelectGroup();
        }.bind(this))
    },
    updateTable:function () {
        //window.location.href = '/admin'
        AJAX.post("/admin/consult",[],function (text) {
            this.table.innerHTML=text;
            admin.init();
        }.bind(this));
    }
};

admin.modalAddStudent.tabReadyListStudent = {
    init:function () {
        this.selectGroup = document.getElementById("groups");
        this.selectStudent = document.getElementById("students");
        this.btnSubmit = document.getElementById("sendStudent");
        this.bindEvent();
    },
    bindEvent:function () {
        this.selectGroup.addEventListener("change",this.eventSelectStudent.bind(this));
        this.btnSubmit.addEventListener("click",this.eventSendStudent.bind(this));
    },
    eventSelectGroup:function(){
        AJAX.post("/admin/groupList",[],function (text) {
            text = JSON.parse(text);
            this.selectGroup.innerText = '';
            text.forEach(function (c) {
                let option = document.createElement("option");
                option.setAttribute("value",c.id);
                option.innerText = c.name;
                this.selectGroup.append(option);
            }.bind(this));
            this.eventSelectStudent();
        }.bind(this))
    },
    eventSelectStudent:function(){
        let groupId= this.selectGroup.value;
        if(groupId == 'null' || groupId==''){
            return false;
        }
        AJAX.post("/admin/studentList",{id_group:groupId},function (text) {
            text = JSON.parse(text);
            this.selectStudent.innerText = '';
            text.forEach(function (c) {
                let option = document.createElement("option");
                option.setAttribute("value", c.id);
                option.innerText = c.info;
                this.selectStudent.append(option);
            }.bind(this));
        }.bind(this))
    },
    eventSendStudent:function () {
        let info = this.selectStudent.value;
        let group = this.selectGroup.value;
        if(info === '' || info === undefined || group === '' || group === undefined){
            modal.close(admin.modalAddStudent.modal)
            modal.open(admin.modalAddStudent.modalError, "Заполните необходимые поля!");
            return false;
        }
        AJAX.post("/admin/addStudentOnConsult",{info:info,group:group},function (text) {
            text = JSON.parse(text);
            modal.close(admin.modalAddStudent.modal);
            if(text.status == '0'){
                modal.open(admin.modalAddStudent.modalError,text.error) ;
                return false;
            }
            //обновляем таблицу
            admin.modalAddStudent.updateTable();
        }.bind(this))
    }
};

admin.modalAddStudent.tabNewStudent = {
    init:function () {
        this.checkboxAddNewGroup = document.getElementById("check-addNewGroup");
        this.groupSelect = document.getElementById("groups-add-stud");
        this.groupInput = document.getElementById("group-name");
        this.infoStudent = document.getElementById("info-user");
        this.btnSubmitNewStudent = document.getElementById("addNewStudent");
        this.bindEvent();
        this.loadSelectList();
    },

    bindEvent:function () {
        this.checkboxAddNewGroup.addEventListener("click",this.eventCheckboxAddNewGroup.bind(this));
        this.btnSubmitNewStudent.addEventListener("click",this.eventSendNewStudent.bind(this));
    },
    loadSelectList:function(){
        AJAX.post("/admin/groupList",[],function (text) {
            text = JSON.parse(text);
            this.groupSelect.innerText = '';
            text.forEach(function (c) {
                let option = document.createElement("option");
                option.setAttribute("value",c.id);
                option.innerText = c.name;
                this.groupSelect.append(option);
            }.bind(this));
        }.bind(this))
    },
    eventSendNewStudent:function(){
        let group = this.checkboxAddNewGroup.checked?this.groupInput.value:this.groupSelect.value;
        AJAX.post("/admin/addStudentInConsultAndJson",{group:group, info:this.infoStudent.value},function (text) {
            text = JSON.parse(text);
            modal.close(admin.modalAddStudent.modal);
            if(text.status == '0'){
                modal.open(admin.modalAddStudent.modalError, text.error)
                return false;
            }
            //Обновляем таблицу
            admin.modalAddStudent.updateTable();
        }.bind(this));
    },
    eventCheckboxAddNewGroup:function (e) {
        if(e.target.checked){
            this.groupSelect.style.display = "none";
            this.groupInput.style.display = "block";
            return false;
        }
        this.groupSelect.style.display = "block";
        this.groupInput.style.display = "none";
    }

};
admin.modalConfirmDeleteStudent = {
    init:function () {
        this.modal = document.getElementById("confirm");
        this.btnYes = this.modal.querySelector("#confirm-yes");
        this.bindEvent();
    },
    bindEvent:function () {
        document.addEventListener("click",this.openModalConfirm.bind(this));
        this.btnYes.addEventListener("click",this.eventSendToServer.bind(this))
    },
    eventSendToServer:function(e){
        let id = e.target.getAttribute("data-id");
        AJAX.post("/admin/deleteStudentFromConsult",{id:id},function (text) {
            text = JSON.parse(text);
            modal.close(this.modal);
            if(text.status == '1') {
                document.getElementById(id).outerHTML = "";
                return false;
            }
            modal.open(admin.modalAddStudent.modalError,"Ошибка удаления студента "+text.info.info)
        }.bind(this))
    },
    openModalConfirm:function (e) {
        if(!e.target.matches("a[data-id].removeStudent i") || this.modal === undefined) return false;
        let id = e.target.parentNode.getAttribute("data-id");
        this.btnYes.setAttribute("data-id", id);
        AJAX.post("/admin/getInfoStudent",{id:id},function (text) {
            text = JSON.parse(text);
            modal.open(this.modal, "Удалить студента "+text.info.info+" из консультации?");
        }.bind(this));
    }
};

admin.modalConfirmDeleteConsult = {
    init:function () {
        this.modal = document.getElementById("confirm");
        this.btnYes = this.modal.querySelector("#confirm-yes");
        this.bindEvent();
    },
    bindEvent:function () {
        document.addEventListener("click",this.openModalConfirm.bind(this));
        this.btnYes.addEventListener("click",this.eventSendToServer.bind(this))
    },
    eventSendToServer:function(e){
        let id = e.target.getAttribute("data-id");
        AJAX.post("/admin/deleteConsult",{id:id},function (text) {
            text = JSON.parse(text);
            modal.close(this.modal);
            if(text.status == '1') {
                document.getElementById(id).outerHTML = "";
                return false;
            }
            modal.open(document.getElementById("error"),"Ошибка удаления: "+text.info)
        }.bind(this))
    },
    openModalConfirm:function (e) {
        if(!e.target.matches("a[data-id].removeConsult i") || this.modal === undefined) return false;
        let id = e.target.parentNode.getAttribute("data-id");
        this.btnYes.setAttribute("data-id", id);
        modal.open(this.modal, "Подтвердите удаление.");
    }
};