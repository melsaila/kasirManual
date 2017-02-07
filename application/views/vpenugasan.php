<?php
require_once(APPPATH.'views/template.php');
$v = new Template();
$v->head();?>
<script type="text/javascript" src="<?php echo base_url('statics/js/penugasan14.min.js'); ?>"></script>
<script type="text/javascript">
$(function(){
jPenugasan.init("<?php echo $taxixkey; ?>");
jPenugasan.grid();
});
</script>
<?php $v->main(); ?>
<table id="gtaxipenugasan" class="easyui-datagrid" toolbar="#bar"></table>
<div id="bar" class="color-gradient">
    <span>Berdasarkan :</span>
    <select id="terminalsearch" panelHeight="auto" style="width:auto;">
        <option value="">- Pilih ? - </option>
        <option value="taxi_no">No.Taksi</option>
        <option value="polisi_no">No.Polisi</option>
        <option value="imei">Imei</option>
        <option value="status">Status</option>
    </select>
    <input id="terminalkeyword" type="text" placeholder="Kata Kunci" style="width: 150px;"/>
    <a href="javascript:void(0)" class="easyui-linkbutton" iconCls="icon-reload" onclick="jPenugasan.refreshgrid()">Refresh</a>
    <div>
        <a href="javascript:void(0)" class="easyui-linkbutton" iconCls="icon-add" plain="true" onclick="jPenugasan.dlgpenugasan()">Penugasan Taksi</a>
        <a href="javascript:void(0)" class="easyui-linkbutton" iconCls="icon-edit" plain="true" onclick="jPenugasan.dlgupt()">Ganti Taksi</a>
        <a href="javascript:void(0)" class="easyui-linkbutton" iconCls="icon-edit" plain="true" onclick="jPenugasan.dlgaddtxdevice()">Ganti Sopir</a>
        <a href="javascript:void(0)" class="easyui-linkbutton" iconCls="icon-edit" plain="true" onclick="jPenugasan.dlgaddtxdevice()">Ganti Perangkat</a>
        <a href="javascript:void(0)" class="easyui-linkbutton" iconCls="icon-remove" plain="true" onclick="jPenugasan.deltxdevice('taxidevices/delimeitaxi')">Hapus Penugasan</a>
    </div>
</div>
<div id="dlgipenugasan" class="easyui-dialog" data-options="modal:true,closed:true,resizable:true,maximizable:true" style="width:350px;height:360px;padding:10px 20px;"
     closed="true" buttons="#drivers-buttons">
    <div class="ftitle">Informasi Penugasan</div>
    <form id="fcpenugasan" method="post" role="form">
        <div class="fitem">
            <label> Taksi : </label>
            <select name='ptaksi' required></select>
        </div>
        <div class="fitem">
            <label> Sopir :</label>
            <select name='psopir' required></select>
        </div>
        <div class="fitem">
            <label> IMEI :</label>
            <select name='pimei' required></select>
        </div>
    </form>
    <div id="drivers-buttons">
        <a href="javascript:void(0)" class="easyui-linkbutton" iconCls="icon-ok" onclick="jPenugasan.addpenugasan('penugasan/addpenugasan')">Simpan</a>
        <a href="javascript:void(0)" class="easyui-linkbutton" iconCls="icon-cancel" onclick="javascript:$('#dlgipenugasan').dialog('close')">Batal</a>
    </div>
</div>
<div id="dlgiimei" class="easyui-dialog" data-options="modal:true,closed:true,resizable:true,maximizable:true" style="width:350px;height:230px;padding:10px 20px;"
     closed="true" buttons="#drivers-buttons">
    <div class="ftitle">Informasi Perangkat</div>
    <form id="fcimei" method="post" role="form">
        <div class="fitem">
            <label> Imei : </label>
            <input type="text" name="imei" placeholder="Imei" required class="easyui-validatebox" data-options="required:true"/>
        </div>
    </form>
    <div id="drivers-buttons">
        <a href="javascript:void(0)" class="easyui-linkbutton" iconCls="icon-ok" onclick="jPenugasan.insertdevice('taxidevices/insertdevice')">Simpan</a>
        <a href="javascript:void(0)" class="easyui-linkbutton" iconCls="icon-cancel" onclick="javascript:$('#dlgiimei').dialog('close')">Batal</a>
    </div>
</div>
<div id="dlgaddtxdvc" class="easyui-dialog" data-options="modal:true,closed:true,resizable:true,maximizable:true" style="width:350px;height:230px;padding:10px 20px;"
     closed="true" buttons="#drivers-buttons">
    <div class="ftitle">Informasi Perangkat</div>
    <form id="faddtxdvc" method="post" role="form">
        <div class="fitem">
            <label> Imei :
                <span>
                    <a href="javascript:void(0)" class="easyui-linkbutton" iconCls="icon-add" onclick="jPenugasan.dlginsertdevice('drivers/delete')" data-options="plain:true">Create Device</a>
                <span>
            </label>
            <select name="imei"></select>
            <input type="hidden" name="nik" readonly/>
        </div>
    </form>
    <div id="drivers-buttons">
        <a href="javascript:void(0)" class="easyui-linkbutton" iconCls="icon-ok" onclick="jPenugasan.addtxdevice('taxidevices/addtaxidevice')">Simpan</a>
        <a href="javascript:void(0)" class="easyui-linkbutton" iconCls="icon-cancel" onclick="javascript:$('#dlgaddtxdvc').dialog('close')">Batal</a>
    </div>
</div>
<?php
$v->foot();
?>
