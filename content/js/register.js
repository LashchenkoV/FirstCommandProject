let register = {
    init:function () {
        console.log(1)
        this.bindEvent();
    },
    bindEvent:function(){
        let button = document.getElementById("register");
        button.addEventListener("click",function () {
        let pass1 = document.getElementById("pass1").value;
        let pass2 = document.getElementById("pass2").value;
        let login = document.getElementById("login").value;
        let modalWindow = document.getElementById("error");
        if(pass1===pass2 && pass1.length>3){
            AJAX.post("/reg", {login:login, pass1:pass1, pass2:pass2}, function (text) {
                let res =  JSON.parse(text);
                if(res.register !== '0')
                    window.location.href="/";
                else {
                    page.changeContentModal(modalWindow, res.error);
                    modal.open(modalWindow)
                }


            })
        } else {
            page.changeContentModal(modalWindow,"Ошибка");
            modal.open(modalWindow)
        }
        })
    },

};