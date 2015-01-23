<div class="page-sidebar-wrapper">
    <!-- DOC: Set data-auto-scroll="false" to disable the sidebar from auto scrolling/focusing -->
    <!-- DOC: Change data-auto-speed="200" to adjust the sub menu slide up/down speed -->
    <div class="page-sidebar navbar-collapse collapse">
        <!-- BEGIN SIDEBAR MENU -->
        <ul class="page-sidebar-menu" data-auto-scroll="true" data-slide-speed="200">
            <!-- DOC: To remove the sidebar toggler from the sidebar you just need to completely remove the below "sidebar-toggler-wrapper" LI element -->
            <li class="sidebar-toggler-wrapper">
                <!-- BEGIN SIDEBAR TOGGLER BUTTON -->
                <div class="sidebar-toggler">

                </div>
                <!-- END SIDEBAR TOGGLER BUTTON -->
            </li>
            <!--            class="start active open"-->
            <br>
            <li class="<?php echo strstr($content, 'desk') ? 'active open' : ''; ?>">
                <a href="<?php echo base_url('index.php/desk'); ?>">
                    <i class="icon-home"></i>
                    <span class="title">Inicio</span>
                </a>
            </li>
            
            <?php if (know_permission_role('ACC', 'permission_view') OR know_permission_role('RES', 'permission_view') OR know_permission_role('CAU', 'permission_view')): ?>
                <li class="<?php echo (strstr($content, 'action') OR strstr($content, 'result') OR strstr($content, 'cause')) ? 'active open' : ''; ?>">
                    <a href="javascript:;">
                        <i class="icon-shuffle"></i>
                        <span class="title">Parametros</span>
                        <?php echo (strstr($content, 'action') OR strstr($content, 'result') OR strstr($content, 'cause')) ? '<span class="selected"></span>' : ''; ?>
                        <span class="arrow <?php echo (strstr($content, 'action') OR strstr($content, 'result') OR strstr($content, 'cause')) ? 'open' : ''; ?>"></span>
                    </a>                   
                    <ul class="sub-menu">
                        <?php if (know_permission_role('ACC', 'permission_view')): ?>
                            <li class="<?php echo strstr($content, 'action') ? 'active open' : ''; ?>">
                                <a href="<?php echo base_url('index.php/action'); ?>">
                                    Acciones
                                </a>
                            </li>
                        <?php endif; ?>
                        <?php if (know_permission_role('RES', 'permission_view')): ?>
                            <li class="<?php echo strstr($content, 'result') ? 'active open' : ''; ?>">
                                <a href="<?php echo base_url('index.php/result'); ?>">
                                    Resultados
                                </a>
                            </li>
                        <?php endif; ?>
                        <?php if (know_permission_role('CAU', 'permission_view')): ?>
                            <li class="<?php echo strstr($content, 'cause') ? 'active open' : ''; ?>">
                                <a href="<?php echo base_url('index.php/cause'); ?>">
                                    Causales
                                </a>
                            </li>
                        <?php endif; ?>                            
                    </ul>
                </li>
            <?php endif; ?>  
                
            <?php if (know_permission_role('GCA', 'permission_view')): ?>
                <li class="<?php echo strstr($content, 'portafolio') ? 'active open' : ''; ?>">
                    <a href="javascript:;">
                        <i class="icon-wallet"></i>
                        <span class="title">Gestion de Cartera</span>
                        <?php echo strstr($content, 'portafolio') ? '<span class="selected"></span>' : ''; ?>
                        <span class="arrow <?php echo strstr($content, 'portafolio') ? 'open' : ''; ?>"></span>
                    </a>                   
                    <ul class="sub-menu">
                        <?php if (know_permission_role('GCA', 'permission_add')): ?>
                            <li>
                                <a href="<?php echo base_url('index.php/portafolio/add'); ?>">
                                    Subir Arc. Caidas
                                </a>
                            </li>
                        <?php endif; ?>
                    </ul>
                </li>
            <?php endif; ?> 
                
            <?php if (know_permission_role('GES', 'permission_view')): ?>
                <li class="<?php echo strstr($content, 'gestion') ? 'active open' : ''; ?>">
                    <a href="javascript:;">
                        <i class="icon-call-out"></i>
                        <span class="title">CallCenter</span>
                        <?php echo strstr($content, 'gestion') ? '<span class="selected"></span>' : ''; ?>
                        <span class="arrow <?php echo strstr($content, 'gestion') ? 'open' : ''; ?>"></span>
                    </a>                   
                    <ul class="sub-menu">
                        <?php if (know_permission_role('GES', 'permission_add')): ?>
                            <li>
                                <a href="<?php echo base_url('index.php/gestion/add'); ?>">
                                    Agregar Gestion
                                </a>
                            </li>
                        <?php endif; ?>
                    </ul>
                </li>
            <?php endif; ?>      
                
            <?php if (know_permission_role('REP', 'permission_view')): ?>
                <li class="<?php echo strstr($content, 'report') ? 'active open' : ''; ?>">
                    <a href="javascript:;">
                        <i class="icon-book-open"></i>
                        <span class="title">Reportes</span>
                        <?php echo strstr($content, 'report') ? '<span class="selected"></span>' : ''; ?>
                        <span class="arrow <?php echo strstr($content, 'report') ? 'open' : ''; ?>"></span>
                    </a>                   
                    <ul class="sub-menu">
                        <?php if (know_permission_role('REP', 'permission_add')): ?>
                            <li>
                                <a href="<?php echo base_url('index.php/report'); ?>">
                                    Archivo Plano
                                </a>
                            </li>
                            <li>
                                <a href="<?php echo base_url('index.php/report/excel'); ?>">
                                    Archivo Excel
                                </a>
                            </li>
                        <?php endif; ?>
                    </ul>
                </li>
            <?php endif; ?>                 

            <?php if (know_permission_role('COR', 'permission_view')): ?>
                <li class="<?php echo strstr($content, 'mail') ? 'active open' : ''; ?>">
                    <a href="javascript:;">
                        <i class="icon-envelope-open"></i>
                        <span class="title">Correos</span>
                        <?php echo strstr($content, 'mail') ? '<span class="selected"></span>' : ''; ?>
                        <span class="arrow <?php echo strstr($content, 'mail') ? 'open' : ''; ?>"></span>
                    </a>                   
                    <ul class="sub-menu">
                        <?php if (know_permission_role('COR', 'permission_add')): ?>
                            <li>
                                <a href="<?php echo base_url('index.php/mail/add'); ?>">
                                    Enviar Correo
                                </a>
                            </li>
                        <?php endif; ?>
                        <?php if (know_permission_role('COR', 'permission_edit')): ?>
                            <li>
                                <a href="<?php echo base_url('index.php/mail/edit'); ?>">
                                    Editar Plantilla
                                </a>
                            </li>
                        <?php endif; ?>                            
                    </ul>
                </li>
            <?php endif; ?>                  
                
            <?php if (know_permission_role('USU', 'permission_view')): ?>
                <li class="<?php echo strstr($content, 'user') ? 'active open' : ''; ?>">
                    <a href="javascript:;">
                        <i class="icon-user"></i>
                        <span class="title">Usuarios del Sistema</span>
                        <?php echo strstr($content, 'user') ? '<span class="selected"></span>' : ''; ?>
                        <span class="arrow <?php echo strstr($content, 'user') ? 'open' : ''; ?>"></span>
                    </a>                   
                    <ul class="sub-menu">
                        <li>
                            <a href="<?php echo base_url('index.php/user'); ?>">
                                Listado de Usuarios
                            </a>
                        </li>
                        <?php if (know_permission_role('USU', 'permission_add')): ?>
                            <li>
                                <a href="<?php echo base_url('index.php/user/add'); ?>">
                                    Agregar Usuario
                                </a>
                            </li>
                        <?php endif; ?>
                    </ul>
                </li>
            <?php endif; ?>            


            <?php if (know_permission_role('ROL', 'permission_view')): ?>
                <li class="<?php echo strstr($content, 'config') ? 'active open' : ''; ?>">
                    <a href="javascript:;">
                        <i class="icon-settings"></i>
                        <span class="title">Sistema</span>
                        <?php echo strstr($content, 'config') ? '<span class="selected"></span>' : ''; ?>
                        <span class="arrow <?php echo strstr($content, 'config') ? 'open' : ''; ?>"></span>
                    </a>
                    <ul class="sub-menu">
                        <li>
                            <a href="<?php echo base_url('index.php/config/roles'); ?>">
                                Roles
                            </a>
                        </li>
                    </ul>
                </li>
            <?php endif; ?>

            <?php /* if (know_permission_role('EST', 'permission_view')): ?>
              <li class="<?php echo strstr($content, 'statistics') ? 'active open' : ''; ?>">
              <a href="javascript:;">
              <i class="icon-bar-chart"></i>
              <span class="title">Reportes</span>
              <?php echo strstr($content, 'statistics') ? '<span class="selected"></span>' : ''; ?>
              <span class="arrow <?php echo strstr($content, 'statistics') ? 'open' : ''; ?>"></span>
              </a>
              <ul class="sub-menu">
              <li>
              <a href="<?php echo base_url('index.php/statistics/reporte1'); ?>">
              Evaluados
              </a>
              </li>
              </ul>
              </li>
              <?php endif; */ ?>

        </ul>
        <!-- END SIDEBAR MENU -->
    </div>
</div>