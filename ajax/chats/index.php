<?php 

  error_reporting(-1);
  ini_set( 'display_errors', 1 );

  header('Content-Type: application/json');
  include_once '../../class/class-chat.php';

  $_POST = json_decode(file_get_contents('php://input'), true);

  // Obtener listado chats
  // ajax/chats/?id=1 
  if (
    $_SERVER['REQUEST_METHOD'] == 'GET' && 
    isset($_GET['id']) && 
    isset($_GET['accion']) &&
    $_GET['accion'] == 'listarConversaciones'
  ) {
    Chat::obtenerConversaciones($_GET['id']);
  }

  if (
    $_SERVER['REQUEST_METHOD'] == 'GET' && 
    isset($_GET['idChat']) && 
    isset($_GET['accion']) &&
    $_GET['accion'] == 'detalleChat'
  ) {
    Chat::obtenerDetalleConversacion($_GET['idChat']);
  }

  if (
    $_SERVER['REQUEST_METHOD'] == 'POST'
  ) {
    $chat = new Chat(
      $_POST['emisor'], 
      $_POST['receptor'], 
      $_POST['mensaje'], 
      $_POST['tipo'], 
      $_POST['hora']);
    $chat->guardarMensaje();
  }

?>