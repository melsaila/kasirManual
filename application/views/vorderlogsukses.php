<?php
require_once(APPPATH.'views/template.php');
$v = new Template();
$v->head();?>
<script type="text/javascript" src="<?php echo base_url('statics/js/orderlogsukses_25092014A.min.js'); ?>"></script>
<script type="text/javascript">
$(function() {
    jOrderlogsukses.init("<?php echo $taxixkey; ?>");
});
</script>

<?php $v->main(); ?>
<table id="gorderlogsukses" class="easyui-datagrid" toolbar="#bar"></table>
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
    <a href="javascript:void(0)" class="easyui-linkbutton" iconCls="icon-reload" onclick="ActTerminal.refreshgrid()">Refresh</a>
</div>

<?php
$v->foot();
?>
