<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">
  <title>Home</title>
  <link rel="stylesheet" href="assets/welcome.css"> <!-- Asegúrate de tener un archivo CSS para los estilos -->
</head>
<body>
    <main>
      <nav class="main-menu">
        <div>
            <img  src="images/logoi.png" alt="" style="width: 100px; height:100px; margin-left: 50px;">
            <h1>TUTOREAME <br> TUTOR</h1>
            
        </div>
        <img class="logo" src="" alt="" />
        <ul>
          <li class="nav-item active">
            <b></b>
            <b></b>
            <a href="#">
              <i class="fa fa-house nav-icon"></i>
              <span class="nav-text">Inicio</span>
            </a>
          </li>

          <li class="nav-item">
            <b></b>
            <b></b>
            <a href="tutores">
              <i class="fa fa-user nav-icon"></i>
              <span class="nav-text">Tutores</span>
            </a>
          </li>

          <li class="nav-item">
            <b></b>
            <b></b>
            <a href="alumnosus">
              <i class="fa fa-calendar-check nav-icon"></i>
              <span class="nav-text">Tutorado</span>
            </a>
          </li>

          <li class="nav-item">
            <b></b>
            <b></b>
            <a href="alumnos">
              <i class="fa fa-calendar-check nav-icon"></i>
              <span class="nav-text">Alumnos</span>
            </a>
          </li>
          <li class="nav-item">
            <b></b>
            <b></b>
            <a href="roles">
              <i class="fa fa-calendar-check nav-icon"></i>
              <span class="nav-text">Roles</span>
            </a>
          </li>
          <li class="nav-item">
            <b></b>
            <b></b>
            <a href="Usuarios">
              <i class="fa fa-calendar-check nav-icon"></i>
              <span class="nav-text">Usuarios</span>
            </a>
          </li>
          <li class="nav-item">
            <b></b>
            <b></b>
            <a href="#">
              <i class="fa fa-person-running nav-icon"></i>
              <span class="nav-text">Reportes</span>
            </a>
          </li>

          <li class="nav-item">
            <b></b>
            <b></b>
            <a href="#">
              <i class="fa fa-sliders nav-icon"></i>
              <span class="nav-text">Ajustes</span>
            </a>
          </li>
        </ul>
      </nav>

      <section class="content">
        <div class="left-content">
          <div class="activities">
            <h1>Actividades principales</h1>
            <div class="activity-container">
              <div class="image-container img-one">
                <img src="images/reportes.jpg" alt="tennis" />
                <div class="overlay">
                  <h3>Reportes</h3>
                </div>
              </div>

              <div class="image-container img-two">
                <img src="images/seguimiento.jpg" alt="hiking" />
                <div class="overlay">
                  <h3>Seguimiento</h3>
                </div>
              </div>

              <div class="image-container img-three">
                <img src="images/tutorado.jpg" alt="running" />
                <div class="overlay">
                  <h3>Tutorados</h3>
                </div>
              </div>

             

              <div class="image-container img-six">
                <img src="images/tutor.jpg" alt="swimming" />
                <div class="overlay">
                  <h3>Tutores</h3>
                </div>
              </div>
            </div>
          </div>

          <div class="left-bottom">
            <div class="weekly-schedule">
              <h1>TUTORES</h1>
              <div class="calendar">
                <table class="table table-secondary  table-striped">
                    <thead>
                      <tr>
                        <th scope="col">#</th>
                        <th scope="col">First</th>
                        <th scope="col">Last</th>
                        <th scope="col">Handle</th>
                      </tr>
                    </thead>
                    <tbody>
                      <tr>
                        <th scope="row">1</th>
                        <td>Mark</td>
                        <td>Otto</td>
                        <td>@mdo</td>
                      </tr>
                      <tr>
                        <th scope="row">2</th>
                        <td>Jacob</td>
                        <td>Thornton</td>
                        <td>@fat</td>
                      </tr>
                      <tr>
                        <th scope="row">3</th>
                        <td colspan="2">Larry the Bird</td>
                        <td>@twitter</td>
                      </tr>
                    </tbody>
                  </table>

              
                
              </div>
            </div>

            
          </div>
        </div>

        <div class="right-content">
          <div class="user-info">
            <div class="icon-container">
              <i class="fa fa-bell nav-icon"></i>
              <i class="fa fa-message nav-icon"></i>
            </div>
            
                <h4 data-bs-toggle="modal" data-bs-target="#profileModal">Cholula</h4>
                <img src="https://github.com/ecemgo/mini-samples-great-tricks/assets/13468728/40b7cce2-c289-4954-9be0-938479832a9c" alt="user" />
           
          </div>

          <div class="active-calories">
            <h1 style="align-self: flex-start">Tutores disponibles</h1>
            <div class="active-calories-container">
              <div class="box" style="--i: 85%">
                <div class="circle">
                  <h2>85<small>%</small></h2>
                </div>
              </div>
              <div class="calories-content">
                <p><span>Dispononibles:</span> 14000</p>
              </div>
            </div>
          </div>

        

          <div class="friends-activity">
            <h1>Importancia de los tutotores en los alumnos</h1>
            <div class="card-container">
              <div class="card">
               
                <img class="card-img" src="https://github.com/ecemgo/mini-samples-great-tricks/assets/13468728/bef54506-ea45-4e42-a1b6-23a48f61c5e8" alt="" />
                <p>Los tutores universitarios son esenciales porque brindan ayuda individualizada y refuerzan el aprendizaje en el aula, lo que mejora el rendimiento académico y la retención estudiantil.</p>
              </div>

              <div class="card card-two">
                
                <img class="card-img" src="https://github.com/ecemgo/mini-samples-great-tricks/assets/13468728/2dcc1b94-06c5-4c62-b886-53b9e433fd44" alt="" />
                <p>La presencia de tutores en la universidad es fundamental, ya que ofrecen una guía especializada que ayuda a los estudiantes a desarrollar habilidades específicas, aumentar su confianza y enfrentar desafíos académicos con éxito.💪</p>
              </div>
            </div>
          </div>
        </div>
      </section>
    </main>
  
      

    <script src="assets/welcome.js"></script>
  </body>
  </html>