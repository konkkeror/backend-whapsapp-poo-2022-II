<?php 

  class Sticker {
    private $id;
    private $sticker;

    public function __construct($id, $sticker) {
      $this->id = $id;
      $this->sticker = $sticker;
    }

    public static function obtenerStickers() {
      $stickers = file_get_contents('../../data/stickers.json');
      echo $stickers;
    }
  }

?>