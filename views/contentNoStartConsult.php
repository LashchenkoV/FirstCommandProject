<div class="title">
    <div class="info">
        <div class="date">25.03.2018</div>
        <div class="time">12:15</div>
    </div>
    <div class="add-consultation" >
        <input id="startConsult" type="button" class="button" value="Начать консультацию">
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
            else
                window.location.href = "/admin"

        });
    });
</script>