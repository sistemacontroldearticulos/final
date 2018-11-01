<div class="content-wrapper">
    <section class="content-header">
        <h1>
            Administrar Programas
        </h1>
        <ol class="breadcrumb">
            <li>
                <a href="inicio">
                    <i class="fa fa-dashboard">
                    </i>
                    Inicio
                </a>
            </li>
            <li class="active">
                Administrar Programas
            </li>
        </ol>
    </section>
    <section class="content">
        <div class="box">
            <div class="box-header with-border">
                <button class="btn btn-primary" data-target="#modalAgregarPrograma" data-toggle="modal">
                    Agregar Programa
                </button>
            </div>
            <div class="box-body">
                <table class="table table-bordered table-striped dt-responsive tablas">
                    <thead>
                        <tr>
                            <th style="width:10px">
                                #
                            </th>
                            <th>
                                Nombre
                            </th>
                            <th>
                                Duración
                            </th>
                            <th>
                                Acciones
                            </th>
                        </tr>
                    </thead>
                    <tbody>
                        <tr>
                            <td>
                                1
                            </td>
                            <td>
                                Programa
                            </td>
                            <td>
                                Duracion
                            </td>
                            <td>
                                <div class="btn-group">
                                    <button class="btn btn-warning">
                                        <i class="fa fa-pencil">
                                        </i>
                                    </button>
                                    <button class="btn btn-danger">
                                        <i class="fa fa-times">
                                        </i>
                                    </button>
                                </div>
                            </td>
                        </tr>
                    </tbody>
                </table>
            </div>
        </div>
    </section>
</div>
<!-- MODAL AGREGAR USUARIO -->
<div class="modal fade" id="modalAgregarPrograma" role="dialog">
    <div class="modal-dialog">
        <div class="modal-content">
            <form enctype="multipart/form-data" method="post" role="form">
                <!-- CABEZA DEL MODAL -->
                <div class="modal-header" style="background:#3c8dbc; color:white">
                    <button class="close" data-dismiss="modal" type="button">
                        ×
                    </button>
                    <h4 class="modal-title">
                        Agregar Programa
                    </h4>
                </div>
                <div class="modal-body">
                    <!-- CUERPO DEL MODAL -->
                    <div class="box-body">
                        <!-- ENTRADA PARA EL USUARIO -->
                        <div class="form-group">
                            <div class="input-group">
                                <span class="input-group-addon">
                                    <i class="fa fa-user">
                                    </i>
                                </span>
                                <input class="form-control input-lg" name="nuevoPrograma" placeholder="Ingresar nombre" required="" type="text">
                                </input>
                            </div>
                        </div>
                        <!-- ENTRADA PARA SELECCIONAR SU PERFIL -->
                        <div class="form-group">
                            <div class="input-group">
                                <span class="input-group-addon">
                                    <i class="fa fa-users">
                                    </i>
                                </span>
                                <select class="form-control input-lg" name="TipoPrograma" onchange="duracion(this.value)">
                                    <option value="">
                                        Selecionar Tipo de Programa
                                    </option>
                                    <option value="Tecnico">
                                        Técnico
                                    </option>
                                    <option value="Tecnologo">
                                        Tecnólogo
                                    </option>
                                    <option value="Complementario">
                                        Complementario
                                    </option>
                                </select>
                            </div>
                        </div>
                        <div class="form-group">
                            <div class="input-group">
                                <span class="input-group-addon">
                                    <i class="fa fa-user">
                                    </i>
                                </span>
                                <input class="form-control input-lg" name="nuevaDuracion" placeholder="Duracion" required="" type="text">
                                </input>
                            </div>
                        </div>
                    </div>
                </div>
                <!-- PIE DEL MODAL -->
                <div class="modal-footer">
                    <button class="btn btn-default pull-left" data-dismiss="modal" type="button">
                        Salir
                    </button>
                    <button class="btn btn-primary" type="submit">
                        Guardar usuario
                    
                </div>
            </form>
        </div>
    </div>
</div>