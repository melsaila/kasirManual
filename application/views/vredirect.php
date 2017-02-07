<?php
require_once(APPPATH.'views/template.php');
$v = new Template();
$v->head();?>
<style type="text/css">
body{
    text-align: center;
    color: #FFF;
    background: #000;
}
.timeout{
    font-family: Arial, Verdana, Helvetica, sans-serif;
    display: block;
    padding: 10px;
    font-size: 20px;
}
</style>
<?php $v->main(); ?>
<div class="timeout">
    <h2>timeout</h2>
    <button class="button green" onclick="javacript:window.top.location.href='<?php echo base_url('login/dologout');?>'">Ke halaman login</button>
</div>
<?php
$v->foot();
?>
