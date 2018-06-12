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
            modal.querySelector(".modal-text").innerHTML = text;
        this.animeOpen(modal);
    },
    close:function (modal) {
        if(modal === undefined) return false;
        if(modal.style.display === "none") return false;
        this.animeClose(modal);
    },
    animeClose:function (modal){
        anime({
            targets: modal,
            scaleY:0,
            scaleX:0,
            duration:500,
            complete:function () {
                document.getElementById("bg-layer").style.display="none";
                modal.style.display = 'none';
            },
            easing: 'easeInOutQuad',

        });
    },
    animeOpen:function (modal) {
        anime({
            targets: modal,
            scaleY:1,
            scaleX:1,
            duration:500,
            run:function () {
                modal.style.display = "block";
                document.getElementById("bg-layer").style.display="block";
            },
            easing: 'easeInCubic',
        });
    }
};