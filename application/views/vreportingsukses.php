<?php
require_once(APPPATH.'views/template.php');
$v = new Template();
$v->head();?>
<script type="text/javascript" src="<?php echo base_url('statics/js/reportingorderlogsukses_25092014A.min.js'); ?>"></script>
<script type="text/javascript">
$(function() {
    jReportingorderlogsukses.init("<?php echo $taxixkey; ?>");
});
</script>
<!--<link rel="stylesheet" href="//code.jquery.com/ui/1.11.4/themes/smoothness/jquery-ui.css">
<script src="//code.jquery.com/jquery-1.10.2.js"></script>
<script src="//code.jquery.com/ui/1.11.4/jquery-ui.js"></script>-->
<link rel="stylesheet" type="text/css" href="<?php echo base_url('statics/css/jquery-ui.css'); ?>">
<script src="statics/js/jquery-1.11.0.js"></script>  
<script src="statics/js/jquery-ui.js"></script>
<link rel="stylesheet" href="/resources/demos/style.css">
<script type="text/javascript">
$(function() {
	$( "#datepickerStart" ).datepicker();
});
</script>
<script type="text/javascript">
$(function() {
	$( "#datepickerEnd" ).datepicker();
});
</script>

<?php $v->main(); ?>
<table id="greportingorderlogsukses" class="easyui-datagrid" toolbar="#bar"></table>
<div id="bar" class="color-gradient">
    <span>Berdasarkan :</span>
    <select id="terminalsearch" panelHeight="auto" style="width:auto;">
        <option value="">- Pilih ? - </option>
        <option value="u.username">Nama</option>
        <option value="cq.startlocation">Alamat</option>
        <!-- <option value="addrs_clue">Alamat Clue</option> -->
        <option value="u.phone">Telepon</option>
    </select>
    <input id="terminalkeyword" type="text" placeholder="Kata Kunci" style="width: 150px;"/>
	<span>Dari tanggal</span>
	<input type="text" id="datepickerStart">
	<span>sampai</span>
	<input type="text" id="datepickerEnd">
    <a href="javascript:void(0)" class="easyui-linkbutton" iconCls="icon-reload" onclick="ActTerminal.refreshgrid()">Refresh</a>
</div>

<?php
$v->foot();
?>
