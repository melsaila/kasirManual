<?php
require_once(APPPATH.'views/template.php');
$v = new Template();
$v->head();?>
<script type="text/javascript" src="<?php echo base_url('statics/js/taxidevices_25092014.min.js'); ?>"></script>
<script type="text/javascript">
$(function(){
jTxidvce.init("<?php echo $taxixkey; ?>");
jTxidvce.grid();
});
</script>
<?php $v->main(); ?>
<table id="gtaxidevices" class="easyui-datagrid" toolbar="#bar"></table>
<div id="bar" class="color-gradient">
    <span>Berdasarkan :</span>
    <select id="terminalsearch" panelHeight="auto" style="width:auto;">
        <option value="">- Pilih ? - </option>
        <option value="taxi_no">No.Taksi</option>
        <option value="polisi_no">No.Polisi</option>
        <option value="uniqueid">Imei</option>
        <option value="status">Status</option>
    </select>
    <input id="terminalkeyword" type="text" placeholder="Kata Kunci" style="width: 150px;"/>
    <a href="javascript:void(0)" class="easyui-linkbutton" iconCls="icon-reload" onclick="ActTerminal.refreshgrid()">Refresh</a>
    <div>
        <a href="javascript:void(0)" class="easyui-linkbutton" iconCls="icon-add" plain="true" onclick="jTxidvce.dlginserttaxi()">Daftar Taksi</a>
        <a href="javascript:void(0)" class="easyui-linkbutton" iconCls="icon-edit" plain="true" onclick="jTxidvce.dlgupt()">Edit Taksi</a>
        <a href="javascript:void(0)" class="easyui-linkbutton" iconCls="icon-edit" plain="true" onclick="jTxidvce.dlgaddtxdevice()">Tugaskan Perangkat Taksi</a>
        <a href="javascript:void(0)" class="easyui-linkbutton" iconCls="icon-edit" plain="true" onclick="jTxidvce.deltxdevice('taxidevices/delimeitaxi')">Hapus Perangkat Taksi</a>
        <a href="javascript:void(0)" class="easyui-linkbutton" iconCls="icon-edit" plain="true" onclick="jTxidvce.deltaxi('taxidevices/deltaxi')">Hapus Taksi</a>
    </div>
</div>
<div id="dlgitaxi" class="easyui-dialog" data-options="modal:true,closed:true,resizable:true,maximizable:true" style="width:350px;height:360px;padding:10px 20px;"
     closed="true" buttons="#drivers-buttons">
    <div class="ftitle">Informasi Taksi</div>
    <form id="fctaxi" method="post" role="form">
        <div class="fitem">
            <label> No Taksi : </label>
            <input type="text" name="taxi_number" placeholder="No.Taksi" required class="easyui-validatebox" data-options="required:true"/>
        </div>
        <div class="fitem">
            <label> No.Polisi :</label>
            <input type="text" name="nomor_polisi" placeholder="No.Polisi" class="easyui-validatebox" data-options="required:true"/>
        </div>
        <div class="fitem">
            <label> Perangkat :
                <span>
                    <a href="javascript:void(0)" class="easyui-linkbutton" iconCls="icon-add" onclick="jTxidvce.dlginsertdevice('drivers/delete')" data-options="plain:true">Daftar Perangkat</a>
                <span>
            </label>
            <select name="imei"></select>
        </div>
    </form>
    <div id="drivers-buttons">
        <a href="javascript:void(0)" class="easyui-linkbutton" iconCls="icon-ok" onclick="jTxidvce.inserttaxi('taxidevices/inserttaxi')">Simpan</a>
        <a href="javascript:void(0)" class="easyui-linkbutton" iconCls="icon-cancel" onclick="javascript:$('#dlgitaxi').dialog('close')">Batal</a>
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
        <a href="javascript:void(0)" class="easyui-linkbutton" iconCls="icon-ok" onclick="jTxidvce.insertdevice('taxidevices/insertdevice')">Simpan</a>
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
                    <a href="javascript:void(0)" class="easyui-linkbutton" iconCls="icon-add" onclick="jTxidvce.dlginsertdevice('drivers/delete')" data-options="plain:true">Create Device</a>
                <span>
            </label>
            <select name="imei"></select>
            <input type="hidden" name="nik" readonly/>
        </div>
    </form>
    <div id="drivers-buttons">
        <a href="javascript:void(0)" class="easyui-linkbutton" iconCls="icon-ok" onclick="jTxidvce.addtxdevice('taxidevices/addtaxidevice')">Simpan</a>
        <a href="javascript:void(0)" class="easyui-linkbutton" iconCls="icon-cancel" onclick="javascript:$('#dlgaddtxdvc').dialog('close')">Batal</a>
    </div>
</div>
<?php
$v->foot();
?>
