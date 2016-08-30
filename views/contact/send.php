<?php $this->title = 'Contact us'; ?>
<form method="post" action="<?=APP_ROOT?>/contact/send">
    <div id="contact" align="center">Want to get in touch with us? Leave us a message below to contact the team and we will get back to you within 24 hours!</div>
    <br>
    <div>
        <div>
            <textarea rows="7" cols="40" name="content" id="contentBox" placeholder="Your text here..."></textarea>
        </div>
    </div><br>

        <div align="center">
            <input type="submit" value="Send message" />
        </div>

</form>

