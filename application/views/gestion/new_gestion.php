<div class="portlet box blue tabbable">
    <div class="portlet-title">
        <div class="caption">
            <i class="fa fa-pencil"></i>Agregar Gestion
        </div>
    </div>
    <div class="portlet-body form">
        <div class="tabbable portlet-tabs">
            <ul class="nav nav-tabs">
                <li>
                    <a href="#portlet_tab_2" data-toggle="tab">
                        Visita 
                    </a>
                </li>
                <li class="active">
                    <a href="#portlet_tab_1" data-toggle="tab">
                        CallCenter
                    </a>
                </li>                
            </ul>
            <div class="tab-content">
                <div class="tab-pane active" id="portlet_tab_1">
                    <form id="insert_user" action="<?php echo base_url('index.php/gestion/insert'); ?>" method="post" class="horizontal-form">
                        <input type="hidden" name="cuenta_id" id="cuenta_id" value="<?php echo $user[0]->cuenta_id; ?>">
                        <input type="hidden" name="persona_id" id="persona_id" value="<?php echo $user[0]->persona_id; ?>">
                        <div class="form-body">
                            <h3 class="form-section">
                                Agregar Gestion del CallCenter
                            </h3>

                            <div class="row">
                                <div class="col-md-4">
                                    <div class="form-group">
                                        <label class="control-label col-md-3">
                                            Accion
                                            <span class="required" aria-required="true">*</span>
                                        </label>
                                        <div class="col-md-9">
                                            <?php echo form_dropdown('accion_id', $action, '', 'onchange="get_select_result(this.value)" id="accion_id" class="form-control"'); ?>
                                        </div>
                                    </div>
                                </div>

                                <div class="col-md-4">
                                    <div class="form-group">
                                        <label class="control-label col-md-3">
                                            Resultado
                                        </label>
                                        <div class="col-md-9" id="select_result">
                                            <?php echo form_dropdown('resultado_id', array('' => '--Seleccione una Accion--'), '', 'onchange="get_select_cause(this.value)" id="resultado_id" class="form-control"'); ?>
                                        </div>
                                    </div>
                                </div>

                                <div class="col-md-4">
                                    <div class="form-group">
                                        <label class="control-label col-md-3">
                                            Causal
                                        </label>
                                        <div class="col-md-9" id="select_cause">
                                            <?php echo form_dropdown('causal_id', array('' => '--Seleccione un Resultado--'), '', 'id="causal_id" class="form-control"'); ?>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-md-6">
                                    <div class="col-md-6">
                                        <div class="form-group">
                                            <label class="control-label">
                                                Telefono
                                            </label>
                                            <input type="text" name="telefono" value="" id="telefono" placeholder="" class="form-control">
                                        </div>
                                    </div>
                                    <div class="col-md-6">
                                        <div class="form-group">
                                            <label class="control-label">
                                                Estado tel
                                            </label>
                                            <input type="text" name="estado_tel" value="" id="estado_tel" placeholder="" class="form-control">
                                        </div>
                                    </div>
                                    <div class="col-md-6">
                                        <div class="form-group">
                                            <label class="control-label">
                                                Direccion
                                            </label>
                                            <input type="text" name="direccion" value="" id="direccion" placeholder="" class="form-control">
                                        </div>
                                    </div>
                                    <div class="col-md-6">
                                        <div class="form-group">
                                            <label class="control-label">
                                                Estado dir
                                            </label>
                                            <input type="text" name="estado_dir" value="" id="estado_dir" placeholder="" class="form-control">
                                        </div>
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label class="control-label">
                                            Observacion
                                        </label>
                                        <textarea name="observacion" id="observacion" class="form-control" rows="5"></textarea>
                                    </div>                                   
                                </div>
                            </div>                          
                        </div>
                        <div class="form-actions right">
                            <button type="submit" class="btn green">Guardar</button>
                        </div>
                    </form>                  
                </div>
                <div class="tab-pane" id="portlet_tab_2">
                    <form id="insert_user" action="<?php echo base_url('index.php/gestion/insert_visita'); ?>" method="post" class="horizontal-form">
                        <input type="hidden" name="cuenta_id" id="cuenta_id" value="<?php echo $user[0]->cuenta_id; ?>">
                        <input type="hidden" name="persona_id" id="persona_id" value="<?php echo $user[0]->persona_id; ?>">
                        <div class="form-body">
                            <h3 class="form-section">
                                Agregar Visita
                            </h3>

                            <div class="row">
                                <div class="col-md-12">
                                    <div class="form-group">
                                        <label class="control-label">
                                            Observacion
                                        </label>
                                        <textarea name="observacion" id="observacion" class="form-control" rows="3"></textarea>
                                    </div>                                   
                                </div>
                            </div>                          
                        </div>
                        <div class="form-actions right">
                            <button type="submit" class="btn green">Guardar</button>
                        </div>
                    </form>  
                </div>
            </div>
        </div>
    </div>
</div>

<script>
    function get_select_result(accion_id) {
        $.ajax({
            data: "accion_id=" + accion_id,
            type: "POST",
            dataType: "html",
            url: base_url_js + "index.php/result/get_select_result",
            success: function (data) {
                $("#select_result").html(data);
            },
            error: function (xhr, ajaxOptions, thrownError) {
                alert("Error al Cargar los municipios")
            },
            async: true
        });
    }
    
    function get_select_cause(resultado_id) {
        $.ajax({
            data: "resultado_id=" + resultado_id,
            type: "POST",
            dataType: "html",
            url: base_url_js + "index.php/cause/get_select_cause",
            success: function (data) {
                $("#select_cause").html(data);
            },
            error: function (xhr, ajaxOptions, thrownError) {
                alert("Error al Cargar los municipios")
            },
            async: true
        });
    }    
    
    
</script>
