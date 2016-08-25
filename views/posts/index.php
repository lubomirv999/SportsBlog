<?php
    require_once ('./helpers/pagination.php');
    $this->title = 'Posts';
    $postsCount = intval($this->model->countPosts());
    $indexURL = APP_ROOT . '/posts/index/';
?>
<div id="main-wrapper">
    <div class="container">
        <div class="row 200%">
            <div class="8u 12u$(medium)">
            <?php if ($postsCount > 0)  : ?>
            <?php foreach ($this->posts as $post) : ?>
                    <div id="content">

                        <!-- Content -->
                        <article>
                            <h2><a href="<?=APP_ROOT?>/posts/view_post/<?=$post['Id']?>"><?= htmlspecialchars($post['title']) ?></a></h2>
                            <span><i>Posted on</i>
                                <?=(new DateTime($post['date']))->format('d-M-Y')?>
                                <i>by </i><?=htmlentities($post['FullName'])?>
                            </span>
                            <p><?= cutLongText($post['content'])?></p>
                            <table>
                                <tr>
                                    <td>
                                        <a href="<?=APP_ROOT?>/posts/edit/<?=$post['Id']?>" >Edit</a>
                                        <a href="<?=APP_ROOT?>/posts/view_post/<?=$post['Id']?>" >Comment</a>
                                        <a href="<?=APP_ROOT?>/posts/view_post/<?=$post['Id']?>">View Post</a>
                                        <a href="<?=APP_ROOT?>/posts/delete/<?=$post['Id']?>" >Delete</a>
                                    </td>
                                </tr>
                            </table>
                            <hr>
                        </article>

                    </div>
            <?php endforeach;?>
            <?php endif; ?>

            <?php pagination($postsCount, $indexURL);?>
            </div>

            <div class="4u 12u$(medium)">
                <div id="sidebar">

                    <!-- Sidebar -->
                    <section>
                        <h3>Subheading</h3>
                        <p>Phasellus quam turpis, feugiat sit amet ornare in, hendrerit in lectus.
                            Praesent semper mod quis eget mi. Etiam eu ante risus. Aliquam erat volutpat.
                            Aliquam luctus et mattis lectus sit amet pulvinar. Nam turpis nisi
                            consequat etiam.</p>
                        <footer>
                            <a href="#" class="button icon fa-info-circle">Find out more</a>
                        </footer>
                    </section>

                    <section>
                        <h3>Subheading</h3>
                        <ul class="style2">
                            <li><a href="#">Amet turpis, feugiat et sit amet</a></li>
                            <li><a href="#">Ornare in hendrerit in lectus</a></li>
                            <li><a href="#">Semper mod quis eget mi dolore</a></li>
                            <li><a href="#">Quam turpis feugiat sit dolor</a></li>
                            <li><a href="#">Amet ornare in hendrerit in lectus</a></li>
                            <li><a href="#">Semper mod quisturpis nisi</a></li>
                        </ul>
                    </section>

                </div>
            </div>
        </div>
    </div>
</div>

