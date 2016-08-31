<?php $this->title = 'Users'; ?>
<form action="">
    <?php foreach ($this->users as $user) : ?>
        <div class="users">
            <div class="right"> Username:
                <a href =" <?=APP_ROOT?>/team"><?=htmlspecialchars($user['UserName'])?></a><br>
            </div>
            <div class="left">FullName:
                <?=htmlspecialchars($user['FullName'])?>
                <td>
                    <a href="<?=APP_ROOT?>/users/promote/<?=$user['ID']?>" >[Grant privileges]</a>
                    <a href="<?=APP_ROOT?>/users/delete/<?=$user['ID']?>">[Delete]</a>
                </td>
            </div>
        </div>
    <?php endforeach;?>
</form>
