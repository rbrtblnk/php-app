<?php declare(strict_types=1);
/**
 *
 **/

namespace Rbrtblnk\PhpApp;

use PDO;

/**
 * Class DbClient
 */
class DbClient
{
    private PDO $connection;

    public function __construct()
    {
        /* Connect to a MySQL database using driver invocation */
        $dsn = $_ENV['DB_DSN'];
        $user = $_ENV['DB_USER'];
        $password = $_ENV['DB_PASS'];

        $this->connection = new PDO($dsn, $user, $password);
    }

    public function getUsers(): array
    {
        $query = 'SELECT * FROM user LIMIT 0, 1000';

        $result = $this->connection
            ->query($query)
            ->fetchAll(PDO::FETCH_ASSOC);

        return $result ?: [];
    }
}
