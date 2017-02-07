<?php
require_once(APPPATH.'views/template.php');
$v = new Template();
$v->head();?>


<?php $v->main(); ?>
<table id="gdrivers" toolbar="#bar"></table>
<div id="bar" class="color-gradient">
    <span>Berdasarkan :</span>
    <select id="terminalsearch" panelHeight="auto" style="width:auto;">
        <option value=""> Pilih ? </option>
        <option value="nik">NIK</option>
        <option value="username">Nama</option>
        <option value="phone">Telepon</option>
    </select>
    <input id="terminalkeyword" type="text" placeholder="Kata Kunci" style="width: 150px;"/>
    <a href="javascript:void(0)" class="easyui-linkbutton" iconCls="icon-reload" onclick="window.location.reload();">Refresh</a>
    <div>
        <a href="javascript:void(0)" class="easyui-linkbutton" iconCls="icon-add" plain="true" onclick="jDrivers.dlginsert()">Daftar Sopir</a>
        <a href="javascript:void(0)" class="easyui-linkbutton" iconCls="icon-edit" plain="true" onclick="jDrivers.dlgupt()">Edit Sopir</a>
        <a href="javascript:void(0)" class="easyui-linkbutton" iconCls="icon-remove" plain="true" onclick="jDrivers.del('drivers/delete')">Hapus Sopir</a>
    </div>
</div>
<!-- CREATE DRIVERS -->
<div id="dlgidrivers" class="easyui-dialog" data-options="modal:true,closed:true,resizable:true,maximizable:true" style="width:350px;height:480px;padding:10px 20px;"
     closed="true" buttons="#drivers-buttons">
    <div class="ftitle">Informasi Sopir</div>
    <form id="fcdrivers" method="post" role="form">
        <div class="fitem">
            <label> (*) NIK : </label>
            <input type="text" name="nik" placeholder="NIK" required class="easyui-validatebox" data-options="required:true"/>
        </div>
        <!-- <div class="fitem">
            <label> (*) Jenis Kelamin :</label>
            <span>Laki-laki <input type="radio" name="sex" value="laki" title="Laki-laki"/></span>
            <span>Perempuan <input type="radio" name="sex" value="perempuan" title="Perempuan"/></span>
        </div> -->
        <div class="fitem">
            <label> (*) Nama Lengkap :</label>
            <input type="text" name="fullname" placeholder="Nama Lengkap" class="easyui-validatebox" data-options="required:true"/>
        </div>
        <!-- <div class="fitem">
            <label> (*) Status :</label>
            <span>Lajang <input type="radio" name="marital" value="lajang" title="Lajang"/></span>
            <span>Menikah <input type="radio" name="marital" value="kawin" title="Menikah"/></span>
        </div> 
        <div class="fitem">
            <label> (*) Tanggal Lahir:</label>
            <input type="text" name="birthday" placeholder="Tanggal Lahir" class="easyui-datebox" data-options="required:true"/>
        </div> -->
        <div class="fitem">
            <label> (*) Nomor HP :</label>
            <input type="text" name="phone" placeholder="Telepon" class="easyui-validatebox" data-options="required:true"/>
        </div>
        <div class="fitem">
            <label> (*) Alamat :</label>
            <input type="text" name="addrs" placeholder="Alamat" class="easyui-validatebox" data-options="required:true"/>
        </div>
		<div class="fitem">
            <label> (*) Email :</label>
            <input type="text" name="email" placeholder="Email" class="easyui-validatebox" data-options="required:true"/>
        </div>
		<div class="fitem">
            <label> (*) Username :</label>
            <input type="text" name="username" placeholder="Username" class="easyui-validatebox" data-options="required:true"/>
        </div>
		<div class="fitem">
            <label> (*) Imei HP :</label>
			<input type="text" name="imei" placeholder="Imei" class="easyui-validatebox" data-options="required:true"/>
        </div>
		<div class="fitem">
            <label> (*) No. Taksi :</label>
                <select class="easyui-combobox" name="kode">
                <?php
					foreach ($taxiId as $key) {
                        echo "<option selected value=".$key->taxinumber.">".$key->taxinumber."</option>";
                    }
                ?>
                </select>
        </div>
        <!-- <div class="fitem">
            <label> (*) Kode Taksi :</label>
                <select class="easyui-combobox" name="taxi_number"> -->
                <?php
                    //foreach ($taxi_nomber as $key) {
                        //echo "<option selected value=".$key->id_car.">".$key->taxi_number."</option>";
                    //}
                ?>
                <!-- </select>
        </div> -->
    </form>
    <div id="drivers-buttons">
        <a href="javascript:void(0)" class="easyui-linkbutton" iconCls="icon-ok" onclick="jDrivers.insert('drivers/insert')">Simpan</a>
        <a href="javascript:void(0)" class="easyui-linkbutton" iconCls="icon-cancel" onclick="javascript:$('#dlgidrivers').dialog('close')">Batal</a>
    </div>
</div>
<!-- UPDATE DRIVERS -->
<div id="dlgedrivers" class="easyui-dialog" data-options="modal:true,closed:true,resizable:true,maximizable:true" style="width:350px;height:430px;padding:10px 20px;"
     closed="true" buttons="#drivers-buttons">
    <div class="ftitle">Informasi Sopir</div>
    <form id="fedrivers" method="post" role="form">
        <div class="fitem">
            <label> (*) NIK : </label>
            <input type="text" name="nik" placeholder="NIK" required class="easyui-validatebox" data-options="required:true" readonly/>
        </div>
        <!-- <div class="fitem">
            <label> (*) Jenis Kelamin :</label>
            <span>Laki-laki <input type="radio" name="sex" value="laki" title="Laki-laki"/></span>
            <span>Perempuan <input type="radio" name="sex" value="perempuan" title="Perempuan"/></span>
        </div> -->
        <div class="fitem">
            <label> (*) Nama Lengkap :</label>
            <input type="text" name="fullname" placeholder="Fullname" class="easyui-validatebox" data-options="required:true" readonly/>
        </div>
		<div class="fitem">
            <label> (*) Username :</label>
            <input type="text" name="username" placeholder="Username" class="easyui-validatebox" data-options="required:true" readonly/>
        </div>
        <!-- <div class="fitem">
            <label> (*) Status :</label>
            <span>Lajang <input type="radio" name="marital" value="lajang" title="Lajang"/></span>
            <span>Menikah <input type="radio" name="marital" value="kawin" title="Menikah"/></span>
        </div> 
        <div class="fitem">
            <label> (*) Tanggal Lahir:</label>
            <input type="text" name="birthday" placeholder="Tanggal Lahir" class="easyui-datebox" data-options="required:true"/>
        </div> -->
        <div class="fitem">
            <label> (*) Telepon :</label>
            <input type="text" name="phone" placeholder="Telepon" class="easyui-validatebox" data-options="required:true" />
        </div>
        <div class="fitem">
            <label> (*) Alamat :</label>
            <input type="text" name="address" placeholder="Alamat" class="easyui-validatebox" data-options="required:true"/>
        </div>
		<div class="fitem">
            <label> (*) Email :</label>
            <input type="text" name="email" placeholder="email" class="easyui-validatebox" data-options="required:true"/>
        </div>
		<!--<div class="fitem">
            <label> (*) Perusahaan :</label>
			    <select class="easyui-combobox" name="taxi_number">
                <?php
                    foreach ($drivernumber as $key) {
                        echo "<option selected value=".$key->id_car.">".$key->taxi_number."</option>";
                    }
                ?>
                </select>
        </div>-->
    </form>
    <div id="drivers-buttons">
        <a href="javascript:void(0)" class="easyui-linkbutton" iconCls="icon-ok" onclick="jDrivers.update('drivers/update')">Simpan</a>
        <a href="javascript:void(0)" class="easyui-linkbutton" iconCls="icon-cancel" onclick="javascript:$('#dlgedrivers').dialog('close')">Batal</a>
    </div>
</div>
<script type="text/javascript" src="<?php echo base_url('statics/js/driver02.min.js'); ?>"></script>
<script type="text/javascript">
$(function() {
    jDrivers.init("<?php echo $taxixkey; ?>");
});
</script>
<?php
$v->foot();
?>
