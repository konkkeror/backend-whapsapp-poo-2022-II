<?php 

  error_reporting(-1);
  ini_set( 'display_errors', 1 );

  header('Content-Type: application/json');
  include_once '../../class/class-usuario.php';

  $_POST = json_decode(file_get_contents('php://input'), true);

  if ($_SERVER['REQUEST_METHOD']=='GET' && !isset($_GET['id']) && !isset($_GET['accion'])) {
    Usuario::obtenerUsuarios();
  }

  // ajax/usuarios/?id=1&accion=contactos
  if ($_SERVER['REQUEST_METHOD']=='GET' && isset($_GET['id']) && isset($_GET['accion']) && $_GET['accion']=='contactos') {
    Usuario::obtenerContactos($_GET['id']);
  }

  //Agregar contacto
  // ajax/usuarios/?id=1&accion=agregarContacto&idContacto=2
  if ($_SERVER['REQUEST_METHOD']=='POST' && isset($_POST['id']) && isset($_GET['accion']) && $_GET['accion']=='agregarContacto') {
    Usuario::agregarContacto($_POST['id'], $_POST['idContacto']);
  }


?>