<div class="nav">
    <ul id="navigation" class="left-menu">
        <li>
            <a href="/admin">
                <i class="fa fa-address-card-o" aria-hidden="true"></i>
                Добавить
            </a>
        </li>
        <li class="selected">
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
    <div>
        <table class="consultation-table">
            <tr>
                <th>Дата начала</th>
                <th>Длительность</th>
                <th>Колл. пришедших</th>
                <th class="option">Опции</th>
            </tr>
            <?php foreach ($listConsult as $consult):?>
                <tr>
                    <td><?=$consult['date_start']." ".$consult['time_start']?></td>
                    <td><?=$consult['delta_time']?></td>
                    <td><?=$consult['count_student']?></td>
                    <td class="option">
                        <a href="/admin/list/?id=<?=$consult['id']?>" target="_blank"><i class="fa fa-pencil-square-o" aria-hidden="true"></i></a>
                        <a href="#" class="btn-close"><i class="fa fa-times" aria-hidden="true"  data-modal-open="confirm"></i></a>
                    </td>
                </tr>
            <?php endforeach;?>
        </table>
    </div>
</div>