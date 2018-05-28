let modal = {
    init:function () {
        this.bindEvent();
    },
    bindEvent:function () {
        document.addEventListener("click",function (e) {
            if(e.target.hasAttribute("data-modal-open")){
                let modalId = e.target.getAttribute("data-modal-open");
                let modal = document.getElementById(modalId);
                this.open(modal);
            }
            else if(e.target.hasAttribute("data-modal-close")){
                let modalId = e.target.getAttribute("data-modal-close");
                let modal = document.getElementById(modalId);
                this.close(modal);
            }
        }.bind(this));
    },
    open:function (modal, text) {
        if(modal === undefined) return false;
        if(modal.style.display === "block") return false;
        if(text!== undefined)
            modal.querySelector("#modal-text").innerHTML = text;
        modal.style.display = "block";
        document.getElementById("bg-layer").style.display="block";
    },
    close:function (modal) {
        if(modal === undefined) return false;
        if(modal.style.display === "none") return false;
        modal.style.display = "none";
        document.getElementById("bg-layer").style.display="none";
    }
};