<?php
error_reporting(E_ALL);
ini_set('display_errors', 1);

$grado[0]="Muy Fácil de detectar";
$grado[1]="Fácil de detectar";
$grado[2]="General";
$grado[3]="Difícil de detectar";
$grado[4]="Muy Difícil de detectar";

require_once 'easyar-cloud.php';

if (isset($_POST["imgurl"]))
{
	$imgurl=htmlspecialchars($_POST["imgurl"]);
    $easyar = new EasyARCloudAPISample;

    $targetDir = 'upload';
    $imageLocation 	= "https://carrotapp.live".DIRECTORY_SEPARATOR."carrot-upload".DIRECTORY_SEPARATOR.$targetDir.DIRECTORY_SEPARATOR.$imgurl;


    $resultado=$easyar->gradeDetection(getImage($imageLocation));
        if($resultado['resultCode']==0)
        {
		    $alerta='<div class="alert alert-success" role="alert">Grado: '.$resultado['result']['grade'].'</div>';
        }
        else
        {
            $alerta='<div class="alert alert-danger" role="alert">Error en guardar. No subió al CRS.</div>';
        }
}
else
{
	$alerta='<div class="alert alert-danger" role="alert">Error en guardar. No cargó la imagen.</div>';
}
 ?>
 <!doctype html>
 <html lang="es">
 	<head>
 		<meta http-equiv="Content-Type" content="text/html; charset=utf-8">
 		<title>Subir Target 2</title>
 		<meta name="viewport" content="width=device-width,initial-scale=1.0">
     <script
 			  src="https://code.jquery.com/jquery-2.2.4.min.js"
 			  integrity="sha256-BbhdlvQf/xTY9gja0Dq3HiwQF8LaCRTXxZKRutelT44="
 			  crossorigin="anonymous"></script>
     <script type="text/javascript" src="js/plupload.full.min.js"></script>
     <!-- Latest compiled and minified CSS -->
 <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.6/css/bootstrap.min.css" integrity="sha384-1q8mTJOASx8j1Au+a5WDVnPi2lkFfwwEAa8hDDdjZlpLegxhjVME1fgjWPGmkzs7" crossorigin="anonymous">

 <!-- Optional theme -->
 <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.6/css/bootstrap-theme.min.css" integrity="sha384-fLW2N01lMqjakBkx3l/M9EahuwpSfeNvV63J5ezn3uZzapT0u7EYsXMjQV+0En5r" crossorigin="anonymous">

 <!-- Latest compiled and minified JavaScript -->
 <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.6/js/bootstrap.min.js" integrity="sha384-0mSbJDEHialfmuBBQP6A4Qrprq5OVfW37PRR3j5ELqxss1yVqOtnepnHVP9aJ7xS" crossorigin="anonymous"></script>
   </head>
 	<body>
     <div class="container">
			 <?php echo $alerta; ?>
         <a id="pickfiles" href="probargrado.php" class="btn btn-lg btn-primary btn-block">
             <span class="glyphicon glyphicon-file" aria-hidden="true"></span>
             Nuevo</a>
         <p>
             <?php echo $imageLocation;?></p>
         <p><?php echo $resultado['result']['grade']." - ".$grado[$resultado['result']['grade']];?>
         </p>
             <img src="<?php echo $imageLocation;?>" width="100%">


		 </body>
		 </html>
<?php
function getImage($imageLocation){

    $file = file_get_contents( $imageLocation );

    if( $file ){

        return $file;
    }
    else
    {
        return 0;
    }

}
?>