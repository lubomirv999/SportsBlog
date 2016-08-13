<?php $this->title = 'Posts'; ?>
<h1><?=htmlspecialchars($this->title)?></h1>
<table>
    <tr>
        <th>Title</th>
        <th>Content</th>
        <th>Date</th>
        <th>Action</th>
    </tr>
    <?php foreach ($this->posts as $post) : ?>
   <tr>
       <td><?= htmlspecialchars($post['title']) ?></td>
       <td><?= cutLongText($post['content'])?></td>
       <td><?= htmlspecialchars($post['date'])?></td>
       <td>
           <a href="<?=APP_ROOT?>/posts/edit/<?=$post['Id']?>" >[Edit]</a>
           <a href="<?=APP_ROOT?>/posts/delete/<?=$post['Id']?>" >[Delete]</a>
           <a href="<?=APP_ROOT?>/posts/comment/<?=$post['Id']?>" >[Comment]</a>

       </td>
   </tr>
    <?php endforeach;?>
</table>
