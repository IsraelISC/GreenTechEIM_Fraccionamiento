<?php
require '../vistas/CabezaPies/header.php';
?>
<!--Contenido-->
<!-- Content Wrapper. Contains page content -->
<div class="content-wrapper blk-main-qr">
  <!-- Main content -->
  <section class="content">
    <div class="row">
      <div class="col-md-12">
        <div class="box">
          <div class="box-header with-border">
            <h1 class="box-title">Mi QR</h1>
            <div class="box-tools pull-left">
            </div>
          </div>
          <!-- Botón para generar y descargar la imagen -->


          <!-- Lienzo donde se dibujará la imagen -->
          <canvas id="miCanvas" width="900" height="1500" style="display: none;"></canvas>
          <!-- /.box-header -->
          <!-- centro -->
          <div class="panel-body table-responsive" id="listadoregistros">
            <section class="profile-data">
              <div class="contenido">
              </div>
            </section>
            <section class="profile-data blk-1">
              <div class="contenido">
                <div class="form-group row scanner-container">
                  <img src="" class="img-QR p-1 border" id="MiQR">
                  <br>
                  <h3 class="name-user-qr">Recuerda que miQR es único e intransferible</h3>
                  <!-- Botón para generar y descargar la imagen -->
                  <button id="generarImagen" class="btn btn-primary btn-sbmt-modal"
                    onclick="GuardarImagen(url)">Descargar QR</button>
                </div>
              </div>
            </section>
            <br>

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
require '../config/Encryp.php';
?>
<script>

  var qr = <?php echo json_encode(encryptData($_SESSION['IdUsuario'])); ?>;
</script>
<script src="../vistas/scripts/General/miqr.js"></script>