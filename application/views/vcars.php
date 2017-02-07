<?php
require_once(APPPATH.'views/template.php');
$v = new Template();
$v->head();?>
<script type="text/javascript" src="<?php echo base_url('statics/js/cars07.min.js'); ?>"></script>
<script type="text/javascript">
$(function(){
jCars.init("<?php echo $taxixkey; ?>");
});
</script>
<?php $v->main(); ?>
<table id="gcars" class="easyui-datagrid" toolbar="#bar"></table>
<div id="bar" class="color-gradient">
    <span>Berdasarkan :</span>
    <select id="terminalsearch" panelHeight="auto" style="width:auto;">
        <option value="">- Pilih ? - </option>
        <option value="taxinumber">No.Taksi</option>
        <option value="policenumber">No.Polisi</option>
    </select>
    <input id="terminalkeyword" type="text" placeholder="Kata Kunci" style="width: 150px;"/>
    <a href="javascript:void(0)" class="easyui-linkbutton" iconCls="icon-reload" onclick="window.location.reload();">Refresh</a>
    <div>
        <a href="javascript:void(0)" class="easyui-linkbutton" iconCls="icon-add" plain="true" onclick="jCars.dlginserttaxi()">Daftar Taksi</a>
        <a href="javascript:void(0)" class="easyui-linkbutton" iconCls="icon-edit" plain="true" onclick="jCars.dlgedittaxi()">Edit Taksi</a>
        <!--<a href="javascript:void(0)" class="easyui-linkbutton" iconCls="icon-edit" plain="true" onclick="jCars.dlgaddtxdevice()">Tugaskan Perangkat Taksi</a>
        <a href="javascript:void(0)" class="easyui-linkbutton" iconCls="icon-edit" plain="true" onclick="jCars.deltxdevice('taxidevices/delimeitaxi')">Hapus Perangkat Taksi</a>
        <a href="javascript:void(0)" class="easyui-linkbutton" iconCls="icon-edit" plain="true" onclick="jCars.deltaxi('cars/delete')">Hapus Taksi</a>-->
    </div>
</div>
<div id="dlgitaxi" class="easyui-dialog" data-options="modal:true,closed:true,resizable:true,maximizable:true" style="width:350px;height:280px;padding:10px 20px;"
     closed="true" buttons="#drivers-buttons1">
    <div class="ftitle">Informasi Taksi</div>
    <form id="fctaxi" method="post" role="form">
        <div class="fitem">
            <label> No Taksi : </label>
            <input type="text" name="taxi_number" placeholder="No.Taksi" required class="easyui-validatebox" data-options="required:true"/>
        </div>
        <div class="fitem">
            <label> No.Polisi :</label>
            <input type="text" name="license_plate" placeholder="No.Polisi" class="easyui-validatebox" data-options="required:true"/>
        </div>
		<div class="fitem">
		<label> Tahun :</label>
            <input type="text" name="product_year" placeholder="Tahun" class="easyui-validatebox" data-options="required:true"/>
        </div>
        <div class="fitem">
		<label> Jenis Mobil :</label>
            <input type="text" name="typical_car" placeholder="Jenis Mobil" class="easyui-validatebox"/>
        </div>
        <div class="fitem">
		<label> Status :</label>
            <select name="kode">
			<option value="ST10">Aktif</option>
			<option value="ST11">Non Aktif</option></select>
        </div>
    </form>
    <div id="drivers-buttons">
        <a href="javascript:void(0)" class="easyui-linkbutton" iconCls="icon-ok" onclick="jCars.inserttaxi('cars/insert')">Simpan</a>
        <a href="javascript:void(0)" class="easyui-linkbutton" iconCls="icon-cancel" onclick="javascript:$('#dlgitaxi').dialog('close')">Batal</a>
    </div>
</div>
<div id="dlgetaxi" class="easyui-dialog" data-options="modal:true,closed:true,resizable:true,maximizable:true" style="width:350px;height:230px;padding:10px 20px;"
     closed="true" buttons="#drivers-buttons2">
    <div class="ftitle">Informasi Taksi</div>
    <form id="fetaxi" method="post" role="form">
        <div class="fitem">
            <label> No Taksi : </label>
            <input type="text" name="taxinumber" placeholder="No.Taksi" required class="easyui-validatebox" data-options="required:true" readonly/>
        </div>
        <div class="fitem">
            <label> No.Polisi :</label>
            <input type="text" name="policenumber" placeholder="No.Polisi" class="easyui-validatebox" data-options="required:true"/>
        </div>
		<div class="fitem">
        <label> Tahun :</label>
            <input type="text" name="product_year" placeholder="Tahun Produksi" class="easyui-validatebox" data-options="required:true"/>
        </div>
		<div class="fitem">
        <label> Jenis Mobil :</label>
            <input type="text" name="typical_car" placeholder="Jenis Mobil" class="easyui-validatebox"/>
        </div>
		<div class="fitem">
        <label> Status :</label>
            <select name="car_status">
			<option value="ST10">Aktif</option>
			<option value="ST11">Non Aktif</option></select>
        </div>
        <!--div class="fitem">
            <input type="hidden" name="bought_status" placeholder="No.Polisi" class="easyui-validatebox"/>
        </div>
        <div class="fitem">
            <input type="hidden" name="typical_car placeholder="No.Polisi" class="easyui-validatebox" />
        </div-->
    </form>
    <div id="drivers-buttons">
        <a href="javascript:void(0)" class="easyui-linkbutton" iconCls="icon-ok" onclick="jCars.update('cars/update')">Simpan</a>
        <a href="javascript:void(0)" class="easyui-linkbutton" iconCls="icon-cancel" onclick="javascript:$('#dlgetaxi').dialog('close')">Batal</a>
    </div>
</div>
<div id="dlgaddtxdvc" class="easyui-dialog" data-options="modal:true,closed:true,resizable:true,maximizable:true" style="width:350px;height:230px;padding:10px 20px;"
     closed="true" buttons="#drivers-buttons3">
    <div class="ftitle">Informasi Perangkat</div>
    <form id="faddtxdvc" method="post" role="form">
        <div class="fitem">
            <label> Imei :
                <span>
                    <a href="javascript:void(0)" class="easyui-linkbutton" iconCls="icon-add" onclick="jCars.dlginsertdevice('drivers/delete')" data-options="plain:true">Create Device</a>
                <span>
            </label>
            <select name="imei"></select>
            <input type="hidden" name="nik" readonly/>
        </div>
    </form>
    <div id="drivers-buttons">
        <a href="javascript:void(0)" class="easyui-linkbutton" iconCls="icon-ok" onclick="jCars.addtxdevice('taxidevices/addtaxidevice')">Simpan</a>
        <a href="javascript:void(0)" class="easyui-linkbutton" iconCls="icon-cancel" onclick="javascript:$('#dlgaddtxdvc').dialog('close')">Batal</a>
    </div>
</div>
<?php
$v->foot();
?>
