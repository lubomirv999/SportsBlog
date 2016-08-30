<?php $this->title = 'Welcome to our Blog - SportZen'; ?>
<?php if($this->isLoggedIn)?>
<div id="banner-wrapper">
    <div id="banner" class="box container">
        <div class="row">
            <div class="7u 12u(medium)">
                <h2>Welcome to our blog</h2>
                <p>SportZen Team</p>
            </div>
            <div class="5u 12u(medium)">
                <ul>
                    <?php if (!$this->isLoggedIn) : ?>
                        <li><a href="<?=APP_ROOT?>/users/register" class="button big icon">Register</a></li>
                        <li><a href="<?=APP_ROOT?>/team" class="button alt big icon">About us</a></li>
                    <?php else: ?>
                        <li><a href="<?=APP_ROOT?>/team" class="button alt big icon">About us</a></li>
                    <?php endif; ?>
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
                        <a href="<?=APP_ROOT?>/posts/view_post/<?=$post['Id']?>" class="image featured"><img style="width:350px;height:250px;" src="<?=APP_ROOT?>/content/images/default.jpg" alt="" /></a>
                        <div class="inner">
                            <header>
                                <h2 class="title"> <?=htmlentities($post['title'])?></h2>
                                <div class="date"><i>Posted on</i>
                                    <?=(new DateTime($post['date']))->format('d-M-Y')?>
                                    <i>by </i><?=htmlentities($post['FullName'])?>
                                </div>
                            </header>
                            <p class="content"><?=cutLongText($post['content'])?></p>
                        </div>
                    </section>
                </div>
            <?php endforeach ?>
        </div>
    </div>
</div>