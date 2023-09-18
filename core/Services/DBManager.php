<?php

namespace Core\Services;

use PDO;
use PDOException;

class DBManager
{
    /** @var string $DB_HOST */
    private string $DB_HOST;

    /** @var string $DB_USER */
    private string $DB_USER;

    /** @var string $DB_PASSWORD */
    private string $DB_PASSWORD;

    /** @var string $DB_DATABASE */
    private string $DB_DATABASE;

    /** @var string $DB_PORT */
    private int $DB_PORT;

    /** @var ENVManager $ENVManager */
    private ENVManager $ENVManager;

    /**
     * Constructor
     *
     * @param ENVManager $envManager
     */
    public function __construct(ENVManager $envManager)
    {
        $this->DB_DATABASE = $envManager->get('DB_DATABASE');
        $this->DB_USER = $envManager->get('DB_USERNAME');
        $this->DB_PASSWORD = $envManager->get('DB_PASSWORD');
        $this->DB_HOST = $envManager->get('DB_HOST');
    }

    /**
     * GET PDO
     *
     * @return PDO|PDOException
     */
    public function getPDO()
    {
        try {
            $pdo = new PDO("mysql:host=$this->DB_HOST;dbname=$this->DB_DATABASE;charset=utf8", $this->DB_USER, $this->DB_PASSWORD);
            $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
            return $pdo;
        } catch (PDOException $e) {
            die("CONNECTION FAIL: " . $e->getMessage());
        }
    }
}
