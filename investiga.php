<?php 
$host = "localhost";
$usuario = "dramirez2";
$password = "turntablepower2";
$database = "estu_investigacion";

$conexion = mysql_connect($host, $usuario, $password);
mysql_select_DB($database);
session_start();
if(strlen($_SESSION['pass']) > 20 or strlen($_SESSION['user']) > 20)
{
header("location: http://ada.uprrp.edu/~dramirez2/ccom4027/project/login.html");
}
else
{
$query_users = mysql_query('select username from Passwords where pass = "'.$_SESSION['pass'].'"');
$query_pass = mysql_query('select pass from Passwords where username = "'.$_SESSION['user'].'"'); // using client input as variable for a query: asking to be hacked.

if (/*mysql_num_rows($query_pass) > 0 or*/ mysql_num_rows($query_users) > 0) // More than 1 row returned which means there is data
{
header("location: http://ada.uprrp.edu/~dramirez2/ccom4027/project/investiga.php"); //ALERT!!! something typed is wrong; try again

}else{ // No rows were returned therefore there were no matches

header("location: http://ada.uprrp.edu/~dramirez2/ccom4027/project/login.html"); //jump to PORTADA: investiga.php
}
}

$sql_nombres="select * from Estudiantes";
$nombre_res= mysql_query($sql_nombres); //no devuelve el valor, es un pointer
?>
<!DOCTYPE html>

<html lang="en">
  <head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="description" content="">
    <meta name="author" content="">
    <link rel="shortcut icon" href="assets/ico/favicon.ico">
    <link rel="stylesheet" type="text/css" href="assets/css/bootstrap.min.css">
    <title>CCOM Students</title>

    <!-- Bootstrap core CSS -->
    <link href="assets/css/bootstrap.min.css" rel="stylesheet">
    <!-- Bootstrap theme -->
    <link href="assets/css/bootstrap-theme.min.css" rel="stylesheet">

    <!-- Custom styles for this template -->
    <link href="theme.css" rel="stylesheet">

    <!-- Just for debugging purposes. Don't actually copy this line! -->
    <!--[if lt IE 9]><script src="../../assets/js/ie8-responsive-file-warning.js"></script><![endif]-->

    <!-- HTML5 shim and Respond.js IE8 support of HTML5 elements and media queries -->
    <!--[if lt IE 9]>
      <script src="https://oss.maxcdn.com/libs/html5shiv/3.7.0/html5shiv.js"></script>
      <script src="https://oss.maxcdn.com/libs/respond.js/1.4.2/respond.min.js"></script>
    <![endif]-->
  </head>
<style>
  .jumbotron{margin:20px;}
  
  h1{text-align:center}
</style>
  <body role="document">

    
    <div class="container theme-showcase" role="main">

		  <!-- Jumbotron con titulo -->
		  <div class="jumbotron">
			<h1>Estudiantes de Ciencia de C&oacute;mputos</h1>
			<p>Aqu&iacute; se maneja la informaci&oacute;n de los estudiantes que estan en ciencia de c&oacute;mputos y tambi&eacute;n puedes ver los proyectos de 
			investigaci&oacute;n.</p>
			
		  </div>
	  </div>
	  
   <!-- The true menu  --> 
   <div class='container'>
		<div class="row">
		<form action="ID.php" method="POST">
			<div class="col-lg-4">
				<div class="input-group">
					<input type="text" class="form-control"  placeholder="Numero de estudiante" name="NumStu">
					<div class="input-group-btn" value="submit">
						<button type="submit" value="submit"  class="btn btn-primary"> Buscar </button>
					</div><!-- /btn-group -->
				</div><!-- /input-group -->
			</div><!-- /.col-lg-6 -->
		</form>
			<form action="Estudiantes.php" method="POST">
			<div class="col-lg-4">
			    
				<div class="input-group">
					<input type="text" class="form-control" placeholder="Nombre del Estudiante" name="NombreStu">
					<div class="input-group-btn" value="submit">
						<button type="submit" value="submit"  class="btn btn-primary"> Buscar </button>
					</div><!-- /btn-group -->
				</div><!-- /input-group -->
				
			</div><!-- /.col-lg-6 -->
			</form>
			<form action="Profe.php" method="POST">
			<div class="col-lg-4">
				<div class="input-group">
					<input type="text" class="form-control" placeholder="Nombre del Profesor" name="NombreProf">
					<div class="input-group-btn" value="submit">
						<button type="submit" value="submit"  class="btn btn-primary"> Buscar </button>
			
					</div><!-- /btn-group -->
				</div><!-- /input-group -->
				
			</div><!-- /.col-lg-6 -->
				
			</div><!-- /.col-lg-6 -->
			</form>
		</div><!-- /.row -->
	</div>
	
	<div class="container" style='position:relative;bottom:-10px;'>
		<div class="row">
			<div class="col-md-4"></div> <!-- Useless -->
			<div class="col-md-4">
				<div class="btn-group btn-group-justified">
					 <a class="btn btn-info" role="button" data-toggle="modal" data-target="#ModalEst">Ingresar Estudiante</a>
					 
					 <a class="btn btn-info" role="button" data-toggle="modal" data-target="#ModalProf">Ingresar Profesor</a>
				</div>

			</div> <!-- where it ends -->
			<div class="col-md-4"></div> <!-- Also Useless -->
		</div>
	</div>

	<!-- modal Estudiantes-->

      <div class="modal fade" id="ModalEst" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
        <div class="modal-dialog">
		<form action="processmodal.php" method="POST">
          <div class="modal-content">
		  
            <div class="modal-header">
              <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
              <h3 class="modal-title" id="myModalLabel">A&ntilde;adir Estudiante</h3>
            </div> 
			
		
            <div class="modal-body">
               
                  <!-- Nombre box -->
                  <div class="row" id="input-pass" >
                    <input type="text" class="form-control" placeholder="Nombre del estudiante" name="ModNStu">
                  </div>

                  <!-- Numest box -->
                  <div class="row" id="input-pass" >
                    <input type="text" class="form-control" placeholder="N&uacute;mero de Estudiante" name="ModIDStu">
                  </div>


                  <!-- Correo box -->
                  <div class="row" id="input-pass"> 
                    <input type="text" class="form-control" placeholder="Correo electr&oacute;nico" name="ModEStu">
                  </div>


                  <!-- Telefono box -->
                  <div class="row" id="input-pass"> 
                    <input type="text" class="form-control" placeholder="Tel&eacute;fono" name="ModTStu">
                  </div>

                  <!-- Año box -->
                  <div class="row" id="input-pass"> 
                    <input type="text" class="form-control" placeholder="A&ntilde;o" name="ModAStu">
                  </div>
				  
				   <!-- Classificado box -->
                  <div class="row" id="input-pass"> 
                    <input type="text" class="form-control" placeholder="Classificado CCOM" name="ModCCStu">
                  </div>
				 
				  <!-- Cursos CCOM -->
				 <div>
                    <div> <p></p><p></p><p></p><p></p></div>
                    <div class="panel panel-default">
                      <div class="panel-heading">
                        <h3 class="panel-title">Cursos de CCOM:</h3>
                      </div>
                      <div class="panel-body">                  
                         
                          <!-- Codigo box -->
                         <div class="row" id="input-pass" >
                            <input type="text" class="form-control" placeholder="Codigo del Curso">
                         </div>

                         <!-- Titulo box -->
                         <div class="row" id="input-pass" >
                            <input type="text" class="form-control" placeholder="Titulo del Curso">
                         </div>

                          <!-- Descripcion box -->
                         <div class="row" id="input-pass"> 
                           <input type="textarea" rows='3' class="form-control" placeholder="Descripcion del Curso">
                         </div>
						 
                        </div>
                      </div>
                    </div>
                  <!-- Proyectos de investigacion-->
                  <div>
                    <div> <p></p><p></p><p></p><p></p></div>
                    <div class="panel panel-default">
                      <div class="panel-heading">
                        <h3 class="panel-title">Proyectos de Investigaci&oacute;n:</h3>
                      </div>
                      <div class="panel-body">                  
                         
                          <!-- Titulo Inv box -->
                         <div class="row" id="input-pass" >
                            <input type="text" class="form-control" placeholder="Titulo de la Investigaci&oacute;n">
                         </div>

                         <!-- Titulo Inv box -->
                         <div class="row" id="input-pass" >
                            <input type="text" class="form-control"     placeholder="ID de la Investigaci&oacute;n">
                         </div>

                          <!-- Descripcion Inv box -->
                         <div class="row" id="input-pass"> 
                           <input type="text" class="form-control" placeholder="Descripcion de la Investigaci&oacute;n">
                         </div>
                        
                          <!-- Producto box -->
                         <div class="row" id="input-pass"> 
                           <input type="text" class="form-control" placeholder="Producto de la Investigaci&oacute;n">
                         </div>

                         <!-- Profesor Inv box -->
                         <div class="row" id="input-pass"> 
                           <input type="text" class="form-control" placeholder="Profesores de la Investigaci&oacute;n">
                         </div>
                         
                         <!-- Compañeros Inv box -->
                         <div class="row" id="input-pass"> 
                           <input type="text" class="form-control" placeholder="Compa&ntilde;eros de la Investigaci&oacute;n">
                         </div>
						
                        </div>
                      </div>
                    </div>
                  <!-- Fecha de Admision box -->
                  <!--<div class="row" id="input-pass"> 
                    <input type="text" class="form-control" placeholder="Curso Actual">
                  </div>

                  <!-- Fecha de Graduaci?n box -->
                  <!--<div class="row" id="input-pass"> 
                    <input type="text" class="form-control" placeholder="Identificaci?n del Maestro">
                  </div>-->
              
            </div>
		
            <div class="modal-footer">
              <button type="button" class="btn btn-danger" data-dismiss="modal">Cancelar</button>
              <button type="submit" class="btn btn-primary">Aceptar</button>
            </div>
			
          </div>
		  </form>
        </div>
      </div>
    <!-- modal Profesores-->
	<form action="processmodal.php" method="POST">
      <div class="modal fade" id="ModalProf" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
        <div class="modal-dialog">
          <div class="modal-content">
            <div class="modal-header">
              <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
              <h3 class="modal-title" id="myModalLabel">A&ntilde;adir Profesor</h3>
            </div>
            <div class="modal-body">
               
                  <!-- Nombre box -->
                  <div class="row" id="input-pass" >
                    <input type="text" class="form-control" placeholder="Nombre del profesor" name="ModNProf">
                  </div>

                  <!-- Correo box -->
                  <div class="row" id="input-pass"> 
                    <input type="text" class="form-control" placeholder="Correo electr&oacute;nico" name="ModEProf">
                  </div>
				                  <div>
                    <div> <p></p><p></p><p></p><p></p></div>
                    <div class="panel panel-default">
                      <div class="panel-heading">
                        <h3 class="panel-title">Proyectos de Investigaci&oacute;n:</h3>
                      </div>
                      <div class="panel-body">                  
                         <form class="form-signin">
                          <!-- Titulo Inv box -->
                         <div class="row" id="input-pass" >
                            <input type="text" class="form-control" placeholder="Titulo de la Investigaci&oacute;n">
                         </div>

                         <!-- Titulo Inv box -->
                         <div class="row" id="input-pass" >
                            <input type="text" class="form-control"     placeholder="ID de la Investigaci&oacute;n">
                         </div>

                          <!-- Descripcion Inv box -->
                         <div class="row" id="input-pass"> 
                           <input type="text" class="form-control" placeholder="Descripcion de la Investigaci&oacute;n">
                         </div>
                        
                          <!-- Producto box -->
                         <div class="row" id="input-pass"> 
                           <input type="text" class="form-control" placeholder="Producto de la Investigaci&oacute;n">
                         </div>

                         <!-- Estudiantes Inv box -->
                         <div class="row" id="input-pass"> 
                           <input type="text" class="form-control" placeholder="Estudiantes de la Investigaci&oacute;n">
                         </div>
                         
                         
                        </div>
                      </div>
                    </div>
               </form>
            </div>
            <div class="modal-footer">
              <button type="button" class="btn btn-danger" data-dismiss="modal">Cancelar</button>
              <button type="submit" class="btn btn-primary">Aceptar</button>
            </div>
          </div>
        </div>
      </div>
	</form>
     <!-- /container y fin de modal prof-->
	 
	
    <!-- Bootstrap core JavaScript
    ================================================== -->
    <!-- Placed at the end of the document so the pages load faster -->
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/1.11.0/jquery.min.js"></script>
    <script src="assets/js/bootstrap.min.js"></script>
    <script src="assets/js/docs.min.js"></script>
  </body>
</html>



