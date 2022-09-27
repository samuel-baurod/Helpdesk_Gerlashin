<?php

    /* TODO: Rol 1 es del Usuario general */
    if ($_SESSION["rol_id"]==1){
        ?>
            <nav class="side-menu">
                <ul class="side-menu-list">
                    <li class="green-dirty">
                        <a href="..\Home\">
                            <span class="glyphicon glyphicon-home"></span>
                            <span class="lbl">Inicio</span>
                        </a>
                    </li>
                    <li class="green-dirty">
                        <a href="..\NuevoTicket\">
                            <span class="glyphicon glyphicon-plus"></span>
                            <span class="lbl">Nuevo Ticket</span>
                        </a>
                    </li>

                    <li class="green-dirty">
                        <a href="..\ConsultarTicket\">
                            <span class="glyphicon glyphicon-th-list"></span>
                            <span class="lbl">Consultar Ticket</span>
                        </a>
                    </li>
                </ul>
            </nav>
        <?php
    }else{
        ?>
            <nav class="side-menu">
                <ul class="side-menu-list">
                    <li class="green-dirty">
                        <a href="..\Home\">
                            <span class="glyphicon glyphicon-home"></span>
                            <span class="lbl">Inicio</span>
                        </a>
                    </li>
                    <li class="green-dirty">
                        <a href="..\MntUsuario\">
                            <span class="glyphicon glyphicon-wrench"></span>
                            <span class="lbl">Mant. Usuario</span>
                        </a>
                    </li>

                    <li class="green-dirty">
                        <a href="..\MntPrioridad\">
                            <span class="glyphicon glyphicon-wrench"></span>
                            <span class="lbl">Mant. Prioridad</span>
                        </a>
                    </li>

                    <li class="green-dirty">
                        <a href="..\MntCategoria\">
                            <span class="glyphicon glyphicon-wrench"></span>
                            <span class="lbl">Mant. Categoria</span>
                        </a>
                    </li>

                    <li class="green-dirty">
                        <a href="..\MntSubCategoria\">
                            <span class="glyphicon glyphicon-wrench"></span>
                            <span class="lbl">Mant. Sub Categoria</span>
                        </a>
                    </li>


                    <li class="green-dirty">
                        <a href="..\ConsultarTicket\">
                            <span class="glyphicon glyphicon-th-list"></span>
                            <span class="lbl">Consultar Ticket</span>
                        </a>
                    </li>
                </ul>
            </nav>
        <?php
    }
?>