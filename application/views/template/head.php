<!DOCTYPE html>
<!-- 
Template Name: Metronic - Responsive Admin Dashboard Template build with Twitter Bootstrap 3.2.0
Version: 3.1.3
Author: KeenThemes
Website: http://www.keenthemes.com/
Contact: support@keenthemes.com
Follow: www.twitter.com/keenthemes
Like: www.facebook.com/keenthemes
Purchase: http://themeforest.net/item/metronic-responsive-admin-dashboard-template/4021469?ref=keenthemes
License: You must have a valid license purchased only from themeforest(the above link) in order to legally use the theme for your project.
-->
<!--[if IE 8]> <html lang="en" class="ie8 no-js"> <![endif]-->
<!--[if IE 9]> <html lang="en" class="ie9 no-js"> <![endif]-->
<!--[if !IE]><!-->
<html lang="en" class="no-js">

    <!-- BEGIN HEAD -->
    <head>
        <meta charset="utf-8"/>
        <title><?php echo $title; ?></title>
        <meta http-equiv="X-UA-Compatible" content="IE=edge">
        <meta content="width=device-width, initial-scale=1" name="viewport"/>
        <meta content="<?php echo $title; ?>" name="description"/>
        <meta content="" name="author"/>
        <!-- BEGIN GLOBAL MANDATORY STYLES -->
        <link href="http://fonts.googleapis.com/css?family=Open+Sans:400,300,600,700&subset=all" rel="stylesheet" type="text/css"/>
        
        
        <link rel="shortcut icon" href="<?php echo base_url('images/favicon.png'); ?>">

        <link href="<?php echo base_url('/assets/global/plugins/font-awesome/css/font-awesome.min.css'); ?>" rel="stylesheet" type="text/css"/>
        <link href="<?php echo base_url('/assets/global/plugins/simple-line-icons/simple-line-icons.min.css'); ?>" rel="stylesheet" type="text/css"/>
        <link href="<?php echo base_url('/assets/global/plugins/bootstrap/css/bootstrap.min.css'); ?>" rel="stylesheet" type="text/css"/>
        <link href="<?php echo base_url('/assets/global/plugins/uniform/css/uniform.default.css'); ?>" rel="stylesheet" type="text/css"/>
        <link href="<?php echo base_url('/assets/global/plugins/bootstrap-switch/css/bootstrap-switch.min.css'); ?>" rel="stylesheet" type="text/css"/>
        <!-- END GLOBAL MANDATORY STYLES -->
        <!-- BEGIN PAGE LEVEL PLUGIN STYLES -->
        <link rel="stylesheet" type="text/css" href="<?php echo base_url('/assets/global/plugins/bootstrap-datepicker/css/datepicker3.css'); ?>"/>

        <link href="<?php echo base_url('/assets/global/plugins/gritter/css/jquery.gritter.css'); ?>" rel="stylesheet" type="text/css"/>
        <link href="<?php echo base_url('/assets/global/plugins/bootstrap-daterangepicker/daterangepicker-bs3.css'); ?>" rel="stylesheet" type="text/css"/>
        <link href="<?php echo base_url('/assets/global/plugins/fullcalendar/fullcalendar/fullcalendar.css'); ?>" rel="stylesheet" type="text/css"/>
        <link href="<?php echo base_url('/assets/global/plugins/jqvmap/jqvmap/jqvmap.css'); ?>" rel="stylesheet" type="text/css"/>
        <!-- END PAGE LEVEL PLUGIN STYLES -->
        <!-- BEGIN PAGE STYLES -->
        <link href="<?php echo base_url('/assets/admin/pages/css/tasks.css'); ?>" rel="stylesheet" type="text/css"/>
        <!-- END PAGE STYLES -->
        <!-- BEGIN THEME STYLES -->
        <link href="<?php echo base_url('/assets/global/css/components.css'); ?>" rel="stylesheet" type="text/css"/>
        <link href="<?php echo base_url('/assets/global/css/plugins.css'); ?>" rel="stylesheet" type="text/css"/>
        <link href="<?php echo base_url('/assets/admin/layout/css/layout.css'); ?>" rel="stylesheet" type="text/css"/>
        <link href="<?php echo base_url('/assets/admin/layout/css/themes/grey.css'); ?>" rel="stylesheet" type="text/css" id="style_color"/>
        <link href="<?php echo base_url('/assets/admin/layout/css/custom.css'); ?>" rel="stylesheet" type="text/css"/>
        <!-- END THEME STYLES -->

        <link href="<?php echo base_url('/assets/global/plugins/bootstrap-select/bootstrap-select.min.css'); ?>" rel="stylesheet">
        <link href="<?php echo base_url('/assets/global/plugins/select2/select2.css'); ?>" rel="stylesheet">
        <link href="<?php echo base_url('/assets/global/plugins/jquery-multi-select/css/multi-select.css'); ?>" rel="stylesheet">

        <link rel="stylesheet" type="text/css" href="<?php echo base_url('/assets/global/plugins/datatables/extensions/Scroller/css/dataTables.scroller.min.css'); ?>"/>
        <link rel="stylesheet" type="text/css" href="<?php echo base_url('/assets/global/plugins/datatables/extensions/ColReorder/css/dataTables.colReorder.min.css'); ?>"/>
        <link rel="stylesheet" type="text/css" href="<?php echo base_url('/assets/global/plugins/datatables/plugins/bootstrap/dataTables.bootstrap.css'); ?>"/>        


        <!-- BEGIN THEME STYLES  -->
        <link href="<?php echo base_url('/css/style.css'); ?>" rel="stylesheet" type="text/css"/>
        <!-- END THEME STYLES  -->


        <script>
            var base_url_js = '<?php echo base_url(); ?>';
        </script>

        <?php if ($this->session->userdata('ID_TIPO_USU') != 3) { ?>
            <style>
                /*
                a:visited{
                    color:red !important;
                }*/
            </style>
        <?php } ?>
    </head>
    <!-- END HEAD -->