<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Tutoreame tutor</title>
  <link rel="stylesheet" href="assets/login.css"> <!-- Asegúrate de tener un archivo CSS para los estilos -->
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta3/css/all.min.css">

</head>
<body>

    <div class="container" id="container">
        
        <div class="form-container sign-in">
            <form method="POST" action="{{ route('login') }}">

                @csrf
                <h1 style=" margin-bottom: 35px ;">Iniciar sesiòn </h1>
                <div class="social-icons" style=" margin-bottom: 35px ;">
                    <a href="#" class="icon"><i class="fa-brands fa-google-plus-g"></i></a>
                    <a href="#" class="icon"><i class="fa-brands fa-facebook-f"></i></a>
                    <a href="#" class="icon"><i class="fa-brands fa-github"></i></a>
                    <a href="#" class="icon"><i class="fa-brands fa-linkedin-in"></i></a>
                    <a href="#" class="icon"><i class="fa-brands fa-instagram"></i></a>
                </div>
                <span>Usa tu contraseña de correo electrónico.</span>
                <input type="email" name="correoelectronico" placeholder="Correo electronico">
                <input type="password" name="contraseña" placeholder="Contraseña">
                <a href="#">Olvidaste tu contraseña?</a>
                <button type="submit">Iniciar sesión</button>
            </form>
        </div>
        <div class="toggle-container">
            <div class="toggle">
                
                <div class="toggle-panel toggle-right">
                    <h1>Hola, Bienvenido a <br> Tutoreame tutor!</h1>
                    <img  src="images/logoi.png" alt="" style="width: 200px; height:200px; margin-top:20px; ">
                </div>
            </div>
        </div>
    </div>


</body>
</html>