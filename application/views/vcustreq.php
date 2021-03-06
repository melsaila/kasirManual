<?php
require_once(APPPATH.'views/template.php');
$v = new Template();
$v->head();?>
<script type="text/javascript" src="<?php echo base_url('statics/js/custreqs_08072014b.min.js'); ?>"></script>
<script type="text/javascript">
$(function() {
    jCustreq.init("<?php echo $taxixkey; ?>");
    jCustreq.grid();
});
</script>
<?php $v->main(); ?>
<table id="gcustreq" class="easyui-datagrid" toolbar="#bar"></table>
<div id="bar" class="color-gradient">
    <span>Berdasarkan :</span>
    <select id="terminalsearch" panelHeight="auto" style="width:auto;">
        <option value="">- Pilih ? - </option>
        <option value="daftar_area.nama_area">Area</option>
        <option value="daftar_cabang.nama_cabang">Cabang</option>
        <option value="filter.tid">TID</option>
        <option value="filter.mid">MID</option>
    </select>
    <input id="terminalkeyword" type="text" placeholder="Kata Kunci" style="width: 150px;"/>
    <a href="javascript:void(0)" class="easyui-linkbutton" iconCls="icon-reload" onclick="ActTerminal.refreshgrid()">Refresh</a>
</div>
<?php
$v->foot();
?>
