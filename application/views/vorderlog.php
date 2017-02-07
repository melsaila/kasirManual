<?php
require_once(APPPATH.'views/template.php');
$v = new Template();
$v->head();?>
<script type="text/javascript" src="<?php echo base_url('statics/js/orderlog_25092014A.min.js'); ?>"></script>
<?php $v->main(); ?>
<table id="gorderlog" class="easyui-datagrid" toolbar="#bar"></table>
<div id="bar" class="color-gradient">
    <span>Berdasarkan :</span>
    <select id="terminalsearch" panelHeight="auto" style="width:auto;">
        <option value="">- Pilih ? - </option>
        <option value="name">Nama</option>
        <option value="addrs_pickup">Alamat</option>
        <option value="addrs_clue">Alamat Clue</option>
        <option value="phone_number">Telepon</option>
    </select>
    <input id="terminalkeyword" type="text" placeholder="Kata Kunci" style="width: 150px;"/>
    <a href="javascript:void(0)" class="easyui-linkbutton" iconCls="icon-reload" onclick="ActTerminal.refreshgrid()">Refresh</a>
</div>
<script type="text/javascript">
$(function() {
    jOrderlog.init("<?php echo $taxixkey; ?>");
});
</script>
<?php
$v->foot();
?>
