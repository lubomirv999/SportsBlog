<?php $this->title = 'Users'; ?>
<form action="">
<?php foreach ($this->users as $user) : ?>
<div>
 <h2>Username: <a href="<?=APP_ROOT?>/posts"><?=$user['UserName']?></a></h2>
  <h3>Full name:<?=$user['FullName']?></h3>
</div>
<?php endforeach;?>
</form>
