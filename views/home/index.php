<?php $this->title = 'Welcome to our Blog - SportZen'; ?>
<div id="banner-wrapper">
    <div id="banner" class="box container">
        <div class="row">
            <div class="7u 12u(medium)">
                <h2>Welcome to our blog</h2>
                <p>SportZen Team</p>
            </div>
            <div class="5u 12u(medium)">
                <ul>
                    <li>
                        <aside>
                            <h2>Recent Posts</h2>
                            <?php foreach ($this -> sidebarPosts as $post) :?>
                                <a href="<?=APP_ROOT?>/posts/view_post/<?=$post['Id']?>"><?=htmlentities($post['title'])?></a>
                            <?php endforeach ?>
                        </aside>
                    </li>
                </ul>
            </div>
        </div>
    </div>
</div>



<div id="features-wrapper">
    <div class="container">
        <div class="row">
            <?php foreach ($this -> posts as $post): ?>
                <div class="4u 12u(medium)">
                    <section class="box feature">
                        <a href="#" class="image featured"><img src="<?=APP_ROOT?>/content/images/phelps.jpg" alt="" /></a>
                        <div class="inner">

                            <header>
                                <h2 class="title"> <?=htmlentities($post['title'])?></h2>
                                <div class="date"><i>Posted on</i>
                                    <?=(new DateTime($post['date']))->format('d-M-Y')?>
                                    <i>by </i><?=htmlentities($post['FullName'])?>
                                </div>
                            </header>
                            <p class="content"><?= $post['content']?></p>
                        </div>
                    </section>
                </div>
            <?php endforeach ?>
        </div>
    </div>
</div>