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
//header("location: http://ada.uprrp.edu/~dramirez2/ccom4027/project/investiga.php"); //ALERT!!! something typed is wrong; try again

}else{ // No rows were returned therefore there were no matches

header("location: http://ada.uprrp.edu/~dramirez2/ccom4027/project/login.html"); //jump to PORTADA: investiga.php
}
}

$numEst =$_GET['NumStu']; 
$sql_id='select * from Estudiantes where est_id ="'.$numEst.'";';
$sql_cursos = 'select nota, C.titulo, codigo, semestre, C.descripcion from Toma_Curso natural join Curso_CCOM as C where num_est = "'.$numEst.'" and codigo=codigo_curso;';
$sql_inve=   'select titulo,productos,P.nombre,descripcion,prof_id,years from Investiga natural join Investigacion natural join Aconseja natural join Profesor as P where profesor_id =prof_id and i_id = investig_id and inv_id=i_id and e_id="'.$numEst.'";';

$id_res= mysql_query($sql_id); //no devuelve el valor, es un pointer
$cursos_res = mysql_query($sql_cursos);

$inve_res =  mysql_query($sql_inve);

$row_id = mysql_fetch_row($id_res); 


?>
<!DOCTYPE html>
<html lang="en">
  <head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="description" content="">
    <meta name="author" content="">
    <link rel="shortcut icon" href="../../assets/ico/favicon.ico">

    <title>Informaci&oacute;n del Estudiante </title>

    <!-- Bootstrap core CSS -->
    <link href="assets/css/bootstrap.min.css" rel="stylesheet">

    <!-- Custom styles for this template -->
    <link href="jumbotron.css" rel="stylesheet">

    <!-- Just for debugging purposes. Don't actually copy this line! -->
    <!--[if lt IE 9]><script src="../../assets/js/ie8-responsive-file-warning.js"></script><![endif]-->

    <!-- HTML5 shim and Respond.js IE8 support of HTML5 elements and media queries -->
    <!--[if lt IE 9]>
      <script src="https://oss.maxcdn.com/libs/html5shiv/3.7.0/html5shiv.js"></script>
      <script src="https://oss.maxcdn.com/libs/respond.js/1.4.2/respond.min.js"></script>
    <![endif]-->
  </head>

  <body>

    <div class="navbar navbar-inverse navbar-fixed-top" role="navigation">
      <div class="container">
        <div class="navbar-header">
          <button type="button" class="navbar-toggle" data-toggle="collapse" data-target=".navbar-collapse">
            <span class="sr-only">Toggle navigation</span>
            <span class="icon-bar"></span>
            <span class="icon-bar"></span>
            <span class="icon-bar"></span>
          </button>
          <a class="navbar-brand" href="http://ada.uprrp.edu/~dramirez2/ccom4027/project/investiga.php">Inicio</a>
        </div>
		<?php
		if ($row_id[1] != null) echo ('
        <div class="navbar-collapse collapse">
           <form class="navbar-form navbar-right" role="form">
				
					<button type="button" class="btn btn-success" data-toggle="modal" data-target="#ModalEst">Actualizar</button> 
					<button type="button" class="btn btn-success" data-toggle="modal" data-target="#Modalcurso">Cursos</button>
					<button type="button" class="btn btn-success" data-toggle="modal" data-target="#Modalinve">Investigaci&oacute;n</button>
				
        </form>
        </div><!--/.navbar-collapse -->');
		?>
      </div>
    </div>

    <!-- Main jumbotron for a primary marketing message or call to action -->
    <div class="jumbotron">
      <div class="container">
       <?php 
		if ($row_id[1] == null) echo "<h1> El estudiante que buscas no est&aacute; en la base de datos.</h1></div></div>";
		else{ echo '<h1>'.$row_id[1];
		echo (
		'</h1>
        <table class="table">
      <thead>
        <tr>
          <th>Correo Electr&oacute;nico</th>
		  <th>N&uacute;mero de Estudiante</th>
          <th>Telefono</th>
          <th>A&ntilde;o</th>
          <th>Classificado en CCOM</th>
        </tr>
      </thead>
      <tbody>
        <tr>
          <td>'.$row_id[2].'</td>
          <td >');
		  //Despliega numero de estudiante con guiones
		  for ($i=0; $i < strlen($row_id[0]); $i++){
			if ($i== 2 or $i== 4) echo $row_id[0][$i].'-';
			else echo $row_id[0][$i];
		  }
		  
		  echo ('</td>
          <td>');
		  for ($i=0; $i < strlen($row_id[3]); $i++){
			if ($i== 2 or $i== 5) echo $row_id[3][$i].'-';
			else echo $row_id[3][$i];
		  }
		  echo ('</td> <td>');
			switch ($row_id[4]){
				case 1: echo "Primer A&ntilde;o";
						break;
				case 2: echo "Segundo A&ntilde;o";
						break;
				case 3: echo "Tercer A&ntilde;o";
						break;
				case 4: echo "Cuarto A&ntilde;o";
						break;
				default: echo $row_id[4];
			}
		  echo ('</td>
		  <td>');
			if ($row_id[5] == 1) echo "S&iacute";
			else echo "No";
		   echo ('</td>
        </tr>
      </tbody>
    </table>
        
      </div>
    </div>
	


    <div class="container">
      <!-- Example row of columns -->
      '); if (mysql_num_rows($cursos_res) == 0)
			echo '<h1>El estudiante no est&aacute; tomando cursos de CCOM.</h1>';
		else{
       echo ('<div class="container">
          <h2>Cursos CCOM</h2>
			<table class="table table-condensed">
			<thead>
			 <th>Nota</th>
			  <th>Titulo</th>
			  <th>Codigo</th>
			  <th>Semestre</th>
			  <th>Descripci&oacute;n</th>
		 
			</thead>
			<tbody>');
		while ($row_cursos = mysql_fetch_row($cursos_res)){
			echo ('<tr>
			<td>'.$row_cursos[0].'</td>
			  <td>'.$row_cursos[1].'</td>
			  <td>'.$row_cursos[2].'</td>
			  <td>'.$row_cursos[3].'</td>
			  <td>'.$row_cursos[4].'</td>
			  
			</tr>');
		}
	
	
	echo ('</tbody>
	  </table>
          
        </div>');
	}
	
	if (mysql_num_rows($inve_res) == 0)
		echo '<h1>El estudiante no est&aacute; haciendo investigaci&oacute;n</h1>';
	else{
       echo (' <div class="container">
         <h2>Investigaciones</h2>
		 <table class="table table-bordered" >
      <thead>
		 <th>Titulo</th>
		 <th>Descripcion</th> 
         <th>Producto</th>
		<th>Profesor</th>
		<th>A&ntilde;o(s)</th>
      </thead>
	  <tbody>');
	  
		 while($row_prof = mysql_fetch_row($inve_res)){
		 echo '<tr>';
			echo '<td>'.$row_prof[0].'</td>';
			echo '<td>'.$row_prof[3].'</td>';
			echo '<td>'.$row_prof[1].'</td>';
			echo '<td><a href="http://ada.uprrp.edu/~dramirez2/ccom4027/project/DesplegarProfe.php?IDprof='.$row_prof[4].'">'.$row_prof[2].'</a></td>';
			echo '<td>'.$row_prof[5].'</td>';
			echo '</tr>';
		 }
       echo ('
	   </tbody>
	   </table>
	   </div>');
        
      }
	}
      ?>

      <footer>
        <p></p>
      </footer>
    </div> <!-- /container -->
	
	

<!-- modal Estudiantes-->

      <div class="modal fade" id="ModalEst" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
        <div class="modal-dialog">
          <div class="modal-content">
            <div class="modal-header">
              <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
              <h3 class="modal-title" id="myModalLabel">Actualizar Estudiante</h3>
            </div>
            <div class="modal-body">
			 <form class="form-signin" action="actualizarEst.php" method="POST">
               
                  <!-- Nombre box -->
                  <div class="row" id="input-pass" >
                    <input type="text" class="form-control" placeholder="Nombre del estudiante" name="EstName">
                  </div>

                  <!-- Numest box -->
                  <div class="row" id="input-pass" >
                    <input type="text" class="form-control" placeholder="N&uacute;mero de Estudiante" name="EstNum">
                  </div>


                  <!-- Correo box -->
                  <div class="row" id="input-pass"> 
                    <input type="text" class="form-control" placeholder="Correo electr&oacute;nico" name="EstE">
                  </div>


                  <!-- Telefono box -->
                  <div class="row" id="input-pass"> 
                    <input type="text" class="form-control" placeholder="Tel&eacute;fono" name="EstT">
                  </div>

                  <!-- Año box -->
                  <div class="row" id="input-pass"> 
                    <input type="text" class="form-control" placeholder="A&ntilde;o" name="EstA">
                  </div>
				  <!-- Clasificicado CCOM box -->
                  <div class="row" id="input-pass"> 
                    <input type="text" class="form-control" placeholder="Clasificado CCOM" name="EstCC">
                  </div>
				  <input type="hidden" value="<?php echo $numEst?>" name="ONum">
                  
                  <!-- Fecha de Admision box -->
                  <!--<div class="row" id="input-pass"> 
                    <input type="text" class="form-control" placeholder="Curso Actual">
                  </div>

                  <!-- Fecha de Graduaci?n box -->
                  <!--<div class="row" id="input-pass"> 
                    <input type="text" class="form-control" placeholder="Identificaci?n del Maestro">
                  </div>-->
              <!-- </form> -->
				</div>
				
				<div class="modal-footer">
				  <button type="button" class="btn btn-danger" data-dismiss="modal">Cancelar</button>
				  <button type="submit" class="btn btn-primary">Aceptar</button>
				</div>
			</form>
          </div>
        </div>
      </div>
	  
	<!-- Modal Cursos -->
	<div class="modal fade" id="Modalcurso" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
        <div class="modal-dialog">
		<form class="form-signin" action="cursoCCOM.php" method="POST">
			<div class="modal-content">
				<div class="modal-header">
				  <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
				  <h3 class="modal-title" id="myModalCurso">A&ntilde;adir Curso</h3>
				</div>
				<div class="modal-body">
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
                            <input type="text" class="form-control" placeholder="Codigo del Curso" name="CCodi">
                         </div>

                         <!-- Titulo box -->
                         <div class="row" id="input-pass" >
                            <input type="text" class="form-control"  placeholder="Titulo del Curso" name="Ctitu">
                         </div>

                          <!-- Descripcion box -->
                         <div class="row" id="input-pass"> 
                           <input type="textarea" rows='3' class="form-control" placeholder="Descripcion del Curso" name="Cdesc">
                         </div>
						 <!-- Semestre box -->
                         <div class="row" id="input-pass"> 
                           <input type="text" class="form-control" placeholder="Semestre del Curso" name="Csem">
                         </div>
						 <!-- Nota box -->
                         <div class="row" id="input-pass"> 
                           <input type="text" class="form-control" placeholder="Nota en el Curso" name="Cnota">
                         </div>
						 <!-- num est box -->
                         <div class="row" id="input-pass"> 
                           <input type="hidden" class="form-control" value="<?php echo $numEst?>" name="EstNum">
                         </div>
                        </div>
						
                      </div>
                    </div>
					<div class="modal-footer">
					<button type="button" class="btn btn-danger" data-dismiss="modal">Cancelar</button>
					<button type="submit" class="btn btn-primary">Aceptar</button>

				</div>
				
				</div>
				<div class="modal-body">
				<div>
				<h3 class="modal-title">Borrar Curso </h3>
				<!-- Codigo box -->
                    <div class="row" id="input-pass" >
                        <input type="text" class="form-control" placeholder="Codigo del Curso" name="CCodi1">
                    </div>
			 <!-- Semestre box -->
                    <div class="row" id="input-pass"> 
                        <input type="text" class="form-control" placeholder="Semestre del Curso" name="Csem1">
                    </div>
				</div>
				<div class="modal-footer">
					<button type="submit" class="btn btn-primary" value="Delete" name="eraser2">Delete </button>
				</div>
				</div>
				</div>

			</div>
			</form>
		</div> 
	</div>
	
	<!-- Proyectos de investigacion-->
	<div class="modal fade" id="Modalinve" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
        <div class="modal-dialog">
		<form class="form-signin" action="investigaCCOM.php" method="POST">
			<div class="modal-content">
				<div class="modal-header">
				  <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
				  <h3 class="modal-title" id="myModalCurso">Actualizar Proyecto de Investigaci&oacute;n</h3>
				</div>
				<div class="modal-body">
				 
				 
				 <div>
                    <div> <p></p><p></p><p></p><p></p></div>
                    <div class="panel panel-default">
                      <div class="panel-heading">
                        <h3 class="panel-title">Proyectos de Investigaci&oacute;n:</h3>
                      </div>
                      <div class="panel-body">                  
                         <!--<form class="form-signin"> -->
                          <!-- Titulo Inv box -->
                         <div class="row" id="input-pass" >
                            <input type="text" class="form-control" placeholder="Titulo de la Investigaci&oacute;n" name="InvTi">
                         </div>

                         <!-- ID Inv box 
                         <div class="row" id="input-pass" >
                            <input type="text" class="form-control"  placeholder="ID de la Investigaci&oacute;n" name="InvID">
                         </div> -->

                          <!-- Descripcion Inv box -->
                         <div class="row" id="input-pass"> 
                           <input type="text" class="form-control" placeholder="Descripcion de la Investigaci&oacute;n" name="InvDes">
                         </div>
                        
                          <!-- Producto box -->
                         <div class="row" id="input-pass"> 
                           <input type="text" class="form-control" placeholder="Producto de la Investigaci&oacute;n" name="InvProd"> 
                         </div>

                         <!-- Profesor Inv box -->
                         <div class="row" id="input-pass"> 
                           <input type="text" class="form-control" placeholder="Correo electr&oacute;nico del aconsejador" name="profEm">
                         </div>
						 <!-- Año box  -->
                         <div class="row" id="input-pass" >
                            <input type="text" class="form-control"  placeholder="A&ntilde;os en la Investigaci&oacute;n" name="InvYear">
                         </div>
						 <input type="hidden" value="<?php echo $numEst;?>" name="NumEstu">
                         <!-- Compañeros Inv box 
                         <div class="row" id="input-pass"> 
                           <input type="text" class="form-control" placeholder="Compa&ntilde;eros de la Investigaci&oacute;n" name="">
                         </div> -->

                        </div>
                      </div>
                    </div>
				<div class="modal-footer">
					<button type="button" class="btn btn-danger" data-dismiss="modal">Cancelar</button>
					<button type="submit" class="btn btn-primary">Ingresar</button>
					<button type="submit" class="btn btn-primary" value="Delete" name="eraser">Delete </button>
				</div>
				
			</form>
		</div> 
	</div>
                  
   <!-- Bootstrap core JavaScript
    ================================================== -->
    <!-- Placed at the end of the document so the pages load faster -->
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/1.11.0/jquery.min.js"></script>
    <script src="assets/js/bootstrap.min.js"></script>
    <script src="assets/js/docs.min.js"></script>
  </body>
</html>
