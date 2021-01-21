<?php


namespace src\Model;

use PDO;
use PDOException;

class DBConnect
{
    protected string $dsn;
    protected string $user;
    protected string $password;

    public function __construct()
    {
        $this->dsn = 'mysql:host=localhost;dbname=test_module_2;charset=utf8';
        $this->user = 'root';
        $this->password = 'Minh3032001@';
    }

    public function connect(): ?PDO
    {
        try {
            return new PDO($this->dsn, $this->user, $this->password);
        } catch (PDOException $e){
            echo $e->getMessage();
        }
        return null;
    }

    public function query($statement): array
    {
        $stmt = $this->connect()->query($statement);
        return $stmt->fetchAll();
    }

    public function execute($statement)
    {
        $stmt = $this->connect()->prepare($statement);
        $stmt->execute();
    }
}