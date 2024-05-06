<link href="//netdna.bootstrapcdn.com/bootstrap/3.2.0/css/bootstrap.min.css" rel="stylesheet" id="bootstrap-css">
<script src="//netdna.bootstrapcdn.com/bootstrap/3.2.0/js/bootstrap.min.js"></script>
<script src="//code.jquery.com/jquery-1.11.1.min.js"></script>
<!------ Include the above in your HEAD tag ---------->

<!DOCTYPE html>
<html>
<head>
	<title>Login Page</title>
   <!--Made with love by Mutiullah Samim -->
   

	<!--Custom styles-->
	<link rel="stylesheet" type="text/css" href="assets/estiloh.css">
    <style>
        .navbar {
            background-color: rgba(13, 13, 13, 0.514);
            border: rgba(13, 13, 13, 0.514);
        }
        
    </style>
    
    
</head>
<body>
    <img  id="fondo" style=" " src="{{ asset('images/d.jpg') }}" alt="">
    <nav class="navbar navbar-default navbar-fixed-top">
         
        <div class="container">
        
            <!-- Brand and toggle get grouped for better mobile display -->
            <div class="navbar-header page-scroll">
                <button type="button" class="navbar-toggle" data-toggle="collapse" data-target="#bs-example-navbar-collapse-1">
                    <span class="sr-only">Toggle navigation</span>
                    <span class="icon-bar"></span>
                    <span class="icon-bar"></span>
                    <span class="icon-bar"></span>
                </button>
                <img id="img3" src="{{ asset('images/alien.png') }}" alt="">
                <a class="navbar-brand" style="color: #70efbf; margin-top:20px; font-size:30px;" href="#page-top">AstroPeques</a>
            </div>
            <!-- Collect the nav links, forms, and other content for toggling -->
          
                
                <ul class="nav navbar-nav navbar-right">
                    <li class="hidden">
                        <a href="#page-top"></a>
                    </li>
                    <li class="page-scroll">
                        <a href="Vista1"  style="color: #70efbf;; margin-top:20px; font-size:25px;">Iniciar sesión</a>
                    </li>
                    <li class="page-scroll">
                        <a href="vista" style="color: rgb(247, 242, 242); margin-top:20px; font-size:20px; ">Sobre nosotros</a>
                    </li>
                    <li class="page-scroll">
                        <a href="#contact" style="color: rgb(243, 234, 234); margin-top:20px; font-size:20px;">Contacto</a>
                    </li>
                </ul>
           
            <!-- /.navbar-collapse -->
        </div>
        <!-- /.container-fluid -->
    </nav>
    <header  id="page-top" >
        <div class="container">
            <div class="row">
              
              
                <div class="col-lg-12">
                    <div class="intro-text" style="color:rgb(249, 246, 246); margin-left: 600px; margin-top:-30px;">
                        <span class="name">
                            <span style="color: #70efbf;">Astropeque:</span> Aventurate y ayuda a Rocket a resolver todos su acertijos
                        </span>
                        <hr class="star-light">
                        <button class="btn btn-success" style="font-size: 25px; background-color:#70efbf; color: #4e4d4c">Empezar</button>
                    </div>
                </div>
                
            </div>
        </div>
    </header>
   
    
    <script src="assets/login.js"></script>
</body>
</html>