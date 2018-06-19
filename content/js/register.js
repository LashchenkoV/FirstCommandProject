let register = {
    init:function () {
        this.bindEvent();
    },
    bindEvent:function(){
        let button = document.getElementById("register");
        button.addEventListener("click",function () {
            let pass1 = document.getElementById("pass1").value;
            let pass2 = document.getElementById("pass2").value;
            let login = document.getElementById("login").value;
            let modalWindow = document.getElementById("error");
            if(login.length<3){
                modal.open(modalWindow,"Логин должен быть более 3 символов");
                return;
            }
            else if(pass1.length<3){
                modal.open(modalWindow,"Пароль должен быть более 3 символов");
                return;
            }
            else if(pass1!==pass2){
                modal.open(modalWindow,"Пароли не совпадают");
                return;
            }
            AJAX.post("/reg", {login:login, pass1:pass1, pass2:pass2}, function (text) {
                let res =  JSON.parse(text);
                if(res.register !== '0')
                    window.location.href="/admin";
                else {
                    modal.open(modalWindow, res.error)
                }
            })
        })
    },

};