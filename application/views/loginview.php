<!doctype html>
<html>
<head>
<meta charset="utf-8">
<title><?=get_option('site_name');?></title>
<link rel="stylesheet" href="<?=base_url();?>assets/themes/css/style.default.css" type="text/css" />
<link rel="shortcut icon" href="<?=base_url();?>assets/img/favicon.ico">
<script type="text/javascript" src="<?=base_url();?>assets/themes/js/jquery.js"></script>
</head>
<body class="loginbody">

    <div class="loginwrapper">
        <div class="loginwrap zindex100 animate2 bounceInDown">
        <h1 class="logintitle"><span class="iconfa-lock"></span> <?=get_option('site_app');?><span class="subtitle">Silahkan login untuk memulai.</span></h1>
            <div class="loginwrapperinner">
           <?php
		   $att=array(
		   	'id'=>'loginform',
		   	);
			echo form_open('login/attempt',$att);
		   ?>
    <p class="animate4 bounceIn"><input type="text" id="username" name="username" placeholder="Username" /></p>
    <p class="animate5 bounceIn"><input type="password" id="password" name="password" placeholder="Password" /></p>
    <p class="animate6 bounceIn"><button class="btn btn-default btn-block">Masuk</button></p>
    
</form>
            </div><!--loginwrapperinner-->
        </div>
        <div class="loginshadow animate3 fadeInUp"></div>
    </div><!--loginwrapper-->
    
    <script type="text/javascript">
    jQuery.noConflict();
    
    jQuery(document).ready(function(){
        
        var anievent = (jQuery.browser.webkit)? 'webkitAnimationEnd' : 'animationend';
        jQuery('.loginwrap').bind(anievent,function(){
            jQuery(this).removeClass('animate2 bounceInDown');
        });
        
        jQuery('#username,#password').focus(function(){
            if(jQuery(this).hasClass('error')) jQuery(this).removeClass('error');
        });
        
        jQuery('#loginform button').click(function(){
            if(!jQuery.browser.msie) {
                if(jQuery('#username').val() == '' || jQuery('#password').val() == '') {
                    if(jQuery('#username').val() == '') jQuery('#username').addClass('error'); else jQuery('#username').removeClass('error');
                    if(jQuery('#password').val() == '') jQuery('#password').addClass('error'); else jQuery('#password').removeClass('error');
                    jQuery('.loginwrap').addClass('animate0 wobble').bind(anievent,function(){
                        jQuery(this).removeClass('animate0 wobble');
                    });
                } else {
                    jQuery('.loginwrapper').addClass('animate0 fadeOutUp').bind(anievent,function(){
                        jQuery('#loginform').submit();
                    });
                }
                return false;
            }
        });
    });
    </script>

</body>
</html>