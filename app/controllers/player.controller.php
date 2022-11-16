<?php
require_once './app/models/player.model.php';
require_once './app/views/api.view.php';

class PlayerApiController {
    private $model;
    private $view;
    private $data;

    public function __construct(){
        $this->model = new PlayerModel();
        $this->view = new ApiView();
        $this->data = file_get_contents("php://input");
    }
    function getData(){
        return json_decode($this->data);
    }
    public function getPlayers(){
        if(isset($_GET['order'])&&$_GET['order']=="asc"){
            $players = $this->model->getPlayersOrderAsc();
        }else if(isset($_GET['order'])&&$_GET['order']=="desc"){
            $players = $this->model->getPlayersOrderDesc();
        }else{
            $players = $this->model->getAllPlayers();
        }
        $this->view->response($players);
    }
    public function getPlayerById($params=null){
        $id = $params[':ID'];
        $player = $this->model->getPlayerById($id);
        if($player){ //si existe jugador con esa id, lo devuelve sino, devuelve error.
            $this->view->response($player);
        } else{
            $this->view->response("El jugador con el id = $id no existe", 404);
        }
    }
    public function deletePlayer($params=null){
        $id = $params[':ID'];
        $player =$this->model->getPlayerById($id);
        if($player){ //Si el jugador con la id dada existe, lo elimina, sino da error.
            $this->model->deletePlayer($id);
            $this->view->response("El jugador con el id = $id fue eliminado correctamente", 200);
        }else{
            $this->view->response("El jugador con el id = $id no existe", 404);
        }
    }
    public function insertPlayer($params = null) {
        $player = $this->getData();
        if (isset($player->nombre)&&isset($player->posicion)&&isset($player->numero)&&isset($player->equipo)){
                $this->model->addPlayer($player->nombre,$player->posicion,$player->equipo,$player->numero);
                $this->view->response("Jugador agregado correctamente",201); //Agrega al jugador. 201 status de creado.
        }else{
            $this->view->response("Rellene los datos",400);
        }
    }
}