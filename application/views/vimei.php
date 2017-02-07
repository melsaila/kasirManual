<?php
require_once(APPPATH.'views/template.php');
$v = new Template();
$v->head();?>
<script type="text/javascript" src="<?php echo base_url('statics/js/imei08A.min.js'); ?>"></script>
<?php $v->main(); ?>
<table id="gimei" class="easyui-datagrid" toolbar="#bar"></table>
<div id="bar" class="color-gradient">
    <span>Berdasarkan :</span>
    <select id="terminalsearch" panelHeight="auto" style="width:auto;">
        <option value=""> Pilih ? </option>
        <option value="imei">IMEI</option>
        <!--<option value="mobile">No. Telp</option>
        <option value="taxi_number">No. Taksi</option> -->
    </select>
    <input id="terminalkeyword" type="text" placeholder="Kata Kunci" style="width: 150px;"/>
    <a href="javascript:void(0)" class="easyui-linkbutton" iconCls="icon-reload" onclick="window.location.reload();">Refresh</a>
    <div>
        <a href="javascript:void(0)" class="easyui-linkbutton" iconCls="icon-add" plain="true" onclick="jImei.dlginsert()">Daftar Imei</a>
        <a href="javascript:void(0)" class="easyui-linkbutton" iconCls="icon-edit" plain="true" onclick="jImei.dlgupt()">Edit Imei</a>
        <a href="javascript:void(0)" class="easyui-linkbutton" iconCls="icon-remove" plain="true" onclick="jImei.del('imei/delete')">Hapus Imei</a>
    </div>
</div>
<div id="dlgiimei" class="easyui-dialog" data-options="modal:true,closed:true,resizable:true,maximizable:true" style="width:350px;height:400px;padding:10px 20px;"
     closed="true" buttons="#drivers-buttons1">
    <div class="ftitle">Informasi IMEI</div>
    <form id="fcimei" method="post" role="form">
        <div class="fitem">
            <label> IMEI : </label>
            <input type="text" name="imei" placeholder="IMEI" required class="easyui-validatebox" data-options="required:true"/>

        </div>
        <!-- <div class="fitem">
            <label> No Taksi : </label>
            <select class="easyui-combobox" name="taxi_number">
                <?php
                    foreach ($taxi_number as $key) {
                        echo "<option value=".$key->id_car.">".$key->taxi_number."</option>";
                    }
                ?>
            </select>
        </div>
        <div class="fitem">
            <label> No. Telp : </label>
            <input type="text" name="mobile" placeholder="No.telp" required class="easyui-validatebox" data-options="required:true"/>
        </div> -->
    </form>
    <div id="drivers-buttons">
        <a href="javascript:void(0)" class="easyui-linkbutton" iconCls="icon-ok" onclick="jImei.insert('imei/insert')">Simpan</a>
        <a href="javascript:void(0)" class="easyui-linkbutton" iconCls="icon-cancel" onclick="javascript:$('#dlgiimei').dialog('close')">Batal</a>
    </div>
</div>

<div id="dlgeimei" class="easyui-dialog" data-options="modal:true,closed:true,resizable:true,maximizable:true" style="width:350px;height:400px;padding:10px 20px;"
     closed="true" buttons="#drivers-buttons2">
    <div class="ftitle">Informasi IMEI</div>
    <form id="feimei" method="post" role="form">
            <input type="hidden" name="id" placeholder="IMEI" required class="easyui-validatebox" data-options="required:true"/>
       <div class="fitem">
            <label> IMEI : </label>
            <input type="text" name="uniqueid" placeholder="IMEI" required class="easyui-validatebox" data-options="required:true"/>
            <input type="hidden" name="registerdate" placeholder="IMEI" required class="easyui-validatebox" data-options="required:true"/>
            <input type="hidden" id="tempuniqueid" name="tempuniqueid" placeholder="IMEI" required class="easyui-validatebox" data-options="required:true"/>
        </div>
        <div class="fitem">
            <label> Taksi : </label>
            <select class="easyui-combobox" name="taxi_number">
                <?php
                    foreach ($taxi_number as $key) {
                        echo "<option value=".$key->id_car.">".$key->taxi_number."</option>";
                    }
                ?>
            </select>
        </div>
        <div class="fitem">
            <label> No. Telp : </label>
            <input type="text" name="mobile" placeholder="No.telp" required class="easyui-validatebox" data-options="required:true"/>
        </div>
    </form>
    <div id="drivers-buttons">
        <a href="javascript:void(0)" class="easyui-linkbutton" iconCls="icon-ok" onclick="jImei.update('imei/update')">Simpan</a>
        <a href="javascript:void(0)" class="easyui-linkbutton" iconCls="icon-cancel" onclick="javascript:$('#dlgeimei').dialog('close')">Batal</a>
    </div>
</div>
<script type="text/javascript">
$(function() {
    jImei.init("<?php echo $taxixkey; ?>");
    jImei.grid();
});
</script>
<?php
$v->foot();
?>
