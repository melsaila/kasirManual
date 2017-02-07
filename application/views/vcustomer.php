<?php
require_once(APPPATH.'views/template.php');
$v = new Template();
$v->head();?>
<script type="text/javascript" src="<?php echo base_url('statics/js/customer_08072014i.min.js'); ?>"></script>
<?php $v->main(); ?>
<table id="gcustomers" class="easyui-datagrid" toolbar="#bar"></table>
<div id="bar" class="color-gradient">
    <span>Berdasarkan :</span>
    <select id="terminalsearch" panelHeight="auto" style="width:auto;">
        <option value=""> --------- </option>
        <option value="daftar_area.nama_area">Area</option>
        <option value="daftar_cabang.nama_cabang">Cabang</option>
        <option value="filter.tid">TID</option>
        <option value="filter.mid">MID</option>
    </select>
    <input id="terminalkeyword" type="text" placeholder="Keyword" style="width: 150px;"/>
    <a href="javascript:void(0)" class="easyui-linkbutton" iconCls="icon-reload" onclick="ActTerminal.refreshgrid()">Refresh</a>
    <div>
        <a href="javascript:void(0)" class="easyui-linkbutton" iconCls="icon-add" plain="true" onclick="jCustomers.dlginsert()">Daftar Pelanggan</a>
        <a href="javascript:void(0)" class="easyui-linkbutton" iconCls="icon-edit" plain="true" onclick="jCustomers.dlgupt()">Edit Pelanggan</a>
        <a href="javascript:void(0)" class="easyui-linkbutton" iconCls="icon-remove" plain="true" onclick="jCustomers.del('customers/delete')">Hapus Pelanggan</a>
    </div>
</div>
<!-- CREATE DRIVERS -->
<div id="dlgicustomer" class="easyui-dialog" data-options="modal:true,closed:true,resizable:true,maximizable:true" style="width:350px;height:400px;padding:10px 20px;"
     closed="true" buttons="#customer-buttons">
    <div class="ftitle">Informasi Driver</div>
    <form id="fccustomer" method="post" role="form">
        <div class="fitem">
            <label> (*) Id Pelanggan: </label>
            <input type="text" name="id_customer" placeholder="ID Pelanggan" class="easyui-validatebox" data-options="required:true"/>
        </div>
        <div class="fitem">
            <label> (*) IMEI : </label>
            <input type="text" name="imei" placeholder="IMEI" class="easyui-validatebox" data-options="required:true"/>
        </div>
        <div class="fitem">
            <label> (*) Nama Lengkap : </label>
            <input type="text" name="name" placeholder="Nama Lengkap" class="easyui-validatebox" data-options="required:true"/>
        </div>
        <div class="fitem">
            <label> (*) Telepon : </label>
            <input type="text" name="mobile_number" placeholder="Telepon" class="easyui-validatebox" data-options="required:true"/>
        </div>
    </form>
    <div id="customer-buttons">
        <a href="javascript:void(0)" class="easyui-linkbutton" iconCls="icon-ok" onclick="jCustomers.insert('customers/insert')">Simpan</a>
        <a href="javascript:void(0)" class="easyui-linkbutton" iconCls="icon-cancel" onclick="javascript:$('#dlgicustomer').dialog('close')">Batal</a>
    </div>
</div>
<!-- CREATE DRIVERS -->
<div id="dlgecustomer" class="easyui-dialog" data-options="modal:true,closed:true,resizable:true,maximizable:true" style="width:350px;height:400px;padding:10px 20px;"
     closed="true" buttons="#customer-buttons">
    <div class="ftitle">Informasi Driver</div>
    <form id="fecustomer" method="post" role="form">
        <div class="fitem">
            <label> (*) Id Pelanggan : </label>
            <input type="text" name="id_customer" placeholder="Id Pelanggan" readonly/>
        </div>
        <div class="fitem">
            <label> (*) IMEI : </label>
            <input type="text" name="imei" placeholder="IMEI" class="easyui-validatebox" data-options="required:true"/>
        </div>
        <div class="fitem">
            <label> (*) Nama Lengkap : </label>
            <input type="text" name="name" placeholder="Nama Lengkap" class="easyui-validatebox" data-options="required:true"/>
        </div>
        <div class="fitem">
            <label> (*) Telepon : </label>
            <input type="text" name="mobile_number" placeholder="Telepon" class="easyui-validatebox" data-options="required:true"/>
        </div>
    </form>
    <div id="customer-buttons">
        <a href="javascript:void(0)" class="easyui-linkbutton" iconCls="icon-ok" onclick="jCustomers.update('customers/update')">Simpan</a>
        <a href="javascript:void(0)" class="easyui-linkbutton" iconCls="icon-cancel" onclick="javascript:$('#dlgecustomer').dialog('close')">Batal</a>
    </div>
</div>
<script type="text/javascript">
$(function() {
    jCustomers.init("<?php echo $taxixkey; ?>");
    jCustomers.grid();
});
</script>
<?php
$v->foot();
?>
