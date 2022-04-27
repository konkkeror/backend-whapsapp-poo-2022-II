<?php 

  error_reporting(-1);
  ini_set( 'display_errors', 1 );

  header('Content-Type: application/json');
  include_once '../../class/class-sticker.php';

  if ($_SERVER['REQUEST_METHOD']=='GET' && !isset($_GET['accion'])) {
    Sticker::obtenerStickers();
  }

?>