<?php $this->title = 'Users'; ?>
<h1 align="center">The following messages were recieved:</h1>
<br><br>
<form action="">
    <?php foreach ($this-> contact as $contact) : ?>
        <div class="contactMessages">
            <div class="right"> Content:
                <?=htmlspecialchars($contact['content'])?><br>
            </div>
            <div class="left">User Id:
              <?=htmlspecialchars($contact['user_id'])?>
                <p>Date: <?=htmlspecialchars($contact['date'])?></p>
            </div>
        </div>
    <?php endforeach;?>
</form>