<?php

class Connection {
    
    private static $instance;

    public static function getConn() {
        
        if(!isset(self::$instance)):
            self::$instance = new \PDO(
                'mysql:host=localhost;dbname=libras', 
                'root', 
                ''
            );
        endif;
            
        return self::$instance;

    }

}
