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

$prof_id = $_GET['IDprof'];
$sql_profID='select * from Profesor where prof_id='.$prof_id.';';
$sql_estu = 'select E.nombre,est_id,titulo,descripcion,years from Investiga join Estudiantes as E join Investigacion join Aconseja join Profesor as P where i_id = investig_id and inv_id=investig_id and e_id = est_id and investig_id=i_id and profesor_id=prof_id and profesor_id='.$prof_id.';';

$profID_res= mysql_query($sql_profID);
$estu_res = mysql_query($sql_estu);

$row_prof = mysql_fetch_row($profID_res);

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
		
		<form  class="navbar-form navbar-right" role="form">
					<button rel="drevil" type="button" class="btn btn-danger" data-container="body" data-toggle="popover" data-placement="left">
					Borrar Profesor
					</button>
					
	    </form>
		<?php if (mysql_num_rows($estu_res) != 0) echo ('
        <div class="navbar-collapse collapse">
           <form class="navbar-form navbar-right" role="form">
				
					<button type="button" class="btn btn-success" data-toggle="modal" data-target="#Modalprof">Actualizar</button> 

        </form>
		
        </div><!--/.navbar-collapse -->');
		?>
      </div>
    </div>
<?php if ($profID_res == null){
	echo('<div class="jumbotron">
		<div class="container">
			<h1>El profesor o la profesora que buscas no esta en la base de datos. </h1>
		</div>
	</div>');
	exit;
} 
?>
    <!-- Main jumbotron for a primary marketing message or call to action -->
    <div class="jumbotron">
		<div class="container">
			<h1> <?php echo $row_prof[2];?></h1>
			<p>Correo electr&oacute;nico: <?php echo $row_prof[1];?></p>
		</div>
	</div>
	
	<?php if (mysql_num_rows($estu_res) == 0)
		echo '<div class="container"><h1>El profesor o la profesora no aconseja una investigaci&oacute;n.</h1></div>';
		else {
	echo ('<div class="container">
	<h1>Proyectos que aconseja '.$row_prof[2].'.</h1>
	<table class="table">
      <thead>
        <tr>
          <th>Nombre</th>
          <th>Titulo</th>
          <th>Descripcion</th>
          <th>A&ntilde;os</th>
        </tr>
      </thead>
      <tbody>');
		while($row_est = mysql_fetch_row($estu_res)){
			echo '<tr>';
			  echo '<td><a href="http://ada.uprrp.edu/~dramirez2/ccom4027/project/DesplegarEst.php?NumStu='.$row_est[1].'">'.$row_est[0].'</a></td>';
			  echo '<td>'.$row_est[2].'</td>';
			  echo '<td>'.$row_est[3].'</td>';
			  echo '<td>'.$row_est[4].'</td>';
			echo '</tr>';
		}
		echo ('</tbody>
		</table>
		</div>');
	}
		?>
		
		
	<!-- modal Profesores-->
	<form action="actualizarProf.php" method="POST">
      <div class="modal fade" id="Modalprof" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
        <div class="modal-dialog">
          <div class="modal-content">
            <div class="modal-header">
              <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
              <h3 class="modal-title" id="myModalLabel">Actualizar Profesor</h3>
            </div>
            <div class="modal-body">
               
                  <!-- Nombre box -->
                  <div class="row" id="input-pass" >
                    <input type="text" class="form-control" placeholder="Nombre del profesor" name="ProfNom">
                  </div>

                  <!-- Correo box -->
                  <div class="row" id="input-pass"> 
                    <input type="text" class="form-control" placeholder="Correo electr&oacute;nico" name="ProfEma">
                  </div>
				<input type="hidden" value="<?php echo $prof_id ?>" name="idProfe">
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
	<script> 
	$('#example').tooltip(options)
	</script>
	<script type="text/javascript">
 $(document).ready(function() {
  $("[rel=drevil]").popover({
      placement : 'bottom', //placement of the popover. also can use top, bottom, left or right
      title : '<div style="text-align:center; text-decoration:underline;">&iexcl;CUIDADO!</div>', //this is the top title bar of the popover. add some basic css
      html: 'true', //needed to show html of course
      content : '<form action="actualizarProf.php" method="POST"><div id="popOverBox"><p>El profesor se ve a borrar de la base de datos:</p><input type="hidden" value="<?php echo $prof_id?>" name="ProfeID"><button type="submit" value="DELETE" name="deleteProf" class="btn btn-danger" >Borrar </button></div></form>' //this is the content of the html box. add the image here or anything you want really.
});
});
</script>

</body>
</html>
