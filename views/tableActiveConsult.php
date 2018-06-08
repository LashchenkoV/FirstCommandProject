<?php foreach ($students as $student):?>
    <tr id="<?=$student['id']?>">
        <td><?=$student['info']?></td>
        <td><?=$student['group']?></td>
        <td class="option btn-close"><a href="#" data-id="<?=$student['id']?>" class="removeStudent"><i class="fa fa-times" aria-hidden="true"></i></a></td>
    </tr>
<?php endforeach;?>