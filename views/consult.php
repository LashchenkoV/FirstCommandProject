<div class="modal modal-error" id="error">
    <div class="tab">
        <div>
            <a class="button" href="#">Ошибка!</a>
        </div>
        <div class="btn-close">
            <a href="#"><i  data-modal-close="error" class="fa fa-window-close" aria-hidden="true"></i></a>
        </div>
    </div>
    <p id="modal-text">Текст ошибки: Lorem ipsum dolor sit amet, consectetur adipisicing elit.</p>
</div>
<div class="nav">
    <ul id="navigation" class="left-menu">
        <li class="selected">
            <a href="/admin">
                <i class="fa fa-address-card-o" aria-hidden="true"></i>
                Добавить
            </a>
        </li>
        <li>
            <a href="/admin/list">
                <i class="fa fa-list" aria-hidden="true"></i>
                Список
            </a>
        </li>
        <li>
            <a href="/logout">
                <i class="fa fa-sign-out" aria-hidden="true"></i>
                Выход
            </a>
        </li>
    </ul>
</div>
<div class="content">
    <div class="title">
        <div class="info">
            <div class="date">25.03.2018</div>
            <div class="time">12:15</div>
        </div>
        <div class="add-consultation" >
            <input id="startConsult" type="button" class="button" value="Начать консультацию">
        </div>
    </div>
</div>
<script>
    modal.init();
    page.printDate(document.querySelector(".date"));
    page.printTime(document.querySelector(".time"));
    document.getElementById("startConsult").addEventListener("click",function () {
       AJAX.post("/admin/start",[],function (text) {
           text = JSON.parse(text);
           if(text.start === '0'){
               modal.open(document.getElementById("error"), text.error);
               return false;
           }
           else {
               let content = document.querySelector(".content");
               content.innerHTML = text.text;
               page.printDate(document.querySelector(".date"));
               page.printTime(document.querySelector(".time"));
           }
       });
    });
</script>