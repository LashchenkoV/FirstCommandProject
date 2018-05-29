let entry = {
    init:function () {
        this.bindEvent();
    },
    bindEvent:function () {
        let button = document.getElementById("entryBtn");
        button.addEventListener("click",function () {
            let entryPass = document.getElementById("entryPass").value;
            let login = document.getElementById("entryLog").value;
            let modalWindow = document.getElementById("error");
            if(entryPass.length===0 || login.length===0){
                page.changeContentModal(modalWindow,"Ошибка");
                modal.open(modalWindow);
                return false;
            }
            AJAX.post("/login",{login:login,pass:entryPass},function (text) {
                let res = JSON.parse(text);
                if(res.auth !== '0')
                    window.location.href = "/admin";
                else {
                    page.changeContentModal(modalWindow, res.error);
                    modal.open(modalWindow)
                }
            })
        })


    }
};