    <?php
/**
 * Database Configuration & PDO Singleton Wrapper
 * Mursal Marble Application
 */

class Database {
    private static $instance = null;
    private $pdo;
    private $stmt;
    
    // Connection Settings (Standard XAMPP / MySQL local defaults)
    private $host = 'localhost';
    private $db_name = 'mursal_marble';
    private $username = 'root';
    private $password = '';
    private $charset = 'utf8mb4';

    private function __construct() {
        $dsn = "mysql:host={$this->host};dbname={$this->db_name};charset={$this->charset}";
        $options = [
            PDO::ATTR_ERRMODE            => PDO::ERRMODE_EXCEPTION,
            PDO::ATTR_DEFAULT_FETCH_MODE => PDO::FETCH_ASSOC,
            PDO::ATTR_EMULATE_PREPARES   => false,
        ];

        try {
            $this->pdo = new PDO($dsn, $this->username, $this->password, $options);
        } catch (PDOException $e) {
            // Friendly error message if DB is not imported yet or server offline
            die("<div style='font-family: sans-serif; padding: 2rem; background: #fff1f0; border: 1px solid #ffa39e; color: #cf1322; border-radius: 8px; margin: 2rem;'>
                <h2>⚠️ Database Connection Error</h2>
                <p>Could not connect to MySQL database <strong>'{$this->db_name}'</strong>.</p>
                <p><strong>Error details:</strong> " . htmlspecialchars($e->getMessage()) . "</p>
                <hr>
                <p><strong>Instructions:</strong></p>
                <ol>
                    <li>Make sure MySQL server is running in XAMPP / MariaDB.</li>
                    <li>Create a database named <code>{$this->db_name}</code> in phpMyAdmin.</li>
                    <li>Import the SQL file located at <code>database/mursal_marble.sql</code>.</li>
                </ol>
            </div>");
        }
    }

    public static function getInstance() {
        if (self::$instance === null) {
            self::$instance = new self();
        }
        return self::$instance;
    }

    public function getConnection() {
        return $this->pdo;
    }

    // Helper method for prepared statements
    public function query($sql, $params = [])
{
    $this->stmt = $this->pdo->prepare($sql);

    if (!empty($params)) {
        $this->stmt->execute($params);
    }
}


public function bind($param, $value, $type = null) {

    if (is_null($type)) {
        switch (true) {
            case is_int($value):
                $type = PDO::PARAM_INT;
                break;

            case is_bool($value):
                $type = PDO::PARAM_BOOL;
                break;

            case is_null($value):
                $type = PDO::PARAM_NULL;
                break;

            default:
                $type = PDO::PARAM_STR;
        }
    }

    $this->stmt->bindValue($param, $value, $type);
}

public function execute() {
    return $this->stmt->execute();
}

public function resultSet() {
    $this->execute();
    return $this->stmt->fetchAll(PDO::FETCH_ASSOC);
}

public function single() {
    $this->execute();
    return $this->stmt->fetch(PDO::FETCH_ASSOC);
}
public function fetchAll($sql, $params = [])
{
    $this->query($sql, $params);
    return $this->resultSet();
}


public function fetch($sql, $params = [])
{
    $this->query($sql, $params);
    return $this->single();
}

    public function lastInsertId() {
        return $this->pdo->lastInsertId();
    }
}
