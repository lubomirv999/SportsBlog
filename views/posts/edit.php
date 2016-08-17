<?php $this->title = 'Edit your post';?>

<h1><?=htmlspecialchars($this->title)?></h1>

<form method="post">
    <div>Title:</div>
    <input type="text" name="title" value="<?=htmlspecialchars($this->post['title'])?>" />

    <div>Content:</div>
    <textarea rows="5" name="content"> <?= htmlspecialchars($this->post['content'])?> </textarea>
    <div>Date:</div>
    <input type="text" name="date" value="<?=htmlspecialchars($this->post['date'])?>" />
    <div>User ID:</div>
    <input type="text" name="user_id" value="<?=htmlspecialchars($this->post['user_id'])?>" />
    <div>
        <input type="submit" value="Edit">
        <a href="<?=APP_ROOT?>/posts">Cancel</a>
    </div>
</form>



