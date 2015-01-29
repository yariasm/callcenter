<!-- BEGIN CONTENT -->
<div class="page-content-wrapper">
    <div class="page-content">
        <!-- BEGIN PAGE HEADER-->
        <h3 class="page-title">
            Editar <small>Plantilla</small>
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
                    <a href="<?php echo base_url('index.php/mail/edit') ?>">
                        Editar Usuario
                    </a>
                    <i class="fa fa-angle-right"></i>
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

            <div class="col-md-12 col-sm-12">

                <div class="portlet box purple">
                    <div class="portlet-title">
                        <div class="caption">
                            <i class="fa fa-gift"></i>Editar Registro
                        </div>
                        <div class="tools">
                            <a href="javascript:;" class="collapse">
                            </a>
                        </div>
                    </div>
                    <div class="portlet-body form">
                        <!-- BEGIN FORM-->
                        <form id="update_user" action="<?php echo base_url('index.php/mail/update/' . encrypt_id($registro[0]->plantilla_id)); ?>" method="post" class="form-horizontal form-row-seperated">
                            <div class="form-body">

                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label class="control-label col-md-3">
                                            Nombre
                                        </label>
                                        <div class="col-md-9">
                                            <input type="text" name="nombre" value="<?php echo $registro[0]->nombre; ?>" id="nombre" class="form-control">
                                        </div>
                                    </div>
                                </div>

                                <div class="col-md-12">
                                    <div class="">
                                        <label class="control-label col-md-3">
                                            Plantilla
                                        </label>
                                        <div class="col-md-9">
                                            <?php echo form_textarea('texto', $registro[0]->texto, 'id="texto" class="textarea"'); ?>
                                        </div>
                                    </div>
                                </div>

                                <div class="col-md-12">
                                    <br>
                                    <div class="alert alert-info">
                                        <strong>Importante: </strong> 
                                        Por favor utilice las variables [USUARIO] y [CONTENIDO] dentro de la plantilla, 
                                        estas van a ser reemplazadas dinamicamente al enviar los correos electronicos.
                                    </div>
                                </div>



                                <div class="form-group">

                                </div>                               

                            </div>
                            <div class="form-actions">
                                <div class="row">
                                    <div class="col-md-offset-3 col-md-9">
                                        <button type="submit" class="btn green">Guardar</button>
                                        <a href="<?php echo base_url('index.php/user') ?>">
                                            <button type="button" class="btn default">Cancelar</button>
                                        </a>
                                    </div>
                                </div>
                            </div>
                        </form>                        
                        <!-- END FORM-->
                    </div>
                </div>                

            </div>
        </div>
    </div>
    <!-- END CONTENT -->

    <script>

        $(document).ready(function () {
            $('.textarea').summernote({
                height: 200,
                toolbar: [
                    //['style', ['style']], // no style button
                    ['style', ['bold', 'italic', 'underline', 'clear']],
                    ['fontsize', ['fontsize']],
                    ['color', ['color']],
                    ['para', ['ul', 'ol', 'paragraph']],
                    ['height', ['height']],
                    ['insert', ['picture', 'link', 'video', 'codeview']], // no insert buttons
                    ['fullscreen', ['fullscreen']],
                    ['table', ['table']], // no table button
//                ['help', ['help']] //no help button
                ]
            });
        });
    </script>