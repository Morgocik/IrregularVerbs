<?php
namespace Classes;

/**
 * Class DbConnection
 * @package Classes
 */
class DbConnection
{
    /**
     * @var \PDO
     */
    private $pdo;

    public function __construct(array $dbConnectionConfig)
    {
        $this->pdo = new \PDO(
            sprintf('mysql:host=%s;dbname=%s;', $dbConnectionConfig['host'], $dbConnectionConfig['database']),
//            'mysql:host=' . $dbConnectionConfig['host'] . ';dbname=' . $dbConnectionConfig['database'] . ';',
            $dbConnectionConfig['username'],
            $dbConnectionConfig['password'],
            $dbConnectionConfig['option']
        );
    }

    /**
     * @param $query
     * @param array $binds
     *
     * @return array
     */
    public function executeQuery($query, $binds = [])
    {
        $preparedStatement = $this->pdo->prepare($query);
        $preparedStatement->execute($binds);

        return $preparedStatement->fetchAll(\PDO::FETCH_ASSOC);
    }
}