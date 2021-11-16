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

    public function getByEmail(Usuario $u) {
        $sql = 'SELECT * FROM usuario WHERE email = ?';

        $stmt = Connection::getConn()->prepare($sql);
        $stmt->bindValue(1, $u->getEmail());

        $stmt->execute();

        if($stmt->rowCount() > 0):
            $result = $stmt->fetchAll(\PDO::FETCH_ASSOC);
            return $result;
        else:
            return [];
        endif;
    
    }

    public function login(Usuario $u) {
        $sql = 'SELECT senha FROM usuario WHERE email = ?';

        $stmt = Connection::getConn()->prepare($sql);
        $stmt->bindValue(1, $u->getEmail());
        
        $stmt->execute();

        if($stmt->rowCount() > 0 && $stmt->rowCount() == 1):
            $result = $stmt->fetch(\PDO::FETCH_ASSOC);
        else:
            return [];
        endif;
        
        if(password_verify($u->getSenha(), $result['senha'])):
            return $this->getByEmail($u);
        endif;

        return [];

    }

}