<?php $this->title = 'Users'; ?>
<h1 align="center">The following messages were recieved:</h1>
<br><br>
<form action="">
    <?php foreach ($this->contact as $contact) : ?>
        <div class="contactMessages">
            <div class="right"> Content:
                <?=$contact['content']?><br>
            </div>
            <div class="left">User:
                <?=$contact['user_id']?>
            </div>
        </div>
    <?php endforeach;?>
</form>