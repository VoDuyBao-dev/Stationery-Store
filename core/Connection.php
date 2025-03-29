<?php

class Connection
{
    private static $instance = null;
    private $conn;

    private function __construct($config)
    {
        //        Kết nối database
        $this->conn = new mysqli($config['db_host'], $config['user'], $config['pass'], $config['db_name']);

        // if ($this->conn->connect_error) {
        //     Logger::logError("Connection failed: " . $this->conn->connect_error);
        //     throw new \Exception("Connection failed: ");
        // } else {
        //     echo "Connection successfully";
        // }
    }

    public static function getInstance($config)
    {
        if (self::$instance == null) {
            self::$instance = new Connection($config);
        }
        return self::$instance;
    }

    public function getConnection()
    {
        return $this->conn;
    }

    public function close()
    {
        $this->conn->close();
        echo " Kết nối đã đóng từ Connection!<br>";
    }
}
