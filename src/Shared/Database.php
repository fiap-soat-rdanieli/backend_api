<?php

namespace App\Shared;

use App\Shared\DataBaseFactory;
use Doctrine\DBAL\ParameterType;
use Sohris\Core\Logger;

class DataBase
{
    /**
     * @var \Doctrine\DBAL\Connection
     */
    private static $conn;

    private static $factory;

    private static $log;

    public $timezone = "UTC";

    public function __construct()
    {
        self::$factory = new DataBaseFactory();

        self::$log = new Logger("Mysql");
    }

    public function __destruct()
    {
        if (!is_null(self::$conn)) {
            self::$conn->close();
        }
    }

    public function recreateDAO()
    {
        try {
            if (is_null(self::$conn) || !self::$conn->isConnected()) {
                $tmp = self::$factory;
                self::$conn = $tmp();
            }
            self::$conn->connect();


            if (!empty($this->timezone)) {
                self::$conn->executeQuery("SET time_zone = '" . $this->timezone . "'");
            }
        } catch (\PDOException $e) {
        } catch (\Exception $e) {
        }
    }

    public function query(string $query, array $param = [])
    {

        $this->recreateDAO();

        try {
            self::$log->debug('Exec Query : ' . $query, $param);
            $conn = self::$conn;
            $stmt = $conn->prepare($query);

            foreach ($param as $key => $value) {
                if ($value == "NULL" || trim($value) == "") {
                    $stmt->bindValue(":" . $key, "NULL", ParameterType::NULL);
                } else if (
                    $value == "False" ||
                    $value == "false" ||
                    $value == "True" ||
                    $value == "true"
                ) {

                    $stmt->bindValue(":" . $key, $value, ParameterType::BOOLEAN);
                } else {
                    $stmt->bindValue(":" . $key, $value);
                }
            }
            $result = $stmt->executeQuery();
            return array("status" => "ok", "data" => $result->fetchAllAssociative());
        } catch (\PDOException $e) {
            var_dump($e->getMessage());
            //$this->rollBack();
            self::$log->warning("RDBMS : " . $e->getMessage());
            return array(
                "status" => "error",
                "msg" => $e->getMessage(),
            );
        }
    }

    public function getConnection()
    {
        self::recreateDAO();
        return self::$conn;
    }

    public function build()
    {
        self::recreateDAO();
        return self::$conn->createQueryBuilder();
    }
}
