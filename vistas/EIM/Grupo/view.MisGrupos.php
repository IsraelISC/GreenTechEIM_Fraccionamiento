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
            <h1 class="box-title" id="InfoGrupoText">Mis Grupos</h1>
            <div class="box-tools pull-left">
            </div>
          </div>
          <!-- /.box-header -->
          <!-- centro -->

          <div class="modal-body">
            <button type="button" class="btn btn-success" data-toggle="modal" data-target="#JoinGroup"
              data-whatever="@mdo"><i class="fa fa-group"></i> Unirme a un Grupo</button>
            <br><br>
            <section class="profile-data blk-1">
              <div class="contenido">
                <div class="form-group row">
                  <div class="form-group col-md-12">
                    <div class="container-fluid">
                      <br>



                      <p id="EmptyGrupo"></p>
                      <div id="contenedorDeTarjetas" class="row">
                        <!-- Aquí puedes tener tarjetas existentes o dejarlo vacío para agregar nuevas con jQuery -->
                      </div>



                      <!--Modelo de Tarjeta-->
                      <div id="modeloTarjeta" class="form-group col-md-3 container_card_groups">
                        <div class="card">
                          <img
                            src="https://images.pexels.com/photos/8068108/pexels-photo-8068108.jpeg?auto=compress&cs=tinysrgb&w=600&lazy=load"
                            class="card-img-top" alt="...">
                          <div class="card-body">
                            <h4 class="card-title"></h4>
                            <p class="card-text">
                              Código para unirse: <strong></strong><br>
                              Fecha de Creación: <strong></strong>
                            </p>
                          </div>
                        </div>
                        <div class="card__blur">
                          <h1 class="card__blur__title"></h1>
                          <a href="#" class="btn btn-primary" onclick="verMasGrupo(true, 0)">Ver Más...</a>
                        </div>
                      </div>
                    </div>
                  </div>

                </div>
              </div>
            </section>
            <div class="modal fade" id="JoinGroup" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel">
              <div class="modal-dialog" role="document">
                <div class="modal-content">
                  <div class="modal-header">
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span
                        aria-hidden="true">&times;</span></button>

                    <h4 class="modal-title" id="exampleModalLabel">Unirme a un Grupo</h4>
                  </div>
                  <form method="POST" id="JoinGroupForm" name="JoinGroupForm">
                    <div class="modal-body">
                      <section class="profile-data blk-1">
                        <div class="contenido">
                          <div class="form-group row">
                            <div class="form-group col-md-12">
                              <label>Ingrese el código de Acceso</label>
                              <input type="text" name="codigoAcceso" class="form-control" id="codigoAcceso"
                                minlength="3" required>
                            </div>
                          </div>
                        </div>
                      </section>
                    </div>

                    <div class="modal-footer">
                      <section class="profile-data">
                        <div class="contenido">
                          <div class="form-group row blk-btns">
                            <button class="btn btn-primary btn-sbmt" type="button" id="btnJoinGroup"><i
                                class="fa fa-save"></i> Unirme</button>
                            <button class="btn btn-danger btn-cncl" type="button" onclick="limpiar()"><i
                                class="fa fa-arrow-circle-left"></i> Cancelar</button>
                          </div>
                        </div>
                      </section>
                    </div>
                  </form>
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
<script src="https://cdn.jsdelivr.net/npm/choices.js/public/assets/scripts/choices.min.js"></script>
<script src="../vistas/scripts/General/misGrupos.js"></script>