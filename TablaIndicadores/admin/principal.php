<?php

session_start();

if (empty($_SESSION['active']) ){
    header('location: index.php');
} 
?>

<head>
    <title> Tablero Indicadores </title>
    <!-- Required meta tags -->
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">

    <!-- Bootstrap CSS v 4.5.3-->
    <link href="css/bootstrap.min.css" rel="stylesheet" type="text/css">
    <link href="css/jquery.datetimepicker.min.css" rel="stylesheet" type="text/css">
    <!-- Ionic icons Botones Slide bar-->
    <link href="https://unpkg.com/ionicons@4.5.10-0/dist/css/ionicons.min.css" rel="stylesheet">

    <!-- Styles -->
    <link rel="stylesheet" href="css/style.css">
    <!-- DataTables  -->
    <link rel="stylesheet" type="text/css" href="https://cdn.datatables.net/1.10.22/css/jquery.dataTables.min.css" />

</head>

<body>
   <div class="d-flex" id="content-wrapper">

        <!-- Sidebar -->
        <div id="sidebar-container" class="bg-primary">
            <div class="logo">
                <h4 class="text-light font-weight-bold mb-0">Indicadores</h4>
            </div>
            <div class="menu">
                <a href="#" class="d-block text-light p-2 border-0"><i class="icon ion-md-apps lead mr-2"></i>
                    Tablero</a>

                <a href="#" class="d-block text-light p-2 border-0"><i class="icon ion-md-people lead mr-2"></i>
                    Usuarios</a>

                <a href="#" class="d-block text-light p-2 border-0"><i class="icon ion-md-stats lead mr-2"></i>
                    Estadísticas</a>
                <a href="#" class="d-block text-light p-2 border-0"><i class="icon ion-md-person lead mr-2"></i>
                    Perfil</a>
                <a href="#" class="d-block text-light p-2 border-0"> <i class="icon ion-md-settings lead mr-2"></i>
                    Configuración</a>
            </div>
        </div>
        <!-- Fin sidebar -->

        <div class="w-100">

         <!-- Navbar -->
         <nav class="navbar navbar-expand-lg navbar-light bg-light border-bottom">
            <div class="container">
    
              <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarSupportedContent"
                aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
                <span class="navbar-toggler-icon"></span>
              </button>
    
              <div class="collapse navbar-collapse" id="navbarSupportedContent">

                <ul class="navbar-nav ml-auto mt-1 mt-lg-0">
                  <li class="nav-item dropdown">
                    <a class="nav-link text-dark dropdown-toggle" href="#" id="navbarDropdown" role="button"
                      data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                      <img src="img/user-1.png" class="img-fluid rounded-circle avatar mr-2"/>
                         <?php echo $_SESSION['nombre']; ?>
                    </a>
                    <div class="dropdown-menu dropdown-menu-right" aria-labelledby="navbarDropdown">
                      <a class="dropdown-item" href="#">Mi perfil</a>
                      <a class="dropdown-item" href="#">Suscripciones</a>
                      <div class="dropdown-divider"></div>
                      <a class="dropdown-item" href="logout.php">Cerrar sesión</a>
                    </div>
                  </li>
                </ul>

              </div>
            </div>
          </nav>
          <!-- Fin Navbar -->

        <!-- Page Content -->
        <div id="content" class="bg-grey w-100">
              <section>
                  <div class="container">
                      <div class="row">
                          <div class="col-lg-8 my-2">
                              <div class="card rounded-0 my-0">
                                  <div class="card-header bg-light">
                                    <h6 class="font-weight-bold mb-0">Ventas Netas por Sucursal</h6> 
                                    <form class="form-inline my-0">
                                       <input type="text" class="form-control mb-2 mr-sm-2" id="PickerFecIni">
                                       <input type="text" class="form-control mb-2 mr-sm-2" id="PickerFecFin">
                                       <div class="card rounded-0">
                                       <select class="selectpicker" id="tipo"  class="btn btn-primary mb-2">
                                           <option>Sucursal</option>
                                           <option>Division</option>
                                       </select>
                                       </div>
                                       <button type="buttom" class="btn btn-primary mb-3" Id="BtnUpdate">Actualizar</button>
                                   </form>
                                  </div>
								  
                                        <div id="cardCollpase1" class="collapse pt-3 show">
                                            <div class="bg-soft-light border-light border">
                                                <div class="row text-center">
                                                    <div class="col-md-4">
                                                    </div>
                                                    <div class="col-md-4">
                                                        <p class="text-muted mb-0 mt-3">Ventas Totales</p>
                                                        <h2 class="font-weight-normal mb-3" id="vt">
                                                            <small class="mdi mdi-checkbox-blank-circle text-info align-middle mr-1"></small>
                                                            <span id="num">$0.</span>
                                                            <span id="dec"><sup class="font-13">00</sup></span>
                                                        </h2>
                                                    </div>
                                                    <div class="col-md-4">
                                                        <p class="text-muted mb-0 mt-3">Unidades Totales</p>
                                                        <h2 class="font-weight-normal mb-3" id="ut">
                                                            <small class="mdi mdi-checkbox-blank-circle text-danger align-middle mr-1"></small>
                                                            <span>0</span>
                                                        </h2>
                                                    </div>
                                                </div>
                                            </div>
                                  <div class="card-body py-0">
                                     <div id="chartReport">
                                        <canvas id="chartCanvas"></canvas>
                                     </div>
                                  </div>

                                        </div> <!-- collapsed end -->

                                  
                              </div> <!-- card-rounded-0 -->
                          </div> <!-- class -->

                          <div class="col-lg-4 my-2">
                            <div class="card rounded-0 card text-center">
                                <div class="card-header bg-light">
                                    <h6 class="font-weight-bold mb-0">Detalle </h6>
                                </div>
                                <div class="align-self-center" >
                                        <table id="vtasnetas" class="hover" style="width:80%" >
                                            <thead>
                                               <tr>
                                                 <th>Sucursal</th>
                                                 <th>Ventas</th>
                                                 <th>Unidades</th>
                                               </tr>
                                            </thead>
                                          </table>
                                       </div>
                            </div>
                          </div>

                      </div> <!--row-->
                  </div>
              </section>

          </div>
        </div> <!--content -->

</div> <!-- content-wrapper -->


<!-- JQuery v 2.1.4-->    
<script type="text/javascript" src="js/jquery-2.1.4.js" ></script>
<!-- Chart.Js      -->
<script type="text/javascript" src="https://cdnjs.cloudflare.com/ajax/libs/Chart.js/2.7.3/Chart.min.js"></script>
<!-- bootstrap v 4.5.3-->
<script src="js/jquery.datetimepicker.full.min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.11.0/umd/popper.min.js" integrity="sha384-b/U6ypiBEHpOf/4+1nzFpr53nxSS+GLCkfwBdFNTxtclqqenISfwAzpKaMNFNmj4" crossorigin="anonymous"></script>
<script src="js/bootstrap.min.js"></script>
<!-- datatables -->
<script type="text/javascript" src="https://cdn.datatables.net/v/bs4/dt-1.10.23/datatables.min.js"></script>

<!-- app-js        -->
<script type="text/javascript" src="js/app.js"  ></script>
<!-- Configuracion datetimepicker -->
<script >
var date = new Date();
  var primerDia = new Date(date.getFullYear(), date.getMonth(), 1)
  $('#PickerFecIni').datetimepicker({
      timepicker : false,
      datepicker:true,
      format: 'd-m-Y' ,
      value: primerDia,
      autoclose: true,
      maxDate: "+1D",
      weeks:true,
      icons: {
           time: "far fa-clock",
           date: "far fa-calendar",
           up: "fas fa-arrow-up",
           down: "fas fa-arrow-down"
      }
    })

    //$('#PickerFecIni').datepicker().on('changeDate', function (ev) {
    //  $('PickerFecIni').Close();
    //});
    //.on('change', function (selected) {
//      var minDate = new Date(selected.date.valueOf());
      //$('#PickerFecFin').datepicker('minDate', minDate);
    //});
    
    $('#PickerFecFin').datetimepicker({
      timepicker : false,
      datepicker:true,
      format: 'd-m-Y' ,
      value: Date(),
      weeks:true,
      maxDate: "+1D"
    })
</script>

</body>
