<?php
class DBClass
{
    public $connection;

    // get the database connection
    public function getConnection()
    {
        $host = getenv('CONN_URI');
        $username = getenv('ICNT_MYSQL_USER');
        $password = getenv('ICNT_MYSQL_PASSWORD');
        $database = getenv('ICNT_MYSQL_DATABASE');

        try {
            $this->connection = new PDO("mysql:host=" . $host . ";dbname=" . $database, $username, $password);
            $this->connection->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
            $this->connection->exec("set names utf8");
            return $this->connection;
        } catch (PDOException $exception) {
            die("Error: " . $exception->getMessage());
        }
    }
}
