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
                          <h1 class="box-title">Editar Perfil</h1>
                        <div class="box-tools pull-left">
                        </div>
                    </div>
                    <!-- /.box-header -->
                    <!-- centro -->
                    <div class="panel-body table-responsive" id="listadoregistros">
                      <form method="POST" id="DatosPerfil" name="DatosPerfil">
                      <section class="profile-data">
                          <div class="contenido">
                            <div class="form-group row">
                                <h1 class="name-user"><?php echo $_SESSION['Cargo'];?></h1><!-- AQUÍ SE COLOCA EL TIPO DE CARGO -->
                            </div>
                            <div class="form-group row">
                              <img class="img-profile" id="ImagenPerfil">
                              <div class="container-img">
                                Cargar Imagen
                                <label for="file-input" class="img-carga"></label>
                                <input class="load-img-profile" type="file" name="FotoPerfil" id="file-input">
                              </div>
                            </div>
                          </div>
                        </section>
                        <section class="profile-data blk-1">
                          <div class="contenido">
                            <div class="form-group row">
                              <div class="form-group col-md-6">
                                <label>Nombre</label>
                                <input type="text" name="nombrePerfil" class="form-control" id="nombrePerfil" minlength="3" required autocomplete="off">
                              </div>
                              <div class="form-group col-md-6">
                                <label>Apellido Paterno</label>
                                <input type="text" name="ApPerfil" class="form-control" id="ApPerfil" minlength="3" required autocomplete="off">
                              </div>
                              <div class="form-group col-md-6">
                                <label>Apellido Materno</label>
                                <input type="text" name="AmPerfil" class="form-control" id="AmPerfil" minlength="3" required autocomplete="off">
                              </div>
                              <div class="form-group col-md-6">
                                <label>Fecha de Nacimiento</label>
                                <input type="date" name="FechaPerfil" class="form-control" id="FechaPerfil" required autocomplete="off">
                              </div>
                            </div>
                          </div>
                        </section>
                        <br>
                        <section class="profile-data blk-2">
                          <div class="contenido">
                            <div class="form-group row">
                              <div class="form-group col-md-6">
                                <label>Correo Electrónico</label>
                                <input type="mail" name="EmailPerfil" class="form-control" id="EmailPerfil" minlength="3" required autocomplete="off">
                              </div>
                              <div class="form-group col-md-6">
                                <label>Numero de Teléfono</label>
                                <input type="tel" name="TelefonoPerfil" class="form-control" id="TelefonoPerfil" minlength="3" required autocomplete="off">
                              </div>
                            </div>
                          </div>
                        </section>
                        <br>
                        <section class="profile-data blk-2">
                          <div class="contenido">
                            <div class="form-group row">
                              <div class="form-group col-md-12 modal-password">
                                <label>Quieres cambiar tu contraseña?</label><br>
                                <button type="button" class="btn btn-primary" data-toggle="modal" data-target="#exampleModal" data-whatever="@mdo">Cambiar contraseña</button>
                              </div>
                            </div>
                          </div>
                        </section>
                        <br>
                        <section class="profile-data">
                          <div class="contenido">
                            <div class="form-group row blk-btns">
                              <!-- BTN-GENERAL -->
                              
                              <button class="btn btn-primary btn-sbmt" type="submit" id="btnGuardarPerfil"><i class="fa fa-save"></i> Aplicar Cambios</button>
                              <button class="btn btn-danger btn-cncl" type="button" onclick="LimpiarDatos()"><i class="fa fa-arrow-circle-left"></i> Cancelar</button>
                            </div>
                          </div>
                        </section>
                       </form>
                       <!-- START MODAL -->
                       <div class="modal fade" id="exampleModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel">
                              <div class="modal-dialog" role="document">
                                <div class="modal-content">
                                  <div class="modal-header">
                                    <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                                    <h4 class="modal-title" id="exampleModalLabel">Cambio de Contraseña</h4>
                                  </div>
                                  <form method="POST" id="PasswordContain" name="PasswordContain">
                                  <div class="modal-body">
    <div class="form-group">
        <label for="passwordOld" class="control-label">Contraseña:</label>
        <input type="password" class="form-control" id="passwordOld" name="passwordOld" required onkeyup="validatePassword()">
        <div id="passwordValidationMessage" style="color: red;"></div>
    </div>
    <div class="form-group">
        <label for="passwordNew" class="control-label">Confirmar Contraseña:</label>
        <input type="password" class="form-control" id="passwordNew" name="passwordNew" required onkeyup="SamePassword()">        
        <div id="passwordSameMessage" style="color: #FFD700;"></div>
    </div>
</div>

                                  <div class="modal-footer">
                                    <center>
                                    <button type="button" class="btn btn-default btn-cncl-modal" data-dismiss="modal" onclick="LimpiarDatos()">Cancelar</button>                   

                                    <button class="btn btn-primary btn-sbmt-modal" type="submit" id="btnGuardarPassword" name="btnGuardarPassword" form="PasswordContain">Aplicar Cambios</button>
                                                            
                                    </center>
                                  </div>
                                  </form>
                                </div>
                              </div>
                            </div>
                        <!-- END MODAL -->
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

<script src="../vistas/scripts/General/perfil.js"></script>