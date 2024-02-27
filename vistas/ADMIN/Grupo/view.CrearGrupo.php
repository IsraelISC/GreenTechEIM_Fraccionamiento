<?php
require '../vistas/CabezaPies/header.php';
?>
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
            <h1 class="box-title">Crear un Grupo</h1>
            <div class="box-tools pull-left">
            </div>
          </div>
          <!-- /.box-header -->
          <!-- centro -->
          <form method="POST" id="CreateGroup" name="CreateGroup">
            <div class="modal-body">
              <section class="profile-data blk-1 contenido__createGroups" style="height: auto;">
                <div class="contenido">
                  <h3>Complete los Siguientes Datos:</h3>
                  <div class="form-group row">
                    <div class="form-group col-md-12">
                      <label>Nombre del Grupo</label>
                      <input type="text" name="nombreGrupo" class="form-control" id="nombreGrupo" minlength="3" required>
                    </div>
                    <div class="form-group col-md-12">
                      <label>Seleccione a Los Residentes</label>
                      <select id="mySelect" multiple class="form-control" required name="NombreUsers[]"></select>


                      <!--Pruebas
      <select id="customSelect" multiple>

      </select>-->


                    </div>
                  </div>

                </div>
              </section>

            </div>

            <div class="modal-footer">
              <section class="profile-data">
                <div class="contenido">
                  <div class="form-group row blk-btns">
                    <button class="btn btn-primary btn-sbmt" type="submit" id="btnCreateGroup"><i class="fa fa-save"></i> Aplicar Cambios</button>
                    <button class="btn btn-danger btn-cncl" type="button" onclick="LimpiarDatos()"><i class="fa fa-arrow-circle-left"></i> Cancelar</button>
                  </div>
                </div>
              </section>
            </div>
          </form>
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
<script src="../vistas/scripts/Admin/grupo.js"></script>