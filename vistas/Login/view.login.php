<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>EIM - Inicio de Sesión</title>
    <link rel="icon" href="../public/img/img_login/LOGO_TESIS_BL2.png" type="image/x-icon">
    <link rel="stylesheet" href="../public/css/css_login/style_login.css">
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
    <link rel="stylesheet" href="../public/css/css_alerts/style_alerts.css">
</head>
<body>
    <div id="particles-js"></div>
    <div class="main">
        <input type="checkbox" id="chk" aria-hidden="true">

        <!-- Sign Up -->
        <div class="client">
                <label style="text-align: center;">GreenTech</label>
                <label style="align-items: center; margin: 0px auto;">
                    <img src="../public/img/img_login/LOGO_TESIS_BL2.png" alt="" width="300" height="160" style="background: no-repeat; background-size:cover; position: relative; border-color: transparent; border-radius: 0%; filter: drop-shadow(1px 1px 4px snow); object-fit:cover;">
                </label>
        </div>

        <!-- Login -->
        <div class="administrator">
            <div class="container-form">
                <form method="POST" id="Login" name="Login">
                    <label for="chk" aria-hidden="true">Login</label>
                    <div id="alert-container"></div>
                    <input type="text" name="username" placeholder="Nombre de Usuario" required id="username" autocomplete="off">
                    <input type="password" name="pswd" placeholder="Contraseña" id="pswd" autocomplete="off">
                    <span class="icon-eye" id="eye-icon">
                        <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" style="fill: rgba(0, 0, 0, 1);"><path d="M12 5c-7.633 0-9.927 6.617-9.948 6.684L1.946 12l.105.316C2.073 12.383 4.367 19 12 19s9.927-6.617 9.948-6.684l.106-.316-.105-.316C21.927 11.617 19.633 5 12 5zm0 11c-2.206 0-4-1.794-4-4s1.794-4 4-4 4 1.794 4 4-1.794 4-4 4z"></path><path d="M12 10c-1.084 0-2 .916-2 2s.916 2 2 2 2-.916 2-2-.916-2-2-2z"></path></svg>
                    </span>

                    <button class="submit-btn" type="submit" id="btnLogin" onclick="init()" ><i class="fa fa-save"></i> Iniciar Sesión</button>

                    <button class="submit-btn" id="btn-cancel" onclick="cancelarform()" type="button"><i class="fa fa-arrow-circle-left"></i> Cancelar</button>
                </form>
                <button id="forgot-pw" class="forgot_pswd" onclick="forgot_pswd_method()">¿Olvidaste tu Contraseña?</button>
                <div id="loadingSpinner" class="loading-spinner">
                    <div class="spinner"></div>
                </div>
            </div>
        </div>

    </div>
<!-- JS Particles -->
<script src="../public/js/js_login/particles.js-master/particles.min.js"></script>
<script src="../public/js/js_login/app.js"></script>
<script src="../public/js/jquery-3.1.1.min.js"></script>
<script src="../vistas/scripts/Login/login.js"></script>
<script>
    $(document).on("click", "#eye-icon", function() {
            var pswd_box = $("#pswd");
            if (pswd_box.attr("type") === "password") {
                pswd_box.attr("type", "text");
                $(this).css("opacity", 0.8);
            } else {
                pswd_box.attr("type", "password");
                $(this).css("opacity", 0.2);
            }
        });
</script>
</body>
</html>