<?php $this->title = 'Users'; ?>
<form action="">
<?php foreach ($this->users as $user) : ?>
<div>
 <h2><span>Username: </span><a href="<?=APP_ROOT?>/posts"><?=$user['UserName']?></a></h2><br>
  <h3><span>Full name: </span><?=$user['FullName']?></h3><br>
</div>
<?php endforeach;?>
</form>
