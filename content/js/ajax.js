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