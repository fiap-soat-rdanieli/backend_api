<?php

namespace App\Shared;

use Sohris\Core\Utils;

class DataBaseFactory
{
    private static $configs = [];

    private static $timeout = 30;

    public function __construct()
    {
        self::$configs = Utils::getConfigFiles("database");
    }

    public function __invoke()
    {
        if (empty(self::$configs))
            self::$configs = Utils::getConfigFiles("database");
        try {
            
            if(isset(self::$configs['query_timeout']))
            {
                self::$timeout = self::$configs['query_timeout'];
            }
            $connectionParams = array(
                'dbname' => self::$configs['base'],
                'user' => self::$configs['user'],
                'password' => self::$configs['pass'],
                'host' => self::$configs['host'],
                'port' => self::$configs['port'],
                'driver' => 'pdo_mysql',
                'options' => [
                    \PDO::ATTR_EMULATE_PREPARES => true,
                    \PDO::ATTR_TIMEOUT => self::$timeout
                ],
            );

            $conn = \Doctrine\DBAL\DriverManager::getConnection($connectionParams);
          
            return $conn;
        } catch (\PDOException $e) {
            
        } catch (\Exception $e) {
            
        }
    }
}
