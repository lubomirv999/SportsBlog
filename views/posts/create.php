<?php $this->title = 'Create Post'; ?>
<script type="text/javascript" src="<?=APP_ROOT?>/ckeditor/ckeditor.js"></script>

<form name="createPost" method="post" action="<?=APP_ROOT?>/posts/create" enctype="multipart/form-data">
    <div>
        <input id="title" type="text" placeholder="Title" name="title" />
    </div>
    <div>
        <textarea id="content" name="content" rows="15" cols="100" placeholder="Your post..."></textarea>
        <script type="text/javascript">
            CKEDITOR.replace( 'content' );
        </script>
    </div>
    <div>
        <input type="submit" name="submit" value="Create post" />
        <a href="<?=APP_ROOT?>/posts">Cancel</a>
    </div>
    Select image to upload:
    <input type="file" name="fileToUpload" id="fileToUpload">
</form>