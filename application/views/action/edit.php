<!-- BEGIN CONTENT -->
<div class="page-content-wrapper">
    <div class="page-content">
        <!-- BEGIN PAGE HEADER-->
        <h3 class="page-title">
            Administrar <small>Acciones</small>
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
                    <a href="<?php echo base_url('index.php/action') ?>">
                        Acciones
                    </a>
                    <i class="fa fa-angle-right"></i>
                </li>
                <li>
                    <a href="">
                        Editar
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
                        <form id="update_action" action="<?php echo base_url('index.php/action/update/' . encrypt_id($registro[0]->accion_id)); ?>" method="post" class="form-horizontal form-row-seperated">
                            <div class="form-body">
                                
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label class="control-label col-md-3">
                                            Codigo
                                            <span class="required" aria-required="true">*</span>
                                        </label>
                                        <div class="col-md-9">
                                            <input type="text" name="codigo" value="<?php echo $registro[0]->codigo; ?>" id="codigo" placeholder="Codigo" class="form-control">
                                        </div>
                                    </div>
                                </div>

                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label class="control-label col-md-3">
                                            Nombre
                                            <span class="required" aria-required="true">*</span>
                                        </label>
                                        <div class="col-md-9">
                                            <input type="text" name="nombre" value="<?php echo $registro[0]->nombre; ?>" id="nombre" placeholder="Nombre" class="form-control">
                                        </div>
                                    </div>
                                </div>     
                                
                                <script>
                                    var total_results = '<?php echo count($accion_resultado); ?>';
                                    total_results = parseInt(total_results);
                                </script>
                                <?php //echo '<pre>' . print_r($resultado_causal, true) . '</pre>'; ?>
                                <div class="col-md-6" id="results">
                                    <?php
                                    $count = 1;
                                    foreach ($accion_resultado as $data) {
                                        ?>
                                        <div class="form-group" id="div_res_<?php echo $count; ?>">
                                            <label class="control-label col-md-3">
                                                Resultado 
                                            </label>
                                            <div class="col-md-9">
                                                <?php
                                                echo form_dropdown("result_id_$count", $results, $data->resultado_id, 'class="form-control"');
                                                ?>
                                            </div>                                    
                                        </div>
                                        <?php
                                        $count++;
                                    }
                                    ?>
                                </div>                             

                                <div class="col-md-6">
                                    <div class="form-group">
                                        <div class="btn-group btn-group-circle btn-group-solid">
                                            <button onclick="get_result()" type="button" class="btn blue"><i class="fa fa-plus"></i> Agregar Resultado</button>
                                            <button onclick="delete_result()" type="button" class="btn red"><i class="fa fa-minus"></i> Eliminar Resultado</button>
                                        </div>
                                    </div>
                                </div> 
                                <input type="hidden" name="total_results" id="total_results" value="<?php echo count($accion_resultado); ?>">                                 
                                
                                <div class="col-md-12">
                                    <div class="form-group">
                                        <div class="form-group">
                                            <label class="control-label col-md-3">
                                                Estado
                                            </label>
                                            <div class="col-md-9">
                                                <?php echo form_dropdown('estado', $states, $registro[0]->estado, 'class="form-control"'); ?>
                                            </div>
                                        </div>
                                    </div> 
                                </div>                                

                                <div class="form-group">
                                    
                                </div>                               

                            </div>
                            <div class="form-actions">
                                <div class="row">
                                    <div class="col-md-offset-3 col-md-9">
                                        <button type="submit" class="btn green">Guardar</button>
                                        <a href="<?php echo base_url('index.php/action') ?>">
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
        var FormValidation = function() {
            // basic validation
            var handleValidation1 = function() {
                // for more info visit the official plugin documentation: 
                // http://docs.jquery.com/Plugins/Validation

                var form1 = $('#update_action');
                var error1 = $('.alert-danger', form1);
                var success1 = $('.alert-success', form1);

                form1.validate({
                    errorElement: 'span', //default input error message container
                    errorClass: 'help-block help-block-error', // default input error message class
                    focusInvalid: false, // do not focus the last invalid input
                    ignore: "", // validate all fields including form hidden input
                    rules: {
                        codigo: {
                            required: true
                        },
                        nombre: {
                            required: true
                        }
                    },
                    invalidHandler: function(event, validator) { //display error alert on form submit              
                        success1.hide();
                        error1.show();
                        Metronic.scrollTo(error1, -200);
                    },
                    highlight: function(element) { // hightlight error inputs
                        $(element)
                                .closest('.form-group').addClass('has-error'); // set error class to the control group
                    },
                    unhighlight: function(element) { // revert the change done by hightlight
                        $(element)
                                .closest('.form-group').removeClass('has-error'); // set error class to the control group
                    },
                    /*success: function(label) {
                        label
                                .closest('.form-group').removeClass('has-error'); // set success class to the control group
                    },*/
                    submitHandler: function(form) {
                        success1.show();
                        error1.hide();
                        $("#"+form1).submit();
                    }
                });
            }
            return {
                //main function to initiate the module
                init: function() {
                    handleValidation1();
                }
            };

        }();
    </script>
