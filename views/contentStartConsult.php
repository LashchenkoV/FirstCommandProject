<div class="title">
    <div class="info">
        <div class="date"></div>
        <div class="time"></div>
    </div>
    <div class="add-consultation" >
        <a id="#" href="#"><i class="fa fa-plus addStudent" aria-hidden="true"></i></a>
    </div>
</div>
<div>
    <table class="consultation-table">
        <thead>
        <tr>
            <th class="name">Студент</th>
            <th class="group">Группа</th>
            <th class="option">Опции</th>
        </tr>
        </thead>
        <tbody id="table-students">
        <?php foreach ($students as $student):?>
            <tr id="<?=$student['id']?>">
                <td><?=$student['info']?></td>
                <td><?=$student['group']?></td>
                <td class="option btn-close"><a href="#" data-id="<?=$student['id']?>" class="removeStudent"><i class="fa fa-times" aria-hidden="true"></i></a></td>
            </tr>
        <?php endforeach;?>
        <tr>
            <td></td>
            <td></td>
            <td><input type="button" class="button" id="end-consult" value="Завершить"></td>
        </tr>
        </tbody>
    </table>
</div>
<script src="/content/js/admin.js"></script>
<script>
    admin.init();
    admin.modalConfirmDeleteStudent.init();
</script>