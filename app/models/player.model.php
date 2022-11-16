<?php

class PlayerModel{
    private $db;
    public function __construct(){
        $this->db = new PDO('mysql:host=localhost;' . 'dbname=jugadores;charset=utf8', 'root', '');
    }
    public function getAllPlayers(){
        $query = $this->db->prepare("SELECT a.*,b.* FROM jugador a INNER JOIN equipo b ON a.id_equipo_fk = b.id");
        $query->execute();
        $players = $query->fetchAll(PDO::FETCH_OBJ);
        return $players;
    }
    public function getPlayerById($id){
        $query = $this->db->prepare("SELECT * FROM jugador WHERE id_pk = ?");
        $query->execute([$id]);
        $player = $query->fetch(PDO::FETCH_OBJ);
        return $player;
    }
    public function addPlayer($nombre, $posicion, $equipo, $numero){
        $query = $this->db->prepare("INSERT INTO jugador (nombre, posicion, id_equipo_fk, numero) VALUES (?, ?, ?, ?)");
        $query->execute([$nombre,$posicion,$equipo,$numero]);
    }
    public function deletePlayer($id)
    {
        $query = $this->db->prepare('DELETE FROM jugador WHERE id_pk = ?');
        $query->execute([$id]);
    }
    public function getPlayersOrderAsc(){
        $query = $this->db->prepare("SELECT a.*,b.* FROM jugador a INNER JOIN equipo b ON a.id_equipo_fk = b.id ORDER BY a.nombre ASC;");
        $query->execute();
        $players = $query->fetchAll(PDO::FETCH_OBJ);
        return $players;
    }
    public function getPlayersOrderDesc(){
        $query = $this->db->prepare("SELECT a.*,b.* FROM jugador a INNER JOIN equipo b ON a.id_equipo_fk = b.id ORDER BY a.nombre DESC;");
        $query->execute();
        $players = $query->fetchAll(PDO::FETCH_OBJ);
        return $players;
    }
}
