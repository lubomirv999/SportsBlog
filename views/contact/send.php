<?php $this->title = 'Contact us'; ?>
<form method="post" action="<?=APP_ROOT?>/contact/send">
    <div id="contact">Want to get in touch with us? Leave us a message below to contact the team and we will get back to you within 24 hours!</div>
    <div>
        <div>
            <textarea rows="10" cols="70" name="content" id="contentBox" placeholder="Your text here..."></textarea>
        </div>
    </div>
    <div>
        <div>
            <input type="submit" value="Send message"/>
        </div>
    </div>
</form>

