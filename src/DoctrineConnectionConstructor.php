<?php
/**
 * Author: Roger Creasy
 * Email: roger@rogercreasy.com
 * Date: 1/24/17
 * Time: 2:39 PM
 */

namespace CGClabs\LaravelDoctrineConnection;

use Doctrine\ORM\EntityManager;
use Doctrine\ORM\Tools\Setup;
use PDO;

class DoctrineConnectionConstructor
{
    private $connection;
    private $config;
    public $em;

    public function __construct($connection = null)
    {
        $this->config = Setup::createAnnotationMetadataConfiguration(
            [__DIR__ . '/..app/Entities/'],
            true,
            __DIR__ . '/..bootstrap/cache',
            null,
            false
        );

        $this->connection = $connection;

        if ($this->connection == null) {
            $this->connection = getenv('DB_CONNECTION');
        }

        $username = getenv('DB_USER');
        $password = getenv('DB_PASSWORD');
        $dbh = new PDO($this->connection, $username, $password);
        $this->em = EntityManager::create(array('pdo' => $dbh, 'driverClass' => '\DoctrineDbalIbmi\Driver\DB2Driver'), $this->config);
    }
}