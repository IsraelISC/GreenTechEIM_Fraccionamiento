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
                  <div class="box container-box">
                    <div class="box-header with-border">
                          <h1 class="box-title">Escaneo QR</h1>
                        <div class="box-tools pull-left">
                        </div>
                    </div>
                    <!-- /.box-header -->
                    <!-- centro -->
                    <div class="panel-body table-responsive qr-reader-container" id="listadoregistros">
                      <form method="POST" id="AltaVacante" name="AltaVacante">
                      <section class="profile-data">
                          <div class="contenido">
                          </div>
                        </section>
                        <section class="profile-data blk-1">
                          <div class="contenido">
                            <div class="form-group row scanner-container2">
                            <div id="qr-reader"></div>
                                <div style="position:absolute; top:0px; left:520px" id="qr-reader-results"></div>
                                <div id="result-container">
                                    
                                </div>
                            </div>
                          </div>                            
                        </section>
                        <br>
                       </form>
                       
                       <!-- START MODAL -->
                       <div class="modal fade" id="residenteModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel">
                              <div class="modal-dialog" role="document">
                                <div class="modal-content modal-qr-container">
                                  <div class="modal-header">
                                    <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                                    <h4 class="modal-title" id="exampleModalLabel">GreenTechEIM</h4>
                                  </div>
                                  <div class="modal-body">
                                    <form>
                                      <div class="form-group col-md-12">
                                        <label class="form-control name-title-card-scaner">Acceso Qr</label><!-- AQU�0�1 SE COLOCA EL TIPO DE CARGO -->
                                      </div>
                                      <div class="form-group">
                                        <div class="img-profile-card-pendient"  id="ImagenPerfil">
                                          <img src="" alt="" id="FotoPerfilModal">
                                          <span></span>
                                        </div>
                                      </div>
                                      <div class="form-group col-md-12">
                                          <label class="form-control name-card-scaner" id="NombreModal"></label>
                                      </div>
                                        <div class="form-group col-md-6">
                                          <span class="span-data-card">
                                            <label class="form-control data-card" id=""><img src="data:image/png;base64,iVBORw0KGgoAAAANSUhEUgAAADwAAAA8CAYAAAA6/NlyAAAAAXNSR0IArs4c6QAAAf9JREFUaEPt2e1RBCEMBuD3OtFOtBK1ErUStRLtRK1EJzOLH3t8JCEE9LIz/mMhTwI4mzvgxJ7DiXkR4P9e8aiwQ4XvAFxt69wDeHRY82sJ7wo/ALjeAQlNSXB5PME5bEK6ob3ANawr2gPMwbqhR4MlWBf0SHANSzfzO4Dbwk017EyPArewNxuUbmdX9AgwF5uK64q2Bkux7mhLsBbrirYC92Ld0BZgK6wLuhdsjR2O7gGPwg5Fa8GjscPQGrAXdghaCvbGmqMl4FlYUzQXPBtrhuaAV8GaoFvg1vds6/1RfaqPysTVT8tawC0srbkimOIqoksB1z7ZfiZ3VTDFSN/cRy3gUsC1LfNXwC8ALvdbvwR+BXDGOIArV/gNwDkXnH4daKFXBou2NCXmYvtLScr1nlYC00WVHtrO9Hf0SALOnWvJ+4wTwh6ijkUSsHoRNoM/UB1LgCtJVmeVXzj2SHUsUeGo8HcG1NuIvVH5A9WxxJaOLR1b+tcekBwJ/gltj4wzzG1GSCqkzmq7YOIR6lgCHLd03NKnc0tz+1ziG8jghWz/qrfj8bxr+RjEaTZFtkPZC6YeFzXnW409M4VgImrHZntY+zkk/5boXW43UxBr99Bsd7I0qxRM81ClqYNJlZ5ZbfpV4Ylb2ZQADbi7JDMnCPDM7HusHRX2yPLMNT4BcNWLPYY9tOEAAAAASUVORK5CYII="/><label id="ManzanaModal"></label></label>
                                          </span>
                                        </div>
                                        <div class="form-group col-md-6">
                                          <span class="span-data-card">
                                            <label class="form-control data-card" id=""><img src="data:image/png;base64,iVBORw0KGgoAAAANSUhEUgAAADwAAAA8CAYAAAA6/NlyAAAAAXNSR0IArs4c6QAAA1lJREFUaEPtmo1xFDEMhZVKgEqASoBKgEqASoBKgEpgXjjNeIxkS/aTcyHnmcwmuV3bn/XjZ+3dyRNrd0+MV27A/7vFbxYutPBbEXkuIs9E5NVlnJ8i8l1EvokIfsdPaTthYUB+aiA9IEC/q4auBv4gIu+TJgO0Wjz56Pz2SuAVWJ3xRxHB8/RWBQw3/rE52xcV7l0F/DUQs7P1KInpCmBkYAAz2utLPDP6uu+jAngndnswJLDPNNoiYIY7KyNgAU1rFRb+TZvdXyGC5EVrFcDIzsjSjPYogJkujUyNxEVrFRaGjIRuZjS6AKkABiygGe1RZGmAMuKYHr9V+zD6ZYgPuuioBEbfOwKEHrsaXxUx3MYuoN8ktyl63LYTqgZW98aZWKscXjLDFgTL4lrWTgDr5AFsgR8BPeXSvaWsuC6LV8tNmBaGBWeFuBVg9AupSjk17QJjIhAaWreaScEVYFVuWEz0/2UnzleBseqYSH9ImImFFWBLxGAchELa6lngSMl1JBiywDMBA3CMF65nZ4CjQmKUhLLAEV0OWLh5qMoZBY6egHQf9fbSLDA8CvkhcvoKZfsI8Ox8m1nhLLDuLACHe0O1jQTMtCQ0Ax5ZFqD6liCqjFaB2/51V/CqKkNLj4BHCSPkPsYqMIDRbb8d9kO5iXME7LnyjrhnASugl0jd7dED9rLjqmVHE6zoE+OZVvaArdidqahIHFsLuQuMcS1vNOfrAVvqZseV28Vo+54ps8gi4h5rIc2+M8Cst3lt3DGsq0msf1t5NcCYoE6O+VbBeuPxj0E9C1sxwSyqqQwMycGAX1subYoQD9hK96x4C8w/fYtloBSwJzpYMZcmGjzg7cWpbclL9fj/NUF7esHdQk9LyxOWdUUHPpgdHkZn4OWqwya1V23RbpcPDzO9qp+fAo8U9adqcGbhyMmkBceA+CphutZkWB0nIj0HR77cNoWNuHQ7j2iJB89ojUkXQP/ur+2ZVuHw/MvAm4p2bmHZG7Fw23GkiLcZoqnHS4t41wS+Um25n3/Wwv3yZ4psKdMZN2vtDGGy/MJtF1jnpfGnscf8Fg9KsIBlJMJtC3tW0wyLKxZBF6C/Wsns18WCy1YcuRLLwrvueuz5G/CxpX6ggW4WfqCFPzbsH9OE0j1+f9ahAAAAAElFTkSuQmCC"/><label id="LoteModal"></label></label>
                                          </span>
                                        </div>
                                        <div class="form-group col-md-6">
                                          <span class="span-data-card">
                                            <label class="form-control data-card" id="NumeroModal">
                                              <img src="data:image/png;base64,iVBORw0KGgoAAAANSUhEUgAAADwAAAA8CAYAAAA6/NlyAAAAAXNSR0IArs4c6QAAAYpJREFUaEPtmtFNw0AQRCedkE6gE+iEVAKdQCekE9BK5y/AfhvrdHvOnJSvjH07+8YXReuT7myd7syvbPjoxE3YhA/WgVsj/SDpeWAvrpLi85mtIWs4jL5Jesxu1Ekfpp+aebRF1vBHIbOLwTB9Rm6l1O9wkB0Z4zVPF0mvxHSG8JekiHTFFc9yRHtzZQx/b95tnADH+iiGo9XICxI1cJUJ2/B/T5cJr5w7jvS4Q/nPnVFakciHVjG0rRwED4lM2IRLdAClFYkc6RJAfxWB4CGRCZtwiQ6gtCKRI10CqA8tlFYkcqQd6RIdQGlFIke6BFCf0iitSNR6WXGQtmDuMmqJQVoM1Cqud0kvpLAM4RikBeVqAzU8V4qGZAyHvtpAHEd5oZ81vFwXxuMtgJG0w2z3Vx7IY1Jacyvh0qbWirPhadHBwjOE0UsjcN8eMlRfxrDHpT0w7bgngodE/nu4A0PHSxE8JGpFokOho6GtW6P6Moa3NpziexueAtOOIk14R/OmuNSEp8C0o8gfXIk3PRKw/rUAAAAASUVORK5CYII="/>
                                              <label id="NumeroModal"></label></label>
                                          </span>
                                        </div>
                                      
                                      <div class="form-group col-md-12">
                                        <label class="form-control name-title-second-card-scaner">Transporte</label>
                                      </div>
                                      <div class="form-group col-md-6">
                                          <span class="span-data-card">
                                            <label class="form-control data-card" id=""><img src="data:image/png;base64,iVBORw0KGgoAAAANSUhEUgAAADwAAAA8CAYAAAA6/NlyAAAAAXNSR0IArs4c6QAAApNJREFUaEPtmgFOwzAMRb2bwEmAkwAnAU4CNxk3AU4C+lIjlc527LpOsy2Rpk1am/TZP46d9EBX1g5XxksD+NI9Pjw8PHxhFhiSvjCHnuAMDzs9fE9Ej0SE7xvnvd7LP6cb3oio/Pb2EUo8jhOoe9ANbgDwMxF9e/taK+k9YQvjKug1wO9E9OS1bNL1kPerp28vMObpl2eABtfeeqTtBYY1XxgIzKePZDgERqhrGRwxLsY3NS/wL9OrW1amJ+Mvkgxu9rIHGBZGsJo3REkM1rJhSi29bFaYB5izbkvvFqNyQdMsaw8wJ2ezZTeUAFYIQC+bSdZW4F7kXCBXy9oK3Iucw7K2Avci5wK8WtYW4N7kHJK1Bbg3OYdkXQPmvLthwE3p6kErHzVgKatJecqNOxXzAwm4xyLBaxM2R5CAeyoBvaDletTLkPe/JgFzy9Dagfe874RvAE/uGB6e6RJzA2UhAlv5tJYtqqMfIrqrbCSGJb1c4wCMAIf1ukXjAhHSTOzCcNvEIWBpbcNA2BjI3pfWNhuknCEErCUpLZYxrciXMsIQsFZgt8jKNGApUQoBazkqV5BvPafZRGIaJAUYcwjQy+ONlgWGtKUknYSEPAxjwsoIXoDGp4WUl0rB+JA3xkeELod5nKLCwFvLNLu/ASwtNS2CULZ30b/Zwz0ch0YNwiYqkof3CEZRQC64nRylatnTOctaXLNrm3jnCK0lKNV3PGrSxpq4R+POqMtzqAd8NQ/XgGv3ZxlD26AYwHOr1zw0PGzc9cyScun36iStrR6hOSwdS8LSe7zfUTysAatvAtTmMAbAPEYJNt+zQnlWysRs+XL9l300/Dd/ruo7JxbgPYDSxhzAaabtpOPh4U4ckfYYf+8bkT3RhQEhAAAAAElFTkSuQmCC"/><label id="MarcaModal"></label></label>
                                          </span>
                                        </div>
                                        <div class="form-group col-md-6">
                                          <span class="span-data-card">
                                            <label class="form-control data-card" id=""><img src="data:image/png;base64,iVBORw0KGgoAAAANSUhEUgAAADwAAAA8CAYAAAA6/NlyAAAAAXNSR0IArs4c6QAAAv1JREFUaEPtms2uDkEQhp/DDVgIKwmXYCks2CPWIsEFEHY2/jd2hAtAItaCPQti6RJIrIiFG/CTV75OJnOqp7tmur+Z853uzTn5Mt1VT9Xb1dM9vcUua1u7jJcGvOkZbxluGd6wCDRJb1hCt+G0DDszfBK4COjvYWdf7+PvVx3uAuF/7xiTXjzerUDdRgt0EPBl4Kt3rLGSnhM2MI6CHgP8FLjkjWyl5yXvO56xvcCap188Btbw7BGPtL3AiuZtA0Lz6VllOBVGqatfHGVX9rOaF/ivMapbVlme2Q/FAp6dZQ+wIqxi1W2qkjK2zqYp1c9ytsI8wFZ015ndEFSraGbL2gNsyTk7sgUloBVC0P2WJetc4KXIOUCOlnUu8FLkPFnWucBLkXMAHi3rHOClyXmSrHOAlybnSbJOAVvZLVhwqww1WK2HgGNvNVW8LDxodLmMAS9xk+CNiZnpGPCStoBe0PC8+RYYA7aWobGG5+qnA4JTfeMe4FSBmwss2LWStM3nBrwKV060DgHngH3AZ+Bt5RSfBo4Cv4BXwLeevRyfo6eWqc4XgOfAno7RN8DZStCvgTOdsf+sjodfdH5L+fz/0TGSVma18e/CBruPgOuFoR8C14wxBa3lM2S6GvAV4HEE6gdwsDDwd+BAZMyrwBPHNByV4ZvAvYgDivrewsC/I2qSmVvA/drAKh6ar1b7CJwoDPwBOB4ZU/M6FMtqkpbtfhEJ/nQdKMUdC3C/SFYFFoyKyXlgP/AJeFBxaRL0DeAY8BN4aRTH6sClMlhqnAZsLbuxddg6FdTuY8nN+gSU/S69hM+hU4Pr2i3FTgWnOrHO/q79sByzZL1Oh6fYMrOrAVN73J0IHYXNAU4d5M1VyKwCFRQx+IEvleEUcKr/FFkO9R06gmrA3cilMtQy3NNZKmBN0oUiMLR6TJrDQy8gc9zvCPEaAh79bSkMrnms+5TdiyS6U6FIuq/+FcqwfAkXbLp+Je+czDUHC3H7h2nA/pjtrB4twzsrX35v/wFI5aE9m/5sfgAAAABJRU5ErkJggg=="/><label id="ModeloModal"></label></label>
                                          </span>
                                        </div>
                                        <div class="form-group col-md-6">
                                          <span class="span-data-card">
                                            <label class="form-control data-card" id="">
                                              <img src="data:image/png;base64,iVBORw0KGgoAAAANSUhEUgAAADwAAAA8CAYAAAA6/NlyAAAAAXNSR0IArs4c6QAAAYpJREFUaEPtmtFNw0AQRCedkE6gE+iEVAKdQCekE9BK5y/AfhvrdHvOnJSvjH07+8YXReuT7myd7syvbPjoxE3YhA/WgVsj/SDpeWAvrpLi85mtIWs4jL5Jesxu1Ekfpp+aebRF1vBHIbOLwTB9Rm6l1O9wkB0Z4zVPF0mvxHSG8JekiHTFFc9yRHtzZQx/b95tnADH+iiGo9XICxI1cJUJ2/B/T5cJr5w7jvS4Q/nPnVFakciHVjG0rRwED4lM2IRLdAClFYkc6RJAfxWB4CGRCZtwiQ6gtCKRI10CqA8tlFYkcqQd6RIdQGlFIke6BFCf0iitSNR6WXGQtmDuMmqJQVoM1Cqud0kvpLAM4RikBeVqAzU8V4qGZAyHvtpAHEd5oZ81vFwXxuMtgJG0w2z3Vx7IY1Jacyvh0qbWirPhadHBwjOE0UsjcN8eMlRfxrDHpT0w7bgngodE/nu4A0PHSxE8JGpFokOho6GtW6P6Moa3NpziexueAtOOIk14R/OmuNSEp8C0o8gfXIk3PRKw/rUAAAAASUVORK5CYII="/>
                                              <label id="PlacaModal"></label></label>
                                          </span>
                                        </div>
                                    </form>
                                  </div>
                                  <div class="modal-footer">
                                    <div class="form-group col-md-12 blk-btns">
                                    <center>
                                    <button type="button" class="btn btn-primary btn-sbmt-modal-card">REGISTRAR</button>
                                    </center>
                                    </div>
                                  </div>
                                </div>
                              </div>
                            </div>

                    </div>
                    <!--Fin centro -->

                    <!-- START MODAL VISITANTE-->
                    <div class="modal fade" id="entradaModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel">
                      <div class="modal-dialog" role="document">
                        <div class="modal-content modal-qr-container">
                            <div class="modal-header">
                                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                    <span aria-hidden="true">&times;</span>
                                </button>
                                <h4 class="modal-title" id="exampleModalLabel">GreenTechEIM</h4>
                            </div>
                            <form method="POST" id="RegistroEntrada" name="RegistroEntrada">
                                <div class="modal-body">
                                    <div class="form-group col-md-12">
                                        <label class="form-control name-title-card-scaner">Registro de Entrada</label>
                                    </div>
                                    
                                    <div class="form-group col-md-12">
                                      <label class="form-control name-title-second-card-scaner">Datos Generales</label>
                                    </div>
                                                      
                                    <div class="form-group col-md-12">
                                      <label class="form-control name-card-scaner" id=""><i class="fa fa-user" style="font-size:24px;color:black"></i><label id="NombreVisitanteEntradaModal" name="NombreVisitanteEntradaModal"></label></label>
                                    </div>

                                    <div class="form-group col-md-6">
                                      <span class="span-data-card">
                                        <label class="form-control data-card" id=""><i class="fa fa-key" style="font-size:24px;color:black"></i><label id="ClaveVisitanteEntradaModal" name="ClaveVisitanteEntradaModal"></label></label>
                                      </span>
                                    </div>

                                    <div class="form-group col-md-12">
                                        <span class="span-data-card">
                                        <label class="form-control data-card" id=""><i class="fa fa-clock-o" style="font-size:24px;color:black"></i><label id="FechaEstimadaEntradaModal"></label></label>
                                        </span>
                                    </div>

                                </div>
                                <div class="modal-footer">
                                    <div class="form-group col-md-12 blk-btns">
                                        <center>
                                            <button class="btn btn-primary btn-sbmt" type="submit" id="btnRegistroEntradaV">
                                                <i class="fa fa-save"></i>Registrar Entrada
                                            </button>
                                            
                                            <button class="btn btn-danger btn-cncl" type="button" onclick="CloseEntradaModal()">
                                                <i class="fa fa-arrow-circle-left"></i> Cancelar
                                            </button>
                                        </center>
                                    </div>
                                </div>
                            </form>
                        </div>
                      </div>
                    </div>
                    <!--Fin centro -->

                    <!-- START MODAL VISITANTE-->
                    <div class="modal fade" id="salidaModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel">
                      <div class="modal-dialog" role="document">
                        <div class="modal-content modal-qr-container">
                            <div class="modal-header">
                                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                    <span aria-hidden="true">&times;</span>
                                </button>
                                <h4 class="modal-title" id="exampleModalLabel">GreenTechEIM</h4>
                            </div>
                            <form method="POST" id="RegistroSalida" name="RegistroSalida">
                                <div class="modal-body">
                                    <div class="form-group col-md-12">
                                        <label class="form-control name-title-card-scaner">Registro de Salida</label>
                                    </div>
                                    
                                    <div class="form-group col-md-12">
                                      <label class="form-control name-title-second-card-scaner">Datos Generales</label>
                                    </div>
                                                      
                                    <div class="form-group col-md-12">
                                      <label class="form-control name-card-scaner" id=""><i class="fa fa-user" style="font-size:24px;color:black"></i><label id="NombreVisitanteSalidaModal" name="NombreVisitanteSalidaModal"></label></label>
                                    </div>

                                    <div class="form-group col-md-6">
                                      <span class="span-data-card">
                                        <label class="form-control data-card" id=""><i class="fa fa-key" style="font-size:24px;color:black"></i><label id="ClaveVisitanteSalidaModal" name="ClaveVisitanteSalidaModal"></label></label>
                                      </span>
                                    </div>

                                    <div class="form-group col-md-12">
                                        <span class="span-data-card">
                                        <label class="form-control data-card" id=""><i class="fa fa-clock-o" style="font-size:24px;color:black"></i><label id="FechaEstimadaModal"></label></label>
                                        </span>
                                    </div>

                                </div>
                                <div class="modal-footer">
                                    <div class="form-group col-md-12 blk-btns">
                                        <center>
                                            <button class="btn btn-primary btn-sbmt" type="submit" id="btnRegistroSalidaV">
                                                <i class="fa fa-save"></i>Confirmar Salida
                                            </button>

                                            <button class="btn btn-danger btn-cncl" type="button" onclick="CloseSalidaModal()">
                                                <i class="fa fa-arrow-circle-left"></i> Cancelar
                                            </button>
                                        </center>
                                    </div>
                                </div>
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
<script type="text/javascript" src="https://rawgit.com/schmich/instascan-builds/master/instascan.min.js"></script>
<script src="/Fraccionamiento/public/js/js_qr_scanner/min/script_scanner.js"></script>
<script src="/Fraccionamiento/public/js/js_qr_scanner/min/scanner_min.js"></script>

<script src="../vistas/scripts/Vigilante/scanGeneral.js"></script>