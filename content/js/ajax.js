var AJAX = {
    post:function (url,params,callback,onerror) {
        var xhr = new XMLHttpRequest();
        xhr.open("POST",url,true);
        xhr.onreadystatechange = function () {
            if(xhr.readyState!==4) return;
            if(xhr.status===200){
                callback(xhr.responseText);
            } else if (onerror) onerror();
        };
        var data = new FormData();
        for(var key in params ){
            data.append(key,params[key]);
        }
        xhr.send(data);

    },
    get:function (url,callback,onerror) {
        var xhr = new XMLHttpRequest();
        xhr.open("GET",url,true);
        xhr.onreadystatechange = function () {
            if(xhr.readyState!==4) return;
            if(xhr.status===200){
                callback(xhr.responseText);
            } else if (onerror) onerror();
        };
        xhr.send();

    }

};

    var NoteApi = {
        baseUrl:"url--------------",
        getAllUsers:function (onresult) {
            AJAX.get(this.baseUrl+"?action=user",function (response) {
                 onresult(JSON.parse(response).data);
            })

        },
        addUser:function (name,onresult) {
            AJAX.post(this.baseUrl+"?action=user&method=add",{name:name},function (response) {
                onresult();
            })
        }
        
    };



 //    NoteApi.addUser("-------------------",function () {
 //        NoteApi.getAllUsers(function (users) {
 //            console.log(users);
 //
 //    });
 //
 //   var page = {
 //     init:function () {
 //       this.usersModule.init()
 //     }
 //   };
 //   page.usersModule={
 //      init:function () {
 //        this.container = document.querySelector(".form reg");
 //        this.add = this.container.querySelector(".add");
 //        this.log = this.add.querySelector(".log");
 //        this.pass1 = this.add.querySelector(".pass1");
 //        this.pass2 = this.add.querySelector(".pass2");
 //        this.addBtn = this.add.querySelector(".submit button");
 //        this.bindEvent();
 //      },
 //       bindEvent:function () {
 //           this.addBtn.addEventListener("click",this.addBtn.bind(this))
 //       },
 //       addUser:function () {
 //          NoteApi.addUser(this.log.value,this.onUserAppended.bind(this));
 //       },
 //       onUserAppended:function () {
 //           // -------------
 //       },
 //       update:function () {
 //
 //       }
 //   }
 //    };
 //
 // window.addEventListener("load",page.init.bind(page));

