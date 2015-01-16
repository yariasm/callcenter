<!-- BEGIN CONTENT -->
<div class="page-content-wrapper">
    <div class="page-content">
        <!-- BEGIN PAGE HEADER-->
        <h3 class="page-title">
            Reportes del Sistema<small> - Generar Archivo Plano</small>
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
                        Generar Reporte
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

                <div class="portlet box blue">
                    <div class="portlet-title">
                        <div class="caption">
                            <i class="fa fa-gift"></i>Generar Reporte
                        </div>
                        <div class="tools">
                            <a href="javascript:;" class="collapse">
                            </a>
                        </div>
                    </div>
                    <div class="portlet-body form">
                        <!-- BEGIN FORM-->
                        <form id="insert_portafolio" enctype="multipart/form-data" action="<?php echo base_url('index.php/report/insert'); ?>" method="post" class="form-horizontal form-row-seperated">
                            <div class="form-body">

                                <div class="col-md-12">
                                    <div class="form-group">
                                        <label class="control-label col-md-3">
                                            Seleccione el Rango de Fechas
                                        </label>
                                        <div class="col-md-9">
                                            <div class="input-group input-large date-picker input-daterange" data-date="<?php echo date("Y-m-d") ?>" data-date-format="yyyy/mm/dd">
                                                <input type="text" class="form-control" name="from" value="<?php echo date("Y-m-") ?>01">
                                                <span class="input-group-addon">
                                                    Hasta </span>
                                                <input type="text" class="form-control" name="to" value="<?php echo date("Y-m-d") ?>">
                                            </div>
                                        </div>
                                    </div> 
                                </div>

                                <div class="form-group">
                                    &nbsp;
                                </div>                               

                            </div>
                            <div class="form-actions">
                                <div class="row">
                                    <div class="col-md-offset-3 col-md-9">
                                        <button type="submit" class="btn green">Generar</button>
                                    </div>
                                </div>
                            </div>
                        </form>
                        <!-- END FORM-->
                    </div>
                </div>                

            </div>

            <div class="col-md-12 col-sm-12">
                <?php if ($this->session->flashdata('message_log')) { ?>
                    <div class="note note-<?php echo $this->session->flashdata('message_type_log'); ?>">
                        <h4 class="block"><strong>Log de Transacciones</strong></h4>
                        <p>
                            <?php echo $this->session->flashdata('message_log'); ?>
                        </p>
                    </div> 
                <?php } ?>         
            </div>            


        </div>
    </div>
    <!-- END CONTENT -->


    <script>

        var FormValidation = function () {

            // basic validation
            var handleValidation1 = function () {
                // for more info visit the official plugin documentation: 
                // http://docs.jquery.com/Plugins/Validation

                var form1 = $('#insert_portafolio');
                var error1 = $('.alert-danger', form1);
                var success1 = $('.alert-success', form1);

                form1.validate({
                    errorElement: 'span', //default input error message container
                    errorClass: 'help-block help-block-error', // default input error message class
                    focusInvalid: false, // do not focus the last invalid input
                    ignore: "", // validate all fields including form hidden input
                    rules: {
                        fecha_caida: {
                            required: true
                        }
                    },
                    invalidHandler: function (event, validator) { //display error alert on form submit              
                        success1.hide();
                        error1.show();
                        Metronic.scrollTo(error1, -200);
                    },
                    highlight: function (element) { // hightlight error inputs
                        $(element)
                                .closest('.form-group').addClass('has-error'); // set error class to the control group
                    },
                    unhighlight: function (element) { // revert the change done by hightlight
                        $(element)
                                .closest('.form-group').removeClass('has-error'); // set error class to the control group
                    },
                    /*success: function(label) {
                     label
                     .closest('.form-group').removeClass('has-error'); // set success class to the control group
                     },*/
                    submitHandler: function (form) {
                        success1.show();
                        error1.hide();
                        $("#" + form1).submit();
                    }
                });


            }
            return {
                //main function to initiate the module
                init: function () {
                    handleValidation1();
                }

            };

        }();
    </script>
