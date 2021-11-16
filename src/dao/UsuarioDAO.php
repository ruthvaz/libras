<?php

require_once '../model/Connection.php';
require_once '../model/Usuario.php';

class UsuarioDAO {

    public function create(Usuario $u) {
        $sql = 'INSERT INTO usuario (nome, email, senha, foto, tipo) VALUES (?,?,?,?,?)';

        $stmt = Connection::getConn()->prepare($sql);
        $stmt->bindValue(1, $u->getNome());
        $stmt->bindValue(2, $u->getEmail());
        $stmt->bindValue(3, $u->getSenha());
        $stmt->bindValue(4, $u->getFoto());
        $stmt->bindValue(5, $u->getTipo());

        $stmt->execute();

    }

    public function getByID(Usuario $u) {
        $sql = 'SELECT * usuario WHERE id = ?';

        $stmt = Connection::getConn()->prepare($sql);
        $stmt->bindValue(1, $u->getId());

        $stmt->execute();

        if($stmt->rowCount() > 0):
            $result = $stmt->fetchAll(\PDO::FETCH_ASSOC);
            return $result;
        else:
            return [];
        endif;
    

    }


    public function read() {

        $sql = 'SELECT * FROM usuario';

        $stmt = Connection::getConn()->prepare($sql);
        $stmt->execute();

        if($stmt->rowCount() > 0):
            $result = $stmt->fetchAll(\PDO::FETCH_ASSOC);
            return $result;
        else:
            return [];
        endif;
    
    }

    public function update($p) {

        $sql = 'UPDATE products SET name = ?, description = ? WHERE id = ?';

        $stmt = Connection::getConn()->prepare($sql);
        $stmt->bindValue(1, $p->getName());
        $stmt->bindValue(2, $p->getDesc());
        $stmt->bindValue(3, $p->getId());

        $stmt->execute();
    
    }

}