<?php $this->title = 'Posts'; ?>
<h1><?=htmlspecialchars($this->title)?></h1>
<table>
    <tr>
        <th style="color: white">Title</th>
        <th style="color: white">Content</th>
        <th style="color: white">Date</th>
        <th style="color: white">Action</th>
    </tr>
    <?php foreach ($this->posts as $post) : ?>
   <tr>
       <td><a href="<?=APP_ROOT?>/posts/view_post/<?=$post['Id']?>"><?= htmlspecialchars($post['title']) ?></a></td>
       <td><a href="<?=APP_ROOT?>/posts/view_post/<?=$post['Id']?>"><?= cutLongText($post['content'])?></a></td>
       <td><?= htmlspecialchars($post['date'])?></td>
       <td>
           <a href="<?=APP_ROOT?>/posts/edit/<?=$post['Id']?>" >[Edit]</a>
           <a href="<?=APP_ROOT?>/posts/delete/<?=$post['Id']?>" >[Delete]</a>
           <a href="<?=APP_ROOT?>/posts/comment/<?=$post['Id']?>" >[Comment]</a>
           <a href="<?=APP_ROOT?>/posts/view_post/<?=$post['Id']?>">[View Post]</a>
       </td>
   </tr>
    <?php endforeach;?>
</table>
