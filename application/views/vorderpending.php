<?php
require_once(APPPATH.'views/template.php');
$v = new Template();
$v->head();?>
<script type="text/javascript">
$(function() {
    $.ajax({url: "taximapsorderpending", collapsed:"true"}).done(function(html){
         $("#vmaps_pending").append(html);
    });
});
 //$('#vmaps_pending').html('taximaps');
</script>
<style>
</style>
<?php $v->main(); ?>

<div class="easyui-layout" data-options="fit:true,plain:true">
    <div data-options="region:'east',split:false" title="Peta Taksi" style="width:630px;">
        <div id="vmaps_pending"></div>
    </div>
    <div data-options="region:'center',split:false, plain:true" style="min-width:200px;">
        <table id="gorderpending" class="easyui-datagrid" toolbar="#bar"></table>
        <div id="bar" class="color-gradient">
            <span>Berdasarkan :</span>
            <select id="terminalsearch" panelHeight="auto" style="width:auto;">
                <option value="">- Pilih ? - </option>
                <option value="name">Nama</option>
            </select>
            <input id="terminalkeyword" type="text" placeholder="Kata Kunci" style="width: 150px;"/>
            <a href="javascript:void(0)" class="easyui-linkbutton" iconCls="icon-reload" onClick="window.location.reload();">Refresh</a>
        </div>
    </div>


</div>
<!-- CREATE DRIVERS -->
<div id="dlgKonfirmasi" class="easyui-dialog" data-options="modal:true,closed:true,resizable:true,maximizable:true" style="width:350px;height:425px;padding:10px 20px;"
     closed="true" buttons="#drivers-buttons6">
    <!-- <div class="ftitle">Konfirmasi Pemesanan</div> -->
    <form id="fCPemesanan" method="post" role="form">
        <div class="fitem">
            <label> NAMA : </label>
            <input type="text" name="name" placeholder="NIK" required class="easyui-validatebox" data-options="required:true" readonly/>
        </div>
        <div class="fitem">
            <label> ALAMAT : </label>
            <input type="text" name="addrs_pickup" placeholder="NIK" required class="easyui-validatebox" data-options="required:true" readonly/>
        </div>
        <div class="fitem">
            <label> ALAMAT CLUE : </label>
            <input type="text" name="addrs_clue" placeholder="NIK" required class="easyui-validatebox" data-options="required:true" readonly/>
        </div>
        <div class="fitem">
            <label> NO TELP : </label>
            <input type="text" name="phone_number" placeholder="NIK" required class="easyui-validatebox" data-options="required:true" readonly/>
        </div>
        <div class="fitem">
            <label> KODE TAKSI : </label>
            <input type="text" name="taxi_number" id="taxi_number" placeholder="KODE TAKSI" required class="easyui-validatebox" data-options="required:true" readonly/>
        </div>
    </form>
    <div id="drivers-buttons6">
        <a href="javascript:void(0)" class="easyui-linkbutton" iconCls="icon-ok" onclick="javascript:$('#dlgKonfirmasi').dialog('close')">Tutup</a>
    </div>
</div>
<div id="dlgKonfirmasiBatal" class="easyui-dialog" data-options="modal:true,closed:true,resizable:true,maximizable:true" style="width:350px;height:460px;padding:10px 20px;"
     closed="true" buttons="#drivers-buttons5">
    <div class="ftitle">Konfirmasi Pembatalan</div>
    <form id="fCPemesananBatal" method="post" role="form">
        <div class="fitem">
            <label> NAMA : </label>
            <input type="text" name="name" placeholder="NIK" required class="easyui-validatebox" data-options="required:true" readonly/>
        </div>
        <div class="fitem">
            <label> ALAMAT : </label>
            <input type="text" name="addrs_pickup" placeholder="NIK" required class="easyui-validatebox" data-options="required:true" readonly/>
        </div>
        <div class="fitem">
            <label> ALAMAT CLUE : </label>
            <input type="text" name="addrs_clue" placeholder="NIK" required class="easyui-validatebox" data-options="required:true" readonly/>
        </div>
        <div class="fitem">
            <label> NO TELP : </label>
            <input type="text" name="phone_number" placeholder="NIK" required class="easyui-validatebox" data-options="required:true" readonly/>
        </div>
        <div class="fitem">
            <label> ALASAN : </label>
            <input type="text" name="description" placeholder="Alasan" required class="easyui-validatebox" data-options="required:true" readonly/>
        </div>
    </form>
    <div id="drivers-buttons5">
        <a href="javascript:void(0)" class="easyui-linkbutton" iconCls="icon-ok" onclick="javascript:$('#dlgKonfirmasiBatal').dialog('close')">Tutup</a>
    </div>
</div>
<!-- CREATE DRIVERS -->
<div id="dlgProsesBatal" class="easyui-dialog" data-options="modal:true,closed:true,resizable:true,maximizable:true" style="width:350px;height:150px;padding:10px 20px;"
     closed="true" buttons="#drivers-buttons7">
    <div class="ftitle">Pemesanan Batal</div>
    <form id="fProsBatal" method="post" role="form">
        <div class="fitem">
            <input type="hidden" name="name" placeholder="NIK" required class="easyui-validatebox" data-options="required:true" readonly/>
            <input type="hidden" name="addrs_clue" placeholder="NIK" required class="easyui-validatebox" data-options="required:true" readonly/>
            <input type="hidden" name="addrs_pickup" placeholder="NIK" required class="easyui-validatebox" data-options="required:true" readonly/>
            <input type="hidden" name="id_req_taxi" placeholder="NIK" required class="easyui-validatebox" data-options="required:true" readonly/>
            <input type="hidden" name="longitude" placeholder="NIK" required class="easyui-validatebox" data-options="required:true" readonly/>
            <input type="hidden" name="latitude" placeholder="NIK" required class="easyui-validatebox" data-options="required:true" readonly/>
            <input type="hidden" name="phone_number" placeholder="NIK" required class="easyui-validatebox" data-options="required:true" readonly/>
            <input type="hidden" name="time_req" placeholder="NIK" required class="easyui-validatebox" data-options="required:true" readonly/>
            <input type="hidden" name="sc" value="50" placeholder="NIK" required class="easyui-validatebox" data-options="required:true" readonly/>
        </div>
        <div class="fitem">
            <label> (*) Alasan :</label>
            <input type="text" name="cause" placeholder="Alasan" required class="easyui-validatebox" data-options="required:true"/>
        </div>
    </form>
    <div id="drivers-buttons7">
        <a href="javascript:void(0)" class="easyui-linkbutton" iconCls="icon-ok" onclick="jOrderpending.insertBatal('orderpending/update_status')">Simpan</a>
        <a href="javascript:void(0)" class="easyui-linkbutton" iconCls="icon-cancel" onclick="javascript:$('#dlgProsesPemesanan').dialog('close')">Batal</a>
    </div>
</div>

<!-- CREATE DRIVERS -->
<div id="dlgProsesPemesanan" class="easyui-dialog" data-options="modal:true,closed:true,resizable:true,maximizable:true" style="width:350px;height:200px;padding:10px 20px;"
     closed="true" buttons="#drivers-buttons">
<!--     <div class="ftitle">Proses Pemesanan</div> -->
    <form id="fProsPemesanan" method="post" role="form">
        <div class="fitem">
            <input type="hidden" name="name" placeholder="NIK" required class="easyui-validatebox" data-options="required:true" readonly/>
            <input type="hidden" name="addrs_clue" placeholder="NIK" required class="easyui-validatebox" data-options="required:true" readonly/>
            <input type="hidden" name="addrs_pickup" placeholder="NIK" required class="easyui-validatebox" data-options="required:true" readonly/>
            <input type="hidden" name="id_req_taxi" placeholder="NIK" required class="easyui-validatebox" data-options="required:true" readonly/>
            <input type="hidden" name="longitude" placeholder="NIK" required class="easyui-validatebox" data-options="required:true" readonly/>
            <input type="hidden" name="latitude" placeholder="NIK" required class="easyui-validatebox" data-options="required:true" readonly/>
            <input type="hidden" name="phone_number" placeholder="NIK" required class="easyui-validatebox" data-options="required:true" readonly/>
            <input type="hidden" name="time_req" placeholder="NIK" required class="easyui-validatebox" data-options="required:true" readonly/>
            <input type="hidden" name="sc" value="00" placeholder="NIK" required class="easyui-validatebox" data-options="required:true" readonly/>
        </div>
        <div class="fitem">
            <label> (*) Kode Taksi :</label>
                <select class="easyui-combobox" name="kode">
                <?php
					foreach ($taxiId as $key) {
                        echo "<option selected value=".$key->taxinumber.">".$key->taxinumber."</option>";
                    }
                ?>
                </select>
        </div>
    </form>
    <div id="drivers-buttons">
        <a href="javascript:void(0)" class="easyui-linkbutton" iconCls="icon-ok" onclick="jOrderpending.insertSukses('orderpending/update_status')">Simpan</a>
        <a href="javascript:void(0)" class="easyui-linkbutton" iconCls="icon-cancel" onclick="javascript:$('#dlgProsesPemesanan').dialog('close')">Batal</a>
    </div>
</div>
<script type="text/javascript" src="<?php echo base_url('statics/js/orderpending_25092014G3.min.js'); ?>"></script>
<script type="text/javascript">
$(function(){ 
    jOrderpending.init("<?php echo $taxixkey; ?>");
});
</script>
<?php
$v->foot();
?>
