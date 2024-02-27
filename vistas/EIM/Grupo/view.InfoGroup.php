<?php
require '../vistas/CabezaPies/header.php';
?>
<script
  src="https://cdn.tiny.cloud/1/l31vqz6h2ihro8jvxz4osu38a7chq573ov80reasfjfvo72t/tinymce/5/tinymce.min.js"></script>
<link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/choices.js/public/assets/styles/choices.min.css" />
<!--Contenido-->
<!-- Content Wrapper. Contains page content -->
<div class="content-wrapper">
  <!-- Main content -->
  <section class="content blk-main">
    <div class="row">
      <div class="col-md-12">
        <div class="box container-box">
          <div class="box-header with-border">
            <h1 class="box-title">PUBLICACIONES</h1>
            <div class="box-tools pull-left">
            </div>
          </div>
          <!-- /.box-header -->
          <!-- centro -->

          <div class="modal-body">
            <section class="profile-data blk-1">
              <div class="contenido">
                <div class="form-group row">
                  <div class="form-group col-md-12">
                    <div class="container container__chat">

                      <div id="InfoGrupo" class="row">
                        <!-- Aquí puedes tener tarjetas existentes o dejarlo vacío para agregar nuevas con jQuery -->
                        <div class="panel-body">

                          <nav class="navbar navbar-light bg-light">
                            <div class="container" id="container-groups-action-btns">
                              <h1 class="box-title" id="InfoGrupoText">--</h1>
                              <button type="button" class="btn btn-primary" data-toggle="modal"
                                data-target="#MandarMensaje" data-whatever="@mdo"><i class="fa fa-commenting"></i>
                                Mandar Aviso</button>

                              <!-- <button type="button" class="btn btn-secondary" data-toggle="modal"
                                data-target="#exampleModal" data-whatever="@mdo"><i class="fa fa-user-plus"></i> Agregar
                                Residente al Grupo</button> -->
                                <button type="button" class="btn btn-danger" onclick="regresarVentana()">
                                  <i class="fa fa-arrow-left"></i> Regresar
                              </button>
                            </div>
                            <div class="container-groupCode">
                              <h3 style="color:snow;">Avisos en el Grupo</h3><button type="button"
                                class="btn btn-success" id="MensajeInfo"></button>
                            </div>
                          </nav>
                          <div class="contenido content-chat">
                            <div class="container__chat__box">
                              <div id="contenedorDeSMS" class="row">
                                <!-- Aquí puedes tener tarjetas existentes o dejarlo vacío para agregar nuevas con jQuery -->

                              </div>
                              <div class="form-group row">
                                <div class="form-group col-md-12">
                                  <div class="message_notify" id="ModeloSMS">
                                    <div class="group__notify">
                                      <img src="../files/FotoPerfil/groups.jpg"
                                        class="img-circle img-panel-short__notify" alt="User Image">
                                      <h4 class="title__group">ADMINISTRADOR</h4>
                                    </div>
                                    <h4 class="title">ASUNTO</h4>
                                    <div class="description_notify">Texto de ejemplo</div>
                                    <p class="time">12:14pm</p>
                                  </div>
                                </div>
                              </div>
                            </div>
                          </div>

                        </div>


                      </div>
                    </div>
                  </div>

                </div>
              </div>
            </section>

          </div>
          <div class="modal fade" id="MandarMensaje" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel">
            <div class="modal-dialog" role="document">
              <div class="modal-content">
                <div class="modal-header">
                  <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span
                      aria-hidden="true">&times;</span></button>

                  <h4 class="modal-title" id="exampleModalLabel">Mi Mensaje</h4>
                </div>
                <form method="POST" id="MensajeForm" name="MensajeForm">
                  <div class="modal-body">
                    <section class="profile-data blk-1">
                      <div class="contenido">
                        <h4>Complete los Datos:</h4>
                        <div class="form-group row">
                          <div class="form-group col-md-12">
                            <label>Asunto</label>
                            <input type="text" name="asuntoMensaje" class="form-control" id="asuntoMensaje"
                              minlength="3" required>
                          </div>
                        </div>
                        <div class="form-group row">
                          <div class="form-group col-md-12">
                            <textarea id="MensajeText" name="MensajeText" class="form-control"></textarea>
                          </div>

                        </div>
                      </div>
                    </section>
                  </div>

                  <div class="modal-footer">
                    <section class="profile-data">
                      <div class="contenido">
                        <div class="form-group row blk-btns">
                          <button class="btn btn-primary btn-sbmt" type="submit" id="btnMandarMensaje"><i
                              class="fa fa-save"></i> Mandar Aviso</button>
                          <button class="btn btn-danger btn-cncl" type="button" onclick="LimpiarDatos()"><i
                              class="fa fa-arrow-circle-left"></i> Cancelar</button>
                        </div>
                      </div>
                    </section>
                  </div>
                  <input type="hidden" name="valGrupo" id="valGrupo" minlength="3" required>
                </form>
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
<script src="https://cdn.jsdelivr.net/npm/choices.js/public/assets/scripts/choices.min.js"></script>
<script src="../vistas/scripts/General/infoGrupo.js"></script>