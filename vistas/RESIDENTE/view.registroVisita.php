<?php
require '../vistas/CabezaPies/header.php';
?>

<!--Contenido-->
      <!-- Content Wrapper. Contains page content -->
      <div class="content-wrapper blk-main-qr">        
        <!-- Main content -->
        <section class="content blk-main">
            <div class="row">
              <div class="col-md-12">
                  <div class="box">
                    <div class="box-header with-border">
                          <h1 class="box-title">Registro de Visitas</h1>
                        <div class="box-tools pull-left">
                        </div>
                    </div>
                    <!-- /.box-header -->
                            
     
                    <!-- centro -->
                    <div class="panel-body table-responsive" id="listadoregistrosV">
                      <section class="profile-data blk-2">
                          <div class="contenido">
                            <div class="form-group row">
                              <div class="form-group col-md-12 modal-password">
                                <label>Acciones</label><br>
                                <button type="button" class="btn btn-primary" data-toggle="modal" data-target="#visitaModal" data-whatever="@mdo"> + Registrar Visita</button>
                              </div>
                            </div>
                          </div>
                        </section>

                        <div class="panel-body table-responsive" style="height: 500px;">
                          <div class="container">
                              <div class="row m-b-30">
                                  <div class="col-lg-12 col-xl-12">
                                      <div style="position: sticky; top: 0; z-index: 1000;">
                                          <!-- Nav tabs -->
                                          <ul class="nav nav-tabs md-tabs" role="tablist">
                                              <li class="nav-item">
                                                  <a class="nav-link active" data-toggle="tab" href="#VisitaActive" role="tab">visitas Activas</a>
                                                  <div class="slide"></div>
                                              </li>
                                              <li class="nav-item">
                                                  <a class="nav-link" data-toggle="tab" href="#VisitaTerminada" role="tab">Visitas Terminadas</a>
                                                  <div class="slide"></div>
                                              </li>
                                              <li class="nav-item">
                                                  <a class="nav-link" data-toggle="tab" href="#VisitasVencidas" role="tab">Visitas Vencidas</a>
                                                  <div class="slide"></div>
                                              </li>
                                              <!-- Otras pestañas, si es necesario -->
                                          </ul>
                                      </div>
                                      
                                      <!-- Tab panes -->

                                      <div class="tab-content card-block" style="height: 500px; overflow-y: auto;">
                                        <div class="tab-pane active" id="VisitaActive" role="tabpanel" style="background:white;">
                                            <br>  
                                            <div class="panel-body table-responsive" style="height: 500px;">
                                              <table id = "tblAllVisitas" class="table table-striped table-bordered table-condensed table-hover">
                                                    <thead>
                                                      <th>Nombre_Visitante</th>
                                                      <th>Clave</th>
                                                      <th>TipoAcceso</th>
                                                      <th>CantidadPersonas</th>
                                                      <th>FechaEstimada</th>
                                                      <th>FechaIngreso</th>
                                                      <th>FechaSalida</th>
                                                      <th>Visita</th>
                                                      <th>Registro</th>
                                                      <th>Detalles</th>
                                                    </thead>
                                              </table>   
                                            </div>
                                          </div>

                                          <div class="tab-pane active" id="VisitaTerminada" role="tabpanel" style="background:white;">
                                            <br>  
                                            <div class="panel-body table-responsive" style="height: 500px;">
                                              <table id = "tblVisitasTerminadas" class="table table-striped table-bordered table-condensed table-hover">
                                                    <thead>
                                                      <th>Nombre_Visitante</th>
                                                      <th>TipoAcceso</th>
                                                      <th>FechaEstimada</th>
                                                      <th>FechaIngreso</th>
                                                      <th>FechaSalida</th>
                                                      <th>Estado</th>
                                                    </thead>
                                              </table>   
                                            </div>
                                          </div>

                                          <div class="tab-pane active" id="VisitasVencidas" role="tabpanel" style="background:white;">
                                            <br>  
                                            <div class="panel-body table-responsive" style="height: 500px;">
                                              <table id = "tblVisitasVencidas" class="table table-striped table-bordered table-condensed table-hover">
                                                    <thead>
                                                      <th>Nombre_Visitante</th>
                                                      <th>TipoAcceso</th>
                                                      <th>FechaEstimada</th>
                                                      <th>FechaIngreso</th>
                                                      <th>FechaSalida</th>
                                                      <th>Estado</th>
                                                    </thead>
                                              </table>   
                                            </div>
                                          </div>
                                          
                                          <!-- Otras pestañas, si es necesario -->
                                      </div>
                                  </div>
                              </div>
                          </div>
                      </div>    
                    </div>

                    <!-- START MODAL REGISTRO-->
                    <div class="modal fade" id="visitaModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel">
                              <div class="modal-dialog" role="document">
                                <div class="modal-content">
                                  <div class="modal-header">
                                    <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                                    <h4 class="modal-title" id="exampleModalLabel">Registro de Visitas</h4>
                                  </div>
                                  <form method="POST" id="RegistroVisitante" name="RegistroVisitante">
                      
                                  <div class="modal-body">

                                  <section class="profile-data blk-1">
                                    <!--<div id="qr-reader"></div>-->

                                    <!--<div class="contenido">-->
                                    <div>
                                      <h3>Datos Personales:</h3>
                                      <div class="form-group row">
                                        <div class="form-group col-md-6">
                                          <label>Nombre</label>
                                          <input type="text" name="nombreVisitante" class="form-control" id="nombreVisitante" minlength="3" required>
                                        </div>
                                        <div class="form-group col-md-6">
                                          <label>Apellido Paterno</label>
                                          <input type="text" name="ApVisitante" class="form-control" id="ApVisitante" minlength="3" required>
                                        </div>
                                        <div class="form-group col-md-6">
                                          <label>Apellido Materno</label>
                                          <input type="text" name="AmVisitante" class="form-control" id="AmVisitante" minlength="3" required>
                                        </div>
                                        <div class="form-group col-md-6">
                                          <label>Cantidad de personas</label>
                                          <input type="number" name="CantidadVisitante" class="form-control" id="CantidadVisitante" min="0" max="50" required>
                                        </div>
                                      </div>
                                      <div class="form-group row">
                                        <div class="form-group col-md-6">
                                          <label>Tipo de Acceso</label>             
                                            <select class="form-control selectpicker" data-show-subtext="true" data-live-search="true" name="TipoAcceso" id="TipoAcceso">
                                                <!-- Opciones cargadas dinámicamente con JavaScript -->
                                            </select>                         
                                        </div>
                                      </div>
                                    </div>
                                  </section><br>

                                  <section class="profile-data blk-2" id="section_automovil">
                                    <!--<div class="contenido">-->
                                    <div>
                                    <h3>Datos del Auto</h3>
                                      <div class="form-group row">
                                        <div class="form-group col-md-6">
                                          <label>Marca</label>
                                          <input type="text" name="MarcaAutoVisitante" class="form-control" id="MarcaAutoVisitante" minlength="3" required>
                                        </div>
                                        <div class="form-group col-md-6">
                                          <label>Modelo</label>
                                          <input type="text" name="ModeloAutoVisitante" class="form-control" id="ModeloAutoVisitante" minlength="3" required min="1900" max="2025">
                                        </div>
                                        <div class="form-group col-md-6">
                                          <label>Color</label>
                                            <select class="form-control selectpicker" data-show-subtext="true" data-live-search="true" name="ColorAutoVisitante" id="ColorAutoVisitante">
                                              
                                            </select> 
                                        </div>
                                        <div class="form-group col-md-6">
                                          <label>Placa</label>
                                          <input type="text" name="PlacaAutoVisitante" class="form-control" id="PlacaAutoVisitante" minlength="3" required>
                                        </div>
                                      </div>
                                    </div>
                                  </section><br>

                                  <section class="profile-data blk-2">
                                    <!--<div class="contenido">-->
                                    <div>
                                    <h3>Tiempo / Estancia:</h3>
                                      <div class="form-group row">
                                        <div class="form-group col-md-6">
                                          <label>Fecha Estimada</label>
                                          <input type="datetime-local" name="FechaEstimadaVisitante" class="form-control" id="FechaEstimadaVisitante" minlength="3" required>
                                        </div>
                                        <!--<div class="form-group col-md-6">
                                          <label>Fecha Salida</label>
                                          <input type="datetime-local" name="FechaSalidaVisitante" class="form-control" id="FechaSalidaVisitante" minlength="3" required min="1900" max="2025">
                                        </div>-->
                                        <div class="form-group col-md-6">
                                          <label>Tipo de Servicio</label>
                                            <select class="form-control selectpicker" data-show-subtext="true" data-live-search="true" name="ServicioVisitante" id="ServicioVisitante">
                                              
                                            </select> 
                                        </div>
                                      </div>
                                    </div>
                                  </section>
                                </div>

                                <section class="profile-data">
                                    <!--<div class="contenido">-->
                                    <div>
                                      <div class="form-group row blk-btns">        
                                        <button class="btn btn-primary btn-sbmt" type="submit" id="btnRegistroVisitante"><i class="fa fa-save"></i> Guardar Registro</button>
                                        <button class="btn btn-danger btn-cncl" type="button" onclick="LimpiarDatos()"><i class="fa fa-arrow-circle-left"></i> Cancelar</button>
                                        <!--<button class="btn btn-info btn-cncl" type="button" onclick="VerificaFormatoFecha()"><i class="fa fa-eye"></i>VERIFICAR FORMATO</button>-->
                                      </div>
                                    </div>
                                  </section><br>
                                  </form>
                                </div>
                              </div>
                            </div>
                        <!-- END MODAL REGISTRO -->
                    <!--Fin centro -->

                    <!-- START MODAL VISITANTE-->
                    <div class="modal fade" id="detallesModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel">
                              <div class="modal-dialog" role="document">
                                <div class="modal-content modal-qr-container">
                                  <div class="modal-header">
                                    <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                                    <h4 class="modal-title" id="exampleModalLabel">GreenTechEIM</h4>
                                  </div>
                                  <div class="modal-body">
                                    <form>
                                      <div class="form-group col-md-12">
                                        <label class="form-control name-title-card-scaner">Detalles de Visita</label><!-- AQUÍ SE COLOCA EL TIPO DE CARGO -->
                                      </div>

                                      <div id ="espacioQR">
                                        <canvas id="miCanvas" width="900" height="1500" style="display: none;"></canvas>
                                        <div class="form-group row scanner-container">
                                          <img src="" class="img-QR p-1 border" id="MiQR"><br>
                                          <!--<button type="button" id="generarImagen" class="btn btn-primary btn-sbmt-modal" onclick="GuardarImagen(url)">Descargar QR</button>-->
                                        </div>
                                      </div>

                                      <div class="form-group col-md-12">
                                        <label class="form-control name-title-second-card-scaner">Datos Generales</label>
                                      </div>

                                      <div class="form-group col-md-12">
                                          <label class="form-control name-card-scaner" id=""><i class="fa fa-user" style="font-size:24px;color:black"></i><label id="NombreVisitanteModal"></label></label>
                                      </div>

                                      <div class="form-group col-md-6">
                                          <span class="span-data-card">
                                            <label class="form-control data-card" id=""><i class="fa fa-key" style="font-size:24px;color:black"></i><label id="ClaveVisitanteModal" style="font-size: 12px;"></label></label>
                                          </span>
                                        </div>

                                        <div class="form-group col-md-6">
                                          <span class="span-data-card">
                                            <label class="form-control data-card" id=""><i class="fa fa-share-square-o" style="font-size:24px;color:black"></i><label id="AccesoVisitanteModal" style="font-size: 15px;"></label></label>
                                          </span>
                                        </div>

                                        <div class="form-group col-md-6">
                                          <span class="span-data-card">
                                            <label class="form-control data-card" id=""><i class="fa fa-group" style="font-size:24px;color:black"></i><label id="CantidadPersonasVisitanteModal"></label></label>
                                          </span>
                                        </div>

                                        <div class="form-group col-md-6">
                                          <span class="span-data-card">
                                            <label class="form-control data-card" id=""><i class="fa fa-home" style="font-size:24px;color:black"></i><label id="CasaVisitanteModal"></label></label>
                                          </span>
                                        </div>
                                      
                                      <div class="form-group col-md-12">
                                        <label class="form-control name-title-second-card-scaner">Automóvil</label>
                                      </div>
                                      <div class="form-group col-md-6">
                                          <span class="span-data-card">
                                            <label class="form-control data-card" id=""><i class="fa fa-car" style="font-size:24px;color:black"></i><label id="MarcaAutoVisitanteModal"></label></label>
                                          </span>
                                        </div>
                                        <div class="form-group col-md-6">
                                          <span class="span-data-card">
                                            <label class="form-control data-card" id=""><i class="fa fa-cubes" style="font-size:24px;color:black"></i><label id="ModeloAutoVisitanteModal"></label></label>
                                          </span>
                                        </div>
                                        <div class="form-group col-md-6">
                                          <span class="span-data-card">
                                            <label class="form-control data-card" id=""><i class="fa fa-dashboard" style="font-size:24px;color:black"></i><label id="ColorAutoVisitanteModal"></label></label>
                                          </span>
                                        </div>
                                        <div class="form-group col-md-6">
                                          <span class="span-data-card">
                                            <label class="form-control data-card" id=""><i class="fa fa-list" style="font-size:24px;color:black"></i><label id="PlacaAutoVisitanteModal"></label></label>
                                          </span>
                                        </div>

                                      <div class="form-group col-md-12">
                                        <label class="form-control name-title-second-card-scaner">Motivo</label>
                                      </div>
                                      <div class="form-group col-md-12">
                                          <span class="span-data-card">
                                            <label class="form-control data-card" id=""><i class="fa fa-clock-o" style="font-size:24px;color:black"></i><label id="FechaEstimadaVisitanteModal"></label></label>
                                          </span>
                                        </div>
                                        <div class="form-group col-md-12">
                                          <span class="span-data-card">
                                            <label class="form-control data-card" id=""><i class="fa fa-tasks" style="font-size:24px;color:black"></i><label id="ServicioVisitanteModal"></label></label>
                                          </span>
                                        </div>

                                    </form>
                                  </div>
                                  <div class="modal-footer">
                                    <div class="form-group col-md-12 blk-btns">
                                    <center>
                                    <!--<button type="button" class="btn btn-primary btn-sbmt-modal-card">REGISTRAR</button>-->
                                    <button class="btn btn-danger btn-cncl" type="button" onclick="CloseDetallesModal()"><i class="fa fa-times"></i> Cerrar</button>
                                    </center>
                                    </div>
                                  </div>
                                </div>
                              </div>
                            </div>
                      </div>
                    <!--Fin centro -->
                
                  </div><!-- /.box -->
              </div><!-- /.col -->
          </div><!-- /.row -->
      </section><!-- /.content -->
    </div><!-- /.content-wrapper -->
  <!--Fin-Contenido-->


<?php
require '../vistas/CabezaPies/footer.php';
?>

<script src="../vistas/scripts/Residente/registroVisitante.js"></script>
<script src="../vistas/scripts/Residente/Visitante.js"></script>