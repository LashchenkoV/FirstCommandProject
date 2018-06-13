<div class="content">
    <div class="title">
        <table class="min-table">
            <tr>
                <td>Начало</td>
                <td><?=$infoConsult['date_start']." ".$infoConsult['time_start']?></td>
            </tr>
            <tr>
                <td>Конец</td>
                <td><?=$infoConsult['date_end']." ".$infoConsult['time_end']?></td>
            </tr>
            <tr>
                <td>Длительность</td>
                <td><?=$infoConsult['time']?></td>
            </tr>
            <tr>
                <td>Колличество пришедших</td>
                <td><?=$infoConsult['countStudent']?></td>
            </tr>
        </table>
    </div>
    <div>
        <table class="consultation-table">
            <tr>
                <th>Студент</th>
                <th>Группа</th>
            </tr>
            <?php foreach($tableStudent as $student):?>
                <tr>
                    <td><?=$student['info']?></td>
                    <td><?=$student['group']?></td>
                </tr>
            <?php endforeach;?>
        </table>
    </div>
</div>