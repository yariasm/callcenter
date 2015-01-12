<div class="portlet box green-haze tabbable">
    <div class="portlet-title">
        <div class="caption">
            <i class="fa fa-phone"></i>Historico de Gestiones
        </div>                    
    </div>                   
    <div class="portlet-body">

        <div class="tabbable portlet-tabs">
            <ul class="nav nav-tabs">
                <li>
                    <a href="#portlet_tab2_2" data-toggle="tab">
                        Visita 
                    </a>
                </li>
                <li class="active">
                    <a href="#portlet_tab2_1" data-toggle="tab">
                        CallCenter
                    </a>
                </li>                
            </ul>
            <div class="tab-content">
                <div class="tab-pane active" id="portlet_tab2_1">
                    <div class="scroller" style="height:165px" data-always-visible="1" data-rail-visible="1" data-rail-color="grey" data-handle-color="green">
                        <table class="table table-bordered table-striped">
                            <thead>
                                <tr>
                                    <th>Fecha</th>
                                    <th>Asesor</th>
                                    <th>Observaciones</th>                                    
                                    <th></th>
                                </tr>
                            </thead>
                            <tbody>
                                <?php
                                foreach ($gestion_callcenter as $gestion) {
                                    ?>
                                    <tr>
                                        <td>
                                            <?php echo $gestion->fecha_ingreso; ?>
                                        </td>
                                        <td>
                                            <?php echo $gestion->USUARIO_NOMBRES . ' ' . substr($gestion->USUARIO_APELLIDOS, 0, 1) . '.'; ?>
                                        </td>
                                        <td>
                                            <?php echo substr($gestion->observacion, 0, 15) . '...'; ?>
                                        </td>                                        
                                        <td>
                                            <button class="btn btn-xs green-haze" data-toggle="modal" href="#call_<?php echo $gestion->gestion_id; ?>">
                                                <i class="fa fa-search"></i>Ver
                                            </button>
                                            <div class="modal fade" id="call_<?php echo $gestion->gestion_id; ?>" tabindex="-1" role="basic" aria-hidden="true" style="display: none;">
                                                <div class="modal-dialog">
                                                    <div class="modal-content">
                                                        <div class="modal-header">
                                                            <button type="button" class="close" data-dismiss="modal" aria-hidden="true"></button>
                                                            <h4 class="modal-title">Gestion de CallCenter</h4>
                                                        </div>
                                                        <div class="modal-body">
                                                            <ul class="list-group">
                                                                <li class="list-group-item">
                                                                    <strong>Fecha: </strong><?php echo $gestion->fecha_ingreso; ?>
                                                                </li>
                                                                <li class="list-group-item">
                                                                    <strong>Asesor: </strong><?php echo $gestion->USUARIO_NOMBRES . ' ' . $gestion->USUARIO_APELLIDOS; ?>
                                                                </li>
                                                                <li class="list-group-item">
                                                                    <strong>Accion: </strong><?php echo $gestion->accion; ?>
                                                                </li>
                                                                <li class="list-group-item">
                                                                    <strong>Resultado: </strong><?php echo $gestion->resultado; ?>
                                                                </li> 
                                                                <li class="list-group-item">
                                                                    <strong>Causal: </strong><?php echo $gestion->causal; ?>
                                                                </li> 
                                                                <li class="list-group-item">
                                                                    <strong>Telefono: </strong><?php echo $gestion->telefono; ?>
                                                                </li>
                                                                <li class="list-group-item">
                                                                    <strong>Estado tel: </strong><?php echo $gestion->estado_tel; ?>
                                                                </li>
                                                                <li class="list-group-item">
                                                                    <strong>Direccion: </strong><?php echo $gestion->direccion; ?>
                                                                </li>
                                                                <li class="list-group-item">
                                                                    <strong>Estado Dir: </strong><?php echo $gestion->estado_dir; ?>
                                                                </li>
                                                                <li class="list-group-item">
                                                                    <div class="well bg-green-haze">
                                                                        <?php echo $gestion->observacion; ?>
                                                                    </div>
                                                                </li>
                                                            </ul>
                                                        </div>
                                                        <div class="modal-footer">
                                                            <button type="button" class="btn default" data-dismiss="modal">Cerrar</button>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>                                            
                                        </td>
                                    </tr>
                                    <?php
                                }
                                ?>
                            </tbody>
                        </table>
                    </div>                
                </div>
                <div class="tab-pane" id="portlet_tab2_2">
                    <div class="scroller" style="height:165px" data-always-visible="1" data-rail-visible="1" data-rail-color="grey" data-handle-color="green">
                        <table class="table table-bordered table-striped">
                            <thead>
                                <tr>
                                    <th>Fecha</th>
                                    <th>Asesor</th>
                                    <th>Observaciones</th>                                    
                                    <th></th>
                                </tr>
                            </thead>
                            <tbody>
                                <?php
                                foreach ($gestion_visita as $gestion) {
                                    ?>
                                    <tr>
                                        <td>
                                            <?php echo $gestion->fecha_ingreso; ?>
                                        </td>
                                        <td>
                                            <?php echo $gestion->USUARIO_NOMBRES . ' ' . substr($gestion->USUARIO_APELLIDOS, 0, 1) . '.'; ?>
                                        </td>
                                        <td>
                                            <?php echo substr($gestion->observacion, 0, 15) . '...'; ?>
                                        </td>                                        
                                        <td>
                                            <button class="btn btn-xs green-haze" data-toggle="modal" href="#vis_<?php echo $gestion->visita_id; ?>">
                                                <i class="fa fa-search"></i>Ver
                                            </button>
                                            <div class="modal fade" id="vis_<?php echo $gestion->visita_id; ?>" tabindex="-1" role="basic" aria-hidden="true" style="display: none;">
                                                <div class="modal-dialog">
                                                    <div class="modal-content">
                                                        <div class="modal-header">
                                                            <button type="button" class="close" data-dismiss="modal" aria-hidden="true"></button>
                                                            <h4 class="modal-title">Gestion de Visita</h4>
                                                        </div>
                                                        <div class="modal-body">
                                                            <ul class="list-group">
                                                                <li class="list-group-item">
                                                                    <strong>Fecha: </strong><?php echo $gestion->fecha_ingreso; ?>
                                                                </li>
                                                                <li class="list-group-item">
                                                                    <strong>Asesor: </strong><?php echo $gestion->USUARIO_NOMBRES . ' ' . $gestion->USUARIO_APELLIDOS; ?>
                                                                </li>
                                                                <li class="list-group-item">
                                                                    <div class="well bg-green-haze">
                                                                        <?php echo $gestion->observacion; ?>
                                                                    </div>
                                                                </li>
                                                            </ul>
                                                        </div>
                                                        <div class="modal-footer">
                                                            <button type="button" class="btn default" data-dismiss="modal">Cerrar</button>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                        </td>
                                    </tr>
                                    <?php
                                }
                                ?>
                            </tbody>
                        </table>
                    </div> 
                </div>
            </div>
        </div>

    </div>
</div>