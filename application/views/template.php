<?php if(!defined('BASEPATH')) exit('No direct script access allowed');
class Template{
    public function head(){
        if(!defined('BASEPATH')) exit('No direct script access allowed');
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
        echo meta($meta);
        ?>
        <link rel="stylesheet" type="text/css" href="<?php echo base_url('statics/jeasyui/themes/metro/easyui.css'); ?>">
        <link rel="stylesheet" type="text/css" href="<?php echo base_url('statics/jeasyui/themes/icon.css'); ?>">
        <link rel="stylesheet" type="text/css" href="<?php echo base_url('statics/css/demo.css'); ?>">
        <link rel="stylesheet" type="text/css" href="<?php echo base_url('statics/css/jquery.treeview.css'); ?>">
        <link rel="stylesheet" type="text/css" href="<?php echo base_url('statics/css/bootstrap.css');?>" media="all"/>
        <script type="text/javascript" src="<?php echo base_url('statics/js/jquery-1.8.2.min.js'); ?>"></script>
        <script type="text/javascript" src="<?php echo base_url('statics/js/jquery.easyui.min.js'); ?>"></script>
        <script type="text/javascript" src="<?php echo base_url('statics/js/jquery.treeview.js'); ?>"></script>
        <script type="text/javascript" src="<?php echo base_url('statics/js/global05.min.js'); ?>"></script>
        <script type="text/javascript" src="<?php echo base_url('statics/js/bootstrap-select.js')?>"></script>
        <script type="text/javascript" src="<?php echo base_url('statics/js/bootstrap.min.js'); ?>"></script>
		<?php
    }
    public function main(){
        ?>
    </head>
    <body>
        <?php
    }
    public function foot(){
        ?>
    </body>
    </html>
        <?php
    }
    public function source(){}
}
