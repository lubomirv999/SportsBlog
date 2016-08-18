<?php $this->title = $this->post['title'] ?>

<h1><?= htmlspecialchars($this->title) ?></h1>
<main id="posts">
    <article>
        <div><i>Published on: </i>
            <?= (new DateTime($this->post['date']))->format('d-M-y') ?>
            <i>by</i> <?= htmlentities($this->post['user_id']) ?></div>
        <p class="content"><?= $this->post['content'] ?></p>
    </article>
</main>
<p>Comments:</p>
<form action="<?= APP_ROOT ?>/posts/createComment/<?= $this->post['Id']?>" method="post">
    <div>
        <div>
            <textarea name="comment" id="" cols="20" rows="3" placeholder="Your comment..."></textarea>
        </div>
    </div>
    <div>
        <div>
            <input type="submit" id="comment" name="submit_comment" value="Comment"/>
        </div>
    </div>
</form>
<div>
    <?php foreach ($this-> comments as $comment): ?>
        <form action="<?= APP_ROOT ?>/posts/deleteComment/<?= $this->post['Id']?>/<?=$comment['ID']?>" method="post">
       <div class="date"><i>Commented on:</i>
        <?= (new DateTime($comment['date']))->format('d-M-Y') ?><i> by </i>
        <?= htmlspecialchars($comment['UserName']) ?>
        <p class="content"><?= $comment['content'] ?></p>
           <div><input type="submit" name="deleteComment" id="deleteComment" value="Delete"></div>
       </div>
        </form>
    <?php endforeach ?>
</div>