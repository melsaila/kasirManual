<?php if (! defined ( 'BASEPATH' )) exit ( 'No direct script access allowed' );
echo doctype('html5');?>
<html lang="en" class="no-js">
<head>
<title>Management | Taksi Rina-Rini</title>
<meta charset="UTF-8">
<meta http-equiv="X-UA-Compatible" content="IE=edge,chrome=1">
<?php
$meta = array(
        array('name' => 'Content-type', 'content' => 'text/html; charset=utf-8', 'type' => 'equiv'),
        array('name' => 'robots', 'content' => 'no-cache'),
        array('name' => 'description', 'content' => 'KSS Collection Management'),
        array('name' => 'keywords', 'content' => 'KSS Collection Management, Sahabat UKM, Collection Management'),
        array('name' => 'viewport', 'content' => 'width=device-width, initial-scale=1.0')
    );
// echo meta($meta);
?>
<noscript>This site is based on JavaScript. Please activate JavaScript in your browser.</noscript>
<script type="text/javascript" src="<?php echo base_url('statics/jeasyui/jquery-1.8.2.min.js'); ?>"></script>
<link rel="stylesheet" type="text/css" href="<?php echo base_url('statics/css/custom.css'); ?>">
<link rel="stylesheet" type="text/css" href="<?php echo base_url('statics/css/table.css'); ?>">
<style type="text/css">
#labelname{font-size:14px;font-weight: 400;color: #474747}.footermarks{position:absolute;bottom:0px;text-align:right;padding:10px;width:auto;right:0px;color:#474747}.marksss{position:absolute;width:auto;font-size:13px;padding-top:10px;font-family:Arial,Verdana,Helvetica,sans-serif;color:#575757;text-align:center;margin-left:100px;font-weight:lighter}input[type=text],input[type=password]{font-weight:bold;font-size:16px;color:#534e4e;height:20px;border-radius:3px;-moz-border-radius:3px;-webkit-border-radius:3px;background:#fff}:-moz-placeholder{text-decoration:none;font-size:15px;font-weight:normal}::-webkit-input-placeholder{text-decoration:none;font-size:15px;font-weight:normal}::-moz-placeholder{text-decoration:none;font-size:15px;font-weight:normal}-ms-input-placeholder{text-decoration:none;font-size:15px;font-weight:normal}
</style>
</head>
<body>
<div class="logokss">
<div id="bodylogin">
<div class="top_header">
<h2>Management</h2>
<h3>{Development}</h3>
V.01-220914</div>
<?php
$data = array('id' => 'masukform');
echo form_open('login/dologin', $data);
echo form_hidden('taksikey', $taksikey);
?>
<div style="display:block; margin-left: 10%; padding-bottom: 5px;">
<div id="labelname">Username,</div><input type="text" autocomplete="off" autofocus="autofocus" required="required" name="username" placeholder="Username" style="width: 255px;" value="<?php echo isset($username) != '' ? $username : ''; ?>"/>
</div>
<div style="display:block; margin-left: 10%;">
<div id="labelname">Password,</div><input type="password" name="passwd" required="required" placeholder="Password" style="width: 255px;" autocomplete="off"/>
</div>
<br/>
<div style="text-align:center;">
<input type="submit" class="button login" value="Login" style="height:auto;"/>
</div>
<?php echo form_close(); ?>
<div style="padding:10px;font-size:14px;text-align: center; color: #DD3B4A;">
<?php
echo $this->session->flashdata('message');
if(isset($message)){echo $message;}?></div>
<div class="marksss">&copy 2014 Taksi Rina-Rini</div>
</div></div>
<div class="footermarks">
Best view on browser : Mozilla Firefox V.20+ <br>
Tested on browser Google Chrome V.30+ and Internet Explorer V.9+
</div>
<script type="text/javascript">
$('form[id="masukform"]').submit(function(){$('form[id="masukform"] input[type="submit"]').attr('disabled',true).val('signing in...').css({'color':'#EBEBE4','font-style':'italic'});});
<?php if(isset($message)){ ?>
$(function(){$('form[id="masukform"] input[name="passwd"]').css({'border':'1px solid red'}).focus();});
<?php } ?>
</script>
</body>
</html>
