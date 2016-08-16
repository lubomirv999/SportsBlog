<?php $this->title = $this->post['title']?>

<h1><?=htmlspecialchars($this->title)?></h1>

<article>
    <div><i>Published on: </i>
        <?=(new DateTime($this->post['date']))->format('d-M-y')?> <i>by</i> <?= htmlentities($this->post['user_id']) ?></div>
    <p class="content"><?=$this->post['content']?></p>
</article>