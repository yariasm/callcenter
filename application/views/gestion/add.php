<!-- BEGIN CONTENT -->
<div class="page-content-wrapper">
    <div class="page-content">
        <!-- BEGIN PAGE HEADER-->
        <h3 class="page-title">
            Agregar Gestion<small> del CallCenter</small>
        </h3>
        <div class="page-bar">
            <ul class="page-breadcrumb">
                <li>
                    <i class="fa fa-home"></i>
                    <a href="<?php echo base_url('index.php/desk') ?>">
                        Escritorio
                    </a>
                    <i class="fa fa-angle-right"></i>
                </li>
                <li>
                    <a>
                        Agregar Gestion
                    </a>
                </li>              
            </ul>            
        </div>
        <!-- END PAGE HEADER-->

        <div class="clearfix">
        </div>

        <div class="row ">

            <div class="col-md-12 col-sm-12">
                <?php if ($this->session->flashdata('message')) { ?>
                    <div class="alert alert-<?php echo $this->session->flashdata('message_type'); ?>">
                        <?php echo $this->session->flashdata('message'); ?>
                    </div>
                <?php } ?>            
                <?php echo validation_errors(); ?>            
            </div>

            <div class="col-md-6 col-sm-6">
                <div class="portlet box blue-hoki" id="search">
                    <div class="portlet-title">
                        <div class="caption">
                            <i class="fa fa-search"></i>Buscar Usuario
                        </div>
                        <!--                        <div class="tools">
                                                    <a href="javascript:;" class="collapse">
                                                    </a>
                                                </div>-->
                    </div>
                    <div class="portlet-body form">
                        <!-- BEGIN FORM-->
                        <form id="insert_portafolio" enctype="multipart/form-data" action="<?php echo base_url('index.php/portafolio/insert'); ?>" method="post" class="form-horizontal form-row-seperated">
                            <div class="form-body">
                                <div class="col-md-12">
                                    <div class="form-group">
                                        <label class="control-label col-md-3">
                                            Buscar Por
                                        </label>
                                        <div class="col-md-9">
                                            <?php echo form_dropdown('search_type', get_type_search(), '', 'id="search_type" class="form-control"'); ?>
                                        </div>                                        
                                    </div>  
                                </div>
                                <div class="col-md-12">
                                    <div class="form-group">
                                        <label class="control-label col-md-3">
                                            Numero
                                        </label>
                                        <div class="col-md-9">
                                            <input onkeyup="get_user();
                                                get_account();
                                                get_gestion();
                                                get_gestion_new()" name="search_value" value="<?php echo (isset($user[0]->num_documento)) ? $user[0]->num_documento : ''; ?>" id="search_value" class="form-control form-control-inline input-medium" size="16" type="text"/>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="form-actions">
                                <div class="row">
                                    <div class="col-md-offset-3 col-md-9">
                                        <button type="button" onclick="get_user();
                                                get_account();
                                                get_gestion();
                                                get_gestion_new()" class="btn blue">
                                            Buscar&nbsp;
                                            <i class="fa fa-search"></i>
                                        </button>
                                    </div>
                                </div>
                            </div>
                        </form>
                        <?php
                        //LANZAR FUNCIONES JAVASCRIPT SI SE ENCONTRO USUARIO
                        echo (isset($user[0]->num_documento)) ?
                                '<script>$(document).ready(function() { get_user();get_account();get_gestion();get_gestion_new(); });</script>' :
                                '';
                        ?>
                        <!-- END FORM-->
                    </div>
                </div>
            </div>
            <div class="col-md-6 col-sm-6" id="info_user"></div>
            <div class="col-md-12 col-sm-12" id="add_gestion"></div>
            <div class="col-md-6 col-sm-6" id="info_account"></div>
            <div class="col-md-6 col-sm-6" id="info_gestion"></div>
            
           
        </div>
    </div>
</div>
<!-- END CONTENT -->
