<?php

class Connection {
    
    private static $instance;

    public static function getConn() {
        
        if(!isset(self::$instance)):
            self::$instance = new \PDO(
                'mysql:host=mysql;dbname=libras', 
                'root', 
                '32130'
            );
        endif;
            
        return self::$instance;

    }

}
