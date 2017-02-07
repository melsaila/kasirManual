<?php if (! defined ( 'BASEPATH' )) exit ( 'No direct script access allowed' );
echo doctype('html5');?>
<html lang="en">
<head>
<title>Taksi Management | Taksi-X</title>
<meta charset="UTF-8" />
<meta http-equiv="X-UA-Compatible" content="IE=edge,chrome=1">
<?php
$meta = array(
        array('name' => 'Content-type', 'content' => 'text/html', 'type' => 'equiv'),
        array('name' => 'robots', 'content' => 'no-cache'),
        array('name' => 'description', 'content' => 'KSS Collection Management'),
        array('name' => 'keywords', 'content' => 'KSS Collection Management, Sahabat UKM, Collection Management'),
        array('name' => 'viewport', 'content' => 'width=device-width, initial-scale=1.0')
    );
// echo meta($meta);
?>
<!-- <link rel="shortcut icon" href="<?php // echo base_url('library/images/favicon.gif'); ?>" /> -->
<link rel="stylesheet" type="text/css" href="<?php echo base_url('statics/jeasyui/themes/metro/easyui.css'); ?>">
<link rel="stylesheet" type="text/css" href="<?php echo base_url('statics/jeasyui/themes/icon.css'); ?>">
<link rel="stylesheet" type="text/css" href="<?php echo base_url('statics/css/demo.css'); ?>">
<link rel="stylesheet" type="text/css" href="<?php echo base_url('statics/css/jquery.treeview.css'); ?>">
<link rel="stylesheet" type="text/css" href="<?php echo base_url('statics/css/bootstrap.css');?>" media="all"/>
<link rel="stylesheet" type="text/css" href="<?php echo base_url('statics/css/font-awesome.min.css');?>"/>

<link rel="stylesheet" type="text/css" href="<?php echo base_url('statics/css/menustyles.css');?>" media="all"/>
<script type="text/javascript" src="<?php echo base_url('statics/js/jquery-1.8.2.min.js'); ?>"></script>
<script type="text/javascript" src="<?php echo base_url('statics/js/jquery.easyui.min.js'); ?>"></script>
<script type="text/javascript" src="<?php echo base_url('statics/js/jquery.treeview.js'); ?>"></script>
<script type="text/javascript" src="<?php echo base_url('statics/js/global05.min.js'); ?>"></script>
<script type="text/javascript" src="<?php echo base_url('statics/js/menuscript.js')?>"></script>
<script type="text/javascript" src="<?php echo base_url('statics/js/bootstrap.min.js'); ?>"></script>

<script type="text/javascript">
"use strict";
$.parser.onComplete = function() {
    $("body").css("visibility", "visible");
    window.parent.$.messager.progress("close")
};
function gsite(){
    var glb = new Gtaxi();
    return glb;
}
function addTabs(b, d) {
    var hh = new Gtaxi();
    var u = "",
        c = "",
        a = "",
        e = "",
        g = "",
        f = "",
        i = "",
        j = "";
    i = b;
    u = gsite().site_url(i);
    j = d;
    c = '<iframe scrolling="auto" frameborder="0" src="' + u + '" style="width:100%;height:99%;"></iframe>';
    a = $("#tt").tabs("getSelected");
    e = $("#tt").tabs("getTabIndex", a);
    g = d;
    if (e === -1) {
        f = $.messager.progress({
            title: "Please waiting",
            msg: "Loading data..."
        });
        $("#tt").tabs("add", {
            title: g,
            content: c,
            fit: true,
            closable: true,
            tabWidth: 180
        })
    } else {
        if (e >= 0) {
            $("#tt").tabs("update", {
                tab: a,
                options: {
                    title: g,
                    content: c,
                    fit: true,
                    closable: true,
                    tabWidth: 180
                }
            })
        }
    }
}

function signout() {
    var a = "";
    a = gsite().site_url("login/dologout");
    $(location).attr("href", a)
}
var TaksiHome = function() {
    var t = "",
        e = "",
        j = "",
        g = "",
        c = "",
        a = false,
        f = "",
        i = "";
    g = '<?php echo date("F d, Y H:i:s", time()); ?>';
    e = new Array("Januari", "Februari", "Maret", "April", "Mei", "Juni", "Juli", "Agustus", "September", "Oktober", "November", "Desember");
    j = new Date(g);

    function b(k) {
        var d = "";
        d = (k.toString().length == 1) ? "0" + k : k;
        return d
    }

    return {
        displaytime: function() {
            var d = "",
                l = "",
                k = "";
            j.setSeconds(j.getSeconds() + 1);
            d = b(j.getDate()) + " " + e[j.getMonth()] + " " + j.getFullYear();
            l = b(j.getHours()) + ":" + b(j.getMinutes()) + ":" + b(j.getSeconds());
            k = b(j.getHours()) + ":" + b(j.getMinutes());
            document.getElementById("waktu").innerHTML = d + " " + l + " WIB"
        },
        kssmenus: function() {
            $("#ksstreemenu").treeview({
                animated: "fast",
                collapsed: true,
                unique: true
            });
        },
        dialog: function() {
            $("#dlgprofile").dialog("open").dialog("setTitle", "Informasi Profil");
            document.forms.fprofile.reset()
        },
        change: function(d) {
            i = d;
            a = $("#fprofile").form("validate");
            if (a) {
                $.ajax({
                    url: gsite().site_url(i),
                    data: $('form[id="fprofile"]').serialize(),
                    type: "post",
                    cache: false,
                    success: function(k) {
                        f = $.parseJSON(k);
                        if (f.result == "success") {
                            $("#dlgprofile").dialog("close");
                            $.messager.alert("Update Profil", f.message)
                        } else {
                            $.messager.alert("Update Profil", f.message)
                        }
                    },
                    error: function() {
                        $("#dlgprofile").dialog("close");
                        $.messager.alert("Update Profil", "Profil gagal diupdate.")
                    }
                })
            }
        },
        checkuser: function() {
            h = "";
            $.get(gsite().site_url("login/checklogin"), function(k) {
                h = k
            });
            setTimeout(function() {
                return h
            }, 300)
        }
    }
}();
window.onload = function() {
    setInterval("TaksiHome.displaytime()", 1000);
    addTabs('orderpending','DATA PEMESANAN');
};
$(function() {
    TaksiHome.kssmenus()
});
 // var auto_refresh = setInterval(
 //      function (){
 //       $('#jumlahUnreadMenu').load('<?php echo base_url(); ?>orderpending/getUnread');
 //       $('#jumlahUnreadSubMenu').load('<?php echo base_url(); ?>orderpending/getUnread');
 //       //get_newticket();
 //      }, 2000); // refresh every 10000 milliseconds

</script>
<style type="text/css">
form[id=fprofile] input[type=text]{
    height: 25px;
}
.marks{
text-align: right;
bottom: 0;
position: fixed;
right:0;
padding-right: 20px;
font-size: 13px;
}
.footer{
top: 0;
width: auto;
right: 1%;
position: fixed;
color: #485F70;
}
marquee{
color: #FFF;
white-space: nowrap;
font-size: 17px;
font-weight: lighter;
background-color: #000;
position: static;
padding:3px;
opacity: 0.7;
}
.infologin {
    padding-top: 60px;
    padding-right: 10px;
    text-align: right;
    right: 0;
    color: #ddd;
    font-size: 14px;
}
.infowelcome {
    top: 0;
    position: fixed;
    padding-top: 40px;
    margin-left: 150px;
    left: 0;
    color: #000;
    font-size: 16px;
}
.datagrid-cell span{
    background: #333333;
}
</style>
</head>
<body class="easyui-layout">
    <div data-options="region:'west',split:false,width:255" style="background: #E3E3E3;
  background: -webkit-linear-gradient(#E3E3E3, #E0E0E0);
  background: -moz-linear-gradient(#E3E3E3, #E0E0E0);
  background: -o-linear-gradient(#E3E3E3, #E0E0E0);
  background: -ms-linear-gradient(#E3E3E3, #E0E0E0);
  background: linear-gradient(#E3E3E3, #E0E0E0);
  box-shadow: inset 0 1px 0 rgba(255, 255, 255, 0.15);">
        <div id='cssmenu'>
<!--            <div onclick="javascript:disabled:true;addTabs('orderpending','ORDER PENDING')" id="panel-lonceng">
                <span ><span style="font-size: 20px;" class="fa fa-bell"></span></span>
                
                    <span id='jumlahUnreadMenu' onclick="javascript:disabled:true;addTabs('orderpending','ORDER PENDING')"></span>
                
            </div> -->
            <ul>
               <li><a href="javascript:void(0)" onclick="javascript:disabled:true;addTabs('orderpending','DATA PEMESANAN')"><span><img src="statics/images/log32x32.png"/>&nbsp;&nbsp;&nbsp;DATA PEMESANAN</span></a>
                    <ul>
                        <!-- <li><a href="javascript:void(0)" onclick="javascript:disabled:true;addTabs('orderpending','ORDER PENDING')">Order Pending</a></li> -->
                        <!-- <li><a href="javascript:void(0)" onclick="javascript:disabled:true;addTabs('orderlog','ORDER TERKINI')">Order Terkini</a></li> -->
                    </ul>
                </li>
               <li class='active has-sub'><a href='#'><span><img src="statics/images/taxi32x32.png"/>&nbsp;&nbsp;&nbsp;PENGATURAN TAKSI</span></a>
                    <ul>
                        <li><a href="javascript:void(0)" onclick="javascript:disabled:true;addTabs('drivers','SOPIR')">Sopir</a></li>
                        <li><a href="javascript:void(0)" onclick="javascript:disabled:true;addTabs('cars','TAKSI')">Taksi</a></li>
                        <!--<li><a href="javascript:void(0)" onclick="javascript:disabled:true;addTabs('imei','IMEI')">Imei</a></li>-->
                        <!--<li><a href="javascript:void(0)" onclick="javascript:disabled:true;addTabs('penugasan','PENUGASAN TAKSI')">Penugasan Taksi</a></li>-->
                    </ul>
               </li>
                <li class='active has-sub'><a href='#'><span><img src="statics/images/history 32x32.png"/>&nbsp;&nbsp;&nbsp;HISTORY PEMESANAN</span></a>
                    <ul>
                        <!-- <li><a href="javascript:void(0)" onclick="javascript:disabled:true;addTabs('orderlog','LOG ORDER')">Log Order</a></li> -->
                        <li><a href="javascript:void(0)" onclick="javascript:disabled:true;addTabs('orderlogsukses','PEMESANAN SUKSES')">Pemesanan Sukses</a></li>
                        <li><a href="javascript:void(0)" onclick="javascript:disabled:true;addTabs('orderlogbatal','PEMESANAN GAGAL')">Pemesanan Gagal</a></li>
                        <!-- <li><a href="javascript:void(0)" onclick="javascript:disabled:true;addTabs('orderpending','ORDER PENDING')">Order Pending</a></li> -->
                        <!-- <li><a href="javascript:void(0)" onclick="javascript:disabled:true;addTabs('orderlog','ORDER TERKINI')">Order Terkini</a></li> -->
                    </ul>
                </li>
                <!--<li ><a href="javascript:void(0)" onclick="javascript:disabled:true;addTabs('reporting','REPORTING')"><span><img src="statics/images/Reports 32x32.png"/>&nbsp;&nbsp;&nbsp;REPORTING</span></a>-->
                    <li class='active has-sub'><a href='#'><span><img src="statics/images/history 32x32.png"/>&nbsp;&nbsp;&nbsp;REPORTING</span></a>
					<ul>
                        <!-- <li><a href="javascript:void(0)" onclick="javascript:disabled:true;addTabs('reporting','SOPIR')">Sopir</a></li> -->
                        <li><a href="javascript:void(0)" onclick="javascript:disabled:true;addTabs('reportinglogsukses','REPORT PEMESANAN SUKSES')">Pemesanan Sukses</a></li>
                        <!--<li><a href="javascript:void(0)" onclick="javascript:disabled:true;addTabs('imei','IMEI')">Imei</a></li> 
                        <li><a href="javascript:void(0)" onclick="javascript:disabled:true;addTabs('penugasan','PENUGASAN TAKSI')">Penugasan Taksi</a></li>-->
                    </ul>
               </li>
               <li><a href="javascript:void(0)" onclick="javascript:disabled:true;addTabs('taximaps','Peta Taksi')"><span><img src="statics/images/globe32x32.png"/>&nbsp;&nbsp;&nbsp;PETA</span></a>
                   <!--  <ul>
                        <li><a href="javascript:void(0)" onclick="javascript:disabled:true;addTabs('taximaps','Peta Taksi')">Peta Taksi</a></li>
                    </ul> -->
               </li>
            </ul>
        </div>
    <div style="padding: 10% 20%">
            <a href="javascript:void(0)" class="btn btn-middle btn-warning" style="font-weight: bold" onclick="signout()"><i class="fa fa-power-off"></i> Log Out</a>
        </div>
    </div>
    <div class="clock"></div>
    <div data-options="region:'center', split:false" style="background: url('statics/images/logo_rr.PNG') no-repeat;background-position: center;width:100%;height:100%">
        <div id="tt" class="easyui-tabs" data-options="tools:'#tab-tools',fit:true, plain:true" style="height: auto;">
        </div>
    </div>
    <div data-options="region:'north',split:false" style="background: url('statics/images/headbanner-01XX.png') no-repeat;height:110px;width:100%;overflow: hidden;">
        <div class="footer">
                <span id="waktu" style="color:#ccc;font-weight:400;"></span>
            </div>
       
        <div class="infologin">
            <?php  echo "<br>Last login, ".$this->session->userdata('last_login'); ?>
        </div>
        <div class="infowelcome">
            <?php echo "Selamat datang, ",$this->session->userdata('cek'); ?>
        </div>
    </div>
</body>
</html>
