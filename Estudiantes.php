<?php 
$host = "localhost";
$usuario = "dramirez2";
$password = "turntablepower2";
$database = "estu_investigacion";

$conexion = mysql_connect($host, $usuario, $password);
mysql_select_DB($database);

$name=$_POST['Nombre'];

$sql_nombres='select * from Estudiantes where nombre like "'.$name.'%";';
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
    <link rel="shortcut icon" href="../../assets/ico/favicon.ico">

    <title>Starter Template for Bootstrap</title>

    <!-- Bootstrap core CSS -->
    <link href="assets/css/bootstrap.min.css" rel="stylesheet">

    <!-- Custom styles for this template -->
    <link href="starter-template.css" rel="stylesheet">

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
        
      </div>
    </div>

    <div class="container" style='position:relative;bottom:-100px;'>

      <div class="starter-template">
        <h1>Lista de nombres <?php echo $name; ?></h1>
        
      </div>

    </div><!-- /.container -->
   
      
<div class='container' style='position:relative;bottom:-100px;'>
			<div class="bs-example">
				<table class="table table-bordered">
				  <thead>
					<tr>
					  
					  <th>ID</th>
					  <th>Nombre</th>
					  <th>Email</th>
					  <th>Telefono</th>
					  <th>A&ntilde;o</th>
					  <th>Clasificado CCOM</th>
					</tr>
				  </thead>
				  <tbody>
	<?php 
		while($row = mysql_fetch_row($nombre_res)){
			echo  "<tr>";
					echo "<td>".$row[0]."</td>";
					echo "<td>".$row[1]."</td>";
					echo "<td>".$row[2]."</td>";
					echo "<td>".$row[3]."</td>";
					echo "<td>".$row[4]."</td>";
					if ($row[5] == 1){
						echo "<td>S&iacute;</td>";
					}
					else  echo "<td>No</td>";
			echo "</tr>";
	
		}
	?>
			  </tbody>
				</table>
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
