let tabs = {
    init:function () {
        this.bindEvent();
    },
    bindEvent:function () {
        let tab = document.querySelector(".tabcontent");
        let link = document.querySelector(".links");
        link.className += " active";
        tab.style.display = "block";
        document.addEventListener("click", function (e) {
            if(!e.target.hasAttribute("data-tab")) return;
            let tab = e.target.getAttribute("data-tab");

            let tabcontent = document.querySelectorAll(".tabcontent");
            for(let i = 0; i < tabcontent.length; i++){
                tabcontent[i].style.display = "none";
            }

            let links = document.querySelectorAll(".links");
            for(let i = 0; i < links.length; i++){
                links[i].className = links[i].className.replace(" active", "");
            }

            document.getElementById(tab).style.display = "block";
            e.target.className += " active";
        })
    }
};
