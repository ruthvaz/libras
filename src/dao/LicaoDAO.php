<?php

require_once '../model/Connection.php';
require_once '../model/Licao.php';

class LicaoDAO {

    public function create(Licao $l) {
        $sql = 'INSERT INTO licao (titulo, posicao, video, artigo, icone) VALUES (?,?,?,?,?)';

        $stmt = Connection::getConn()->prepare($sql);
        $stmt->bindValue(1, $l->getTitulo());
        $stmt->bindValue(2, $l->getPosicao());
        $stmt->bindValue(3, $l->getVideo());
        $stmt->bindValue(4, $l->getArtigo());
        $stmt->bindValue(5, $l->getIcone());

        $stmt->execute();
    }

    public function update(Licao $l) {

        if($l->getIcone() != null):
            $sql = 'UPDATE licao SET titulo = ?, posicao = ?, video = ?, icone = ? WHERE id = ?';
        else:
            $sql = 'UPDATE licao SET titulo = ?, posicao = ?, video = ? WHERE id = ?';
        endif;

        $stmt = Connection::getConn()->prepare($sql);
        $stmt->bindValue(1, $l->getTitulo());
        $stmt->bindValue(2, $l->getPosicao());
        $stmt->bindValue(3, $l->getVideo());
        
        if($l->getIcone() != null):
            $stmt->bindValue(4, $l->getIcone());
            $stmt->bindValue(5, $l->getId());
        else:
            $stmt->bindValue(4, $l->getId());
        endif;
        
        $stmt->execute();
    }

    public function getAll() {
        $sql = 'SELECT * FROM licao ORDER BY posicao';

        $stmt = Connection::getConn()->prepare($sql);
        
        $stmt->execute();

        if($stmt->rowCount() > 0):
            $result = $stmt->fetchAll(\PDO::FETCH_ASSOC);
            return $result;
        else:
            return [];
        endif;
    }

    public function getById($id) {
        $sql = 'SELECT * FROM licao WHERE id = ?';

        $stmt = Connection::getConn()->prepare($sql);
        $stmt->bindValue(1, $id);
        $stmt->execute();

        if($stmt->rowCount() > 0):
            $result = $stmt->fetchAll(\PDO::FETCH_ASSOC);
            return $result;
        else:
            return [];
        endif;
    }

    public function deleteById($id) {
        $sql = 'DELETE FROM licao WHERE id = ?';

        $stmt = Connection::getConn()->prepare($sql);
        $stmt->bindValue(1, $id);
        $stmt->execute();
    }
    
}