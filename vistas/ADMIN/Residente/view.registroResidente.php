<?php
require '../vistas/CabezaPies/header.php';
?>
<!--Contenido-->
<!-- Content Wrapper. Contains page content -->
<div class="content-wrapper">
  <!-- Main content -->
  <section class="content blk-main">
    <div class="row">
      <div class="col-md-12">
        <div class="box container-box">
          <div class="box-header with-border">
            <h1 class="box-title">Residente</h1>
            <div class="box-tools pull-left">
            </div>
          </div>
          <!-- /.box-header -->
          <!-- centro -->
          <div class="panel-body table-responsive" id="listadoregistros">
            <div id="alert-container">
            </div>
            <button type="button" class="btn btn-primary btn-general_design" data-toggle="modal" data-target="#registrarResidente"
              data-whatever="@mdo"><i class="fa fa-user-plus"></i> Registrar Residente</button>
            <br><br>
            <div class="panel-body table-responsive" id="listadoregistros" style="height: 500px;">
              <table id="tblAllResidentes" class="table table-striped table-bordered table-condensed table-hover">
                <thead>
                  <th>Foto Perfil</th>
                  <th>Nombre Completo</th>
                  <th>Nombre Usuario</th>
                  <th>Manzana</th>
                  <th>Lote</th>
                  <th>Número</th>
                  <th>Marca de Automóvil</th>
                  <th>Modelo</th>
                  <th>Placa</th>
                  <th>Estado</th>
                  <th>Herramientas</th>
                </thead>
                <tbody>
                  <th>Foto Perfil</th>
                  <th>Nombre Completo</th>
                  <th>Nombre Usuario</th>
                  <th>Manzana</th>
                  <th>Lote</th>
                  <th>Número</th>
                  <th>Marca de Automóvil</th>
                  <th>Modelo</th>
                  <th>Placa</th>
                  <th>Estado</th>
                  <th>Herramientas</th>
                </tbody>
              </table>
            </div>
            <!-- START MODAL -->
            <div class="modal fade" id="registrarResidente" tabindex="-1" role="dialog"
              aria-labelledby="exampleModalLabel">
              <div class="modal-dialog" role="document">
                <div class="modal-content">
                  <div class="modal-header">
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span
                        aria-hidden="true">&times;</span></button>

                    <h4 class="modal-title" id="exampleModalLabel">Registrar Residente</h4>
                  </div>
                  <form method="POST" id="RegistroResidente" name="RegistroResidente">
                    <div class="modal-body">
                      <section class="profile-data blk-1">
                        <div class="contenido">
                          <h3>Datos Personales:</h3>
                          <div class="form-group row">
                            <div class="form-group col-md-6">
                              <label>Nombre</label>
                              <input type="text" name="nombreResidente" class="form-control" id="nombreResidente"
                                minlength="3" required>
                            </div>
                            <div class="form-group col-md-6">
                              <label>Apellido Paterno</label>
                              <input type="text" name="ApResidente" class="form-control" id="ApResidente" minlength="3"
                                required>
                            </div>
                            <div class="form-group col-md-6">
                              <label>Apellido Materno</label>
                              <input type="text" name="AmResidente" class="form-control" id="AmResidente" minlength="3"
                                required>
                            </div>
                            <div class="form-group col-md-6">
                              <label>Fecha de Nacimiento</label>
                              <input type="date" name="FechaResidente" class="form-control" id="FechaResidente"
                                required>
                            </div>
                          </div>
                          <div class="form-group row">
                            <div class="form-group col-md-6">
                              <label>Correo Electrónico</label>
                              <input type="mail" name="EmailResidente" class="form-control" id="EmailResidente"
                                minlength="3" required>
                            </div>
                            <div class="form-group col-md-6">
                              <label>Numero de Teléfono</label>
                              <input type="tel" name="TelefonoResidente" class="form-control" id="TelefonoResidente"
                                minlength="3" required>
                            </div>
                          </div>
                        </div>
                      </section>
                      <br>
                      <section class="profile-data blk-2">
                        <div class="contenido">
                          <h3>Domicilio:</h3>
                          <div class="form-group row">
                            <div class="form-group col-md-6">
                              <label>Manzana</label>
                              <select class=" form-control selectpicker" data-show-subtext="true"
                                data-live-search="true" name="ManzanaResidente" id="ManzanaResidente">
                                <option value='' selected="true">Seleccionar una Manzana</option>
                                <option>1</option>
                                <option>2</option>
                                <option>3</option>
                                <option>4</option>
                              </select>
                            </div>
                            <div class="form-group col-md-6">
                              <label>Lote</label>
                              <select class="form-control selectpicker" data-show-subtext="true" data-live-search="true"
                                name="LoteResidente" id="LoteResidente">
                                <option>1-2</option>
                                <option>3-4</option>
                              </select>
                            </div>
                            <div class="form-group col-md-6">
                              <label>Numero</label>
                              <input type="text" name="NumeroResidente" class="form-control" id="NumeroResidente"
                                minlength="3" required>
                            </div>
                          </div>
                        </div>
                      </section>
                      <br>
                      <section class="profile-data blk-2">
                        <div class="contenido">
                          <h3>Automóvil:</h3>
                          <div class="form-group row">
                            <div class="form-group col-md-6">
                              <label>Marca</label>
                              <input type="text" name="AutomovilResidente" class="form-control" id="AutomovilResidente"
                                minlength="3" required>
                            </div>
                            <div class="form-group col-md-6">
                              <label>Modelo</label>
                              <input type="number" name="ModeloResidente" class="form-control" id="ModeloResidente"
                                minlength="3" required min="1900" max="2025">
                            </div>
                            <div class="form-group col-md-6">
                              <label>Placa</label>
                              <input type="text" name="PlacaResidente" class="form-control" id="PlacaResidente"
                                minlength="3" required>
                            </div>
                            <div class="form-group col-md-6">

                            </div>
                          </div>
                        </div>
                      </section>
                      <br>
                    </div>

                    <div class="modal-footer">
                      <section class="profile-data">
                        <div class="contenido">
                          <div class="form-group row blk-btns">
                            <button class="btn btn-primary btn-sbmt" type="submit" id="btnRegistroResidente"><i
                                class="fa fa-save"></i> Aplicar Cambios</button>
                            <button class="btn btn-danger btn-cncl" type="button" onclick="LimpiarDatos()"><i
                                class="fa fa-arrow-circle-left"></i> Cancelar</button>
                          </div>
                        </div>
                      </section>
                    </div>
                  </form>
                </div>
              </div>
            </div>
            <!--Modal Para editar campos-->
            <div class="modal fade" id="updateResidente" tabindex="-1" role="dialog"
              aria-labelledby="exampleModalLabel">
              <div class="modal-dialog" role="document">
                <div class="modal-content">
                  <div class="modal-header">
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span
                        aria-hidden="true">&times;</span></button>
                    <h4 class="modal-title" id="exampleModalLabel">Editar Residente</h4>
                  </div>
                  <form method="POST" id="UpdateResidente" name="UpdateResidente">
                    <div class="modal-body">
                      <section class="profile-data">
                        <div class="contenido">
                          <div class="form-group col-md-12">
                            <div class="alert-dismissible alert alert-warning">
                              <center><strong>Nota: </strong>Recuerda que los datos personales como Correo
                                Electrónico, Nombre y Número de Celular pueden ser cambiados por el residente desde
                                su perfil.
                              </center>
                            </div>
                          </div>
                        </div>
                      </section>
                      <section class="profile-data blk-2">
                        <div class="contenido">
                          <h3>Domicilio:</h3>
                          <div class="form-group row">
                            <div class="form-group col-md-6">
                              <label>Manzana</label>
                              <select class="form-control selectpicker" data-show-subtext="true" data-live-search="true"
                                name="ManzanaResidente" id="ManzanaResidenteUpdate">
                                <option value=''>Seleccionar una Manzana</option>
                                <option value="1">1</option>
                                <option value="2">2</option>
                                <option value="3">3</option>
                                <option value="4">4</option>
                                <option value="5">5</option>
                                <option value="6">6</option>
                                <option value="7">7</option>
                                <option value="8">8</option>
                              </select>
                            </div>
                            <div class="form-group col-md-6">
                              <label>Lote</label>
                              <select class="form-control selectpicker" data-show-subtext="true" data-live-search="true"
                                name="LoteResidente" id="LoteResidenteUpdate">
                                <option value=''>Seleccionar un Lote</option>
                                <option value="1-2">1-2</option>
                                <option value="3-4">3-4</option>
                              </select>
                            </div>
                            <div class="form-group col-md-6">
                              <label>Numero</label>
                              <input type="text" name="NumeroResidente" class="form-control" id="NumeroResidenteUpdate"
                                minlength="3" required>
                            </div>
                          </div>
                        </div>
                      </section>
                      <br>
                      <section class="profile-data blk-2">
                        <div class="contenido">
                          <h3>Automóvil:</h3>
                          <div class="form-group row">
                            <div class="form-group col-md-6">
                              <label>Marca</label>
                              <input type="text" name="AutomovilResidente" class="form-control"
                                id="AutomovilResidenteUpdate" minlength="3" required>
                            </div>
                            <div class="form-group col-md-6">
                              <label>Modelo</label>
                              <input type="number" name="ModeloResidente" class="form-control"
                                id="ModeloResidenteUpdate" minlength="3" required min="1900" max="2025">
                            </div>
                            <div class="form-group col-md-6">
                              <label>Placa</label>
                              <input type="text" name="PlacaResidente" class="form-control" id="PlacaResidenteUpdate"
                                minlength="3" required>
                            </div>
                            <div class="form-group col-md-6">

                            </div>
                          </div>
                        </div>
                      </section>
                      <br>
                    </div>

                    <div class="modal-footer">
                      <section class="profile-data">
                        <div class="contenido">
                          <div class="form-group row blk-btns">
                            <button class="btn btn-primary btn-sbmt" type="submit" id="btnUpdateResidente"><i
                                class="fa fa-save"></i> Guardar Cambios</button>
                            <button class="btn btn-danger btn-cncl" type="button" onclick="LimpiarDatos()"><i
                                class="fa fa-arrow-circle-left"></i> Cancelar</button>
                          </div>
                        </div>
                      </section>
                    </div>
                  </form>
                </div>
              </div>
            </div>
            <!--<form method="POST" id="RegistroResidente" name="RegistroResidente">                      
                        <section class="profile-data blk-1">
                          <div class="contenido">
                            <h3>Datos Personales:</h3>
                            <div class="form-group row">
                              <div class="form-group col-md-6">
                                <label>Nombre</label>
                                <input type="text" name="nombreResidente" class="form-control" id="nombreResidente" minlength="3" required>
                              </div>
                              <div class="form-group col-md-6">
                                <label>Apellido Paterno</label>
                                <input type="text" name="ApResidente" class="form-control" id="ApResidente" minlength="3" required>
                              </div>
                              <div class="form-group col-md-6">
                                <label>Apellido Materno</label>
                                <input type="text" name="AmResidente" class="form-control" id="AmResidente" minlength="3" required>
                              </div>
                              <div class="form-group col-md-6">
                                <label>Fecha de Nacimiento</label>
                                <input type="date" name="FechaResidente" class="form-control" id="FechaResidente" required>
                              </div>
                            </div>
                            <div class="form-group row">
                              <div class="form-group col-md-6">
                                <label>Correo Electrónico</label>
                                <input type="mail" name="EmailResidente" class="form-control" id="EmailResidente" minlength="3" required>
                              </div>
                              <div class="form-group col-md-6">
                                <label>Numero de Teléfono</label>
                                <input type="tel" name="TelefonoResidente" class="form-control" id="TelefonoResidente" minlength="3" required>
                              </div>
                            </div>
                          </div>
                        </section>
                        <br>
                        <section class="profile-data blk-2">
                          <div class="contenido">
                          <h3>Domicilio:</h3>
                            <div class="form-group row">
                              <div class="form-group col-md-6">
                                <label>Manzana</label>
                                <select class=" form-control selectpicker" data-show-subtext="true" data-live-search="true" name="ManzanaResidente" id="ManzanaResidente">
                                    <option value='' selected="true">Seleccionar una Manzana</option>
                                    <option>1</option>
                                    <option>2</option>
                                    <option>3</option>
                                    <option>4</option>
                                  </select>                                
                              </div>
                              <div class="form-group col-md-6">
                                <label>Lote</label>             
                                <select class="form-control selectpicker" data-show-subtext="true" data-live-search="true" name="LoteResidente" id="LoteResidente">
                                    <option>1-2</option>
                                    <option>3-4</option>
                                  </select>                                  
                              </div>
                              <div class="form-group col-md-6">
                                <label>Numero</label>
                                <input type="text" name="NumeroResidente" class="form-control" id="NumeroResidente" minlength="3" required>
                              </div>
                            </div>
                          </div>
                        </section>
                        <br>
                        <section class="profile-data blk-2">
                          <div class="contenido">
                          <h3>Automóvil:</h3>
                            <div class="form-group row">
                              <div class="form-group col-md-6">
                                <label>Marca</label>
                                <input type="text" name="AutomovilResidente" class="form-control" id="AutomovilResidente" minlength="3" required>
                              </div>
                              <div class="form-group col-md-6">
                                <label>Modelo</label>
                                <input type="number" name="ModeloResidente" class="form-control" id="ModeloResidente" minlength="3" required min="1900" max="2025">
                              </div>
                              <div class="form-group col-md-6">
                                <label>Placa</label>
                                <input type="text" name="PlacaResidente" class="form-control" id="PlacaResidente" minlength="3" required>
                              </div>
                              <div class="form-group col-md-6">
                                
                              </div>
                            </div>
                          </div>
                        </section>
                        <br>
                              <div id="alert-container"></div>
                        <br>
                        <section class="profile-data blk-2">
                          <div class="contenido">
                          <h3>Contraseña:</h3>
                            <div class="form-group row">
                              <div class="form-group col-md-6">
                                <label>Contraseña</label>
                                <input type="text" name="EmailPerfil" class="form-control" id="EmailPerfil" minlength="3" required autocomplete="off">
                              </div>
                              <div class="form-group col-md-6">
                                <label>Confirmar Contraseña</label>
                                <input type="text" name="TelefonoPerfil" class="form-control" id="TelefonoPerfil" minlength="3" required autocomplete="off">
                              </div>
                            </div>
                          </div>
                        </section>
                        <br>
                        <section class="profile-data">
                          <div class="contenido">
                            <div class="form-group row blk-btns">        
                              <button class="btn btn-primary btn-sbmt" type="submit" id="btnRegistroResidente"><i class="fa fa-save"></i> Aplicar Cambios</button>
                              <button class="btn btn-danger btn-cncl" type="button" onclick="LimpiarDatos()"><i class="fa fa-arrow-circle-left"></i> Cancelar</button>
                            </div>
                          </div>                          
                        </section>
                      </form>-->
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
<script src="../vistas/scripts/Admin/registroResidente.js"></script>