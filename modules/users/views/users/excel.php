<table border="1">
    <tr>
                    <th>ID</th>
                    <th>EMAIL</th>
                    <th>NAME</th>
                    <th>LASTNAME</th>
                    <th>USERNAME</th>
                    <th>STATE</th>
                    <th>STATE_EMAIL</th>
                    <th>IMG</th>
                    <th>REGISTERED</th>
                    <th>TRASH</th>
                    <th>PHONE</th>
                    <th>ADDRESS</th>
                    <th>BIRTHDATE</th>
                    <th>IDENTITY</th>
                    <th>GENDER</th>
                    <th>FB_ID</th>
                    <th>FB_IMG</th>
            </tr>
    <?php foreach(Users::model()->findAll($model->search()->getCriteria()) as $data):?>
    <tr>
                    <td><?=$data->id?></td>
                    <td><?=$data->email?></td>
                    <td><?=$data->name?></td>
                    <td><?=$data->lastname?></td>
                    <td><?=$data->username?></td>
                    <td><?=$data->state?></td>
                    <td><?=$data->state_email?></td>
                    <td><?=$data->img?></td>
                    <td><?=$data->registered?></td>
                    <td><?=$data->trash?></td>
                    <td><?=$data->phone?></td>
                    <td><?=$data->address?></td>
                    <td><?=$data->birthdate?></td>
                    <td><?=$data->identity?></td>
                    <td><?=$data->gender?></td>
                    <td><?=$data->fb_id?></td>
                    <td><?=$data->fb_img?></td>
            </tr>
    <?php endforeach;?>
</table>
close
