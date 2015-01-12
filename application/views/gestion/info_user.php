<div class="portlet box yellow">
    <div class="portlet-title">
        <div class="caption">
            <i class="fa fa-user"></i>Informaci&oacute;n del Usuario
        </div>                       
    </div>                   
    <div class="portlet-body">
        <div class="scroller" style="height:165px" data-always-visible="1" data-rail-visible="1" data-rail-color="grey" data-handle-color="yellow">
            <table class="table table-bordered table-striped">
                <tbody>
                    <tr>
                        <td><strong>Nombre</strong></td>
                        <td><?php echo $user[0]->nombre; ?></td>
                    </tr>
                    <tr>
                        <td><strong>Documento</strong></td>
                        <td><?php echo $user[0]->num_documento; ?></td>
                    </tr> 
                    <tr>
                        <td><strong>No. Cuenta</strong></td>
                        <td><?php echo $user[0]->cuenta; ?></td>
                    </tr>
                    <tr>
                        <td><strong>Ciudad</strong></td>
                        <td><?php echo $user[0]->ciudad; ?></td>
                    </tr>
                    <tr>
                        <td><strong>Direccion</strong></td>
                        <td><?php echo $user[0]->direccion_domicilio; ?></td>
                    </tr>
                    <tr>
                        <td><strong>Telefono</strong></td>
                        <td><?php echo $user[0]->telefono; ?></td>
                    </tr>
                    <tr>
                        <td><strong>Celular</strong></td>
                        <td><?php echo $user[0]->celular; ?></td>
                    </tr>
                </tbody>
            </table>
        </div>
    </div>
</div>