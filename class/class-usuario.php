<?php 

  class Usuario {
    private $id;
    private $nombre;
    private $imagen;
    private $contactos;
    private $conversaciones;

    public function __construct($id, $nombre, $imagen, $contactos, $conversaciones) {
      $this->id = $id;
      $this->nombre = $nombre;
      $this->imagen = $imagen;
      $this->contactos = $contactos;
      $this->conversaciones = $conversaciones;
    }

    public function getId() {
      return $this->id;
    }

    public function getNombre() {
      return $this->nombre;
    }

    public function getImagen() {
      return $this->imagen;
    }

    public function getContactos() {
      return $this->contactos;
    }

    public function getConversaciones() {
      return $this->conversaciones;
    }

    public function setId($id) {
      $this->id = $id;
    }

    public function setNombre($nombre) {
      $this->nombre = $nombre;
    }

    public function setImagen($imagen) {
      $this->imagen = $imagen;
    }

    public function setContactos($contactos) {
      $this->contactos = $contactos;
    }

    public function setConversaciones($conversaciones) {
      $this->conversaciones = $conversaciones;
    }

    public function __toString() {
      return $this->nombre;
    }

    public static function obtenerUsuarios() {
      $cadenaUsuarios = file_get_contents('../../data/usuarios.json');
      $usuarios = json_decode($cadenaUsuarios, true);
      $arrayUsuarios = [];  
      for($i = 0; $i < count($usuarios); $i++) {
        $arrayUsuarios[] = array(
          'id' => $usuarios[$i]['id'],
          'nombre' => $usuarios[$i]['nombre'],
          'imagen' => $usuarios[$i]['imagen']
        );
      }
      echo json_encode($arrayUsuarios);
    }

    public static function obtenerContactos($idUsuario) {
      $cadenaUsuarios = file_get_contents('../../data/usuarios.json');
      $usuarios = json_decode($cadenaUsuarios, true);
      $idsContactos = [];
      for($i = 0; $i < count($usuarios); $i++) {
        if ($usuarios[$i]['id'] == $idUsuario) {
          $idsContactos = $usuarios[$i]['contactos'];
        }
      }

      $contactos = [];

      for($i = 0; $i < count($idsContactos); $i++) {
        for($j = 0; $j < count($usuarios); $j++) {
          if ($idsContactos[$i] == $usuarios[$j]['id']) {
            $contactos[] = array(
              'id' => $usuarios[$j]['id'],
              'nombre' => $usuarios[$j]['nombre'],
              'imagen' => $usuarios[$j]['imagen']
            );
          }
        }
      }
      echo json_encode($contactos);
    }

    public static function agregarContacto($idUsuario, $idContacto) {
      $cadenaUsuarios = file_get_contents('../../data/usuarios.json');
      $usuarios = json_decode($cadenaUsuarios, true);
      for($i = 0; $i < count($usuarios); $i++) {
        if ($usuarios[$i]['id'] == $idUsuario) {
          $usuarios[$i]['contactos'][] = (int)$idContacto;
          break;
        }
      }
      $archivo = fopen('../../data/usuarios.json', 'w');
      fwrite($archivo, json_encode($usuarios));
      fclose($archivo);
      echo json_encode(array(
        'mensaje' => 'Contacto agregado'
      ));
    }
  }

?>



