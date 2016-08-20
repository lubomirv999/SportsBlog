<?php $this->title = 'Users'; ?>
<form action="">
<?php foreach ($this->users as $user) : ?>

<table>
 <tr>
  <th>Username: </th>
  <th>FullName: </th>
 </tr>
 <tr>
  <td><a href="<?=APP_ROOT?>/posts"><?=$user['UserName']?></a></td><br>
  <td><?=$user['FullName']?></td>
 </tr>
</table>
<?php endforeach;?>
</form>
