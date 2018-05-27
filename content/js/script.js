let page = {
    changeContentModal:function (modal,content) {
        let err = modal.querySelector("#contentError");
        err.innerText = '';
        err.innerText = content;
    }
};