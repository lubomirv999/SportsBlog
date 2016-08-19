<script type="text/javascript" src="<?=APP_ROOT?>/ckeditor/ckeditor.js"></script>

<?php $this->title = 'Edit your post';?>

<h1><?=htmlspecialchars($this->title)?></h1>

<form method="post">
    <div>Title:</div>
    <input type="text" name="title" value=" <?= htmlspecialchars($this->post['title'])?>" />

    <div>Content:</div>
    <textarea rows="5" name="content"> <?= htmlspecialchars($this->post['content'])?> </textarea>

    <script type="text/javascript">
        CKEDITOR.replace( 'content' );
    </script>

        <input type="submit" value="Edit">
        <a href="<?=APP_ROOT?>/posts">Cancel</a>
    </div>
</form>



