<?php

class DatabaseService
{
    private PDO $pdo;
    
    public function __construct()
    {
        $this->pdo = $this->connectDB();
    }
    
    private function connectDB(): PDO
    {
        $host = getenv('DB_HOST') ?: '127.0.0.1';
        $port = getenv('DB_PORT') ?: '3306';
        $dbname = getenv('DB_NAME') ?: 'db_name';
        $username = getenv('DB_USER') ?: 'root';
        $password = getenv('DB_PASSWORD') ?: '';
        
        try {
            $pdo = new PDO("mysql:host=$host;port=$port;dbname=$dbname;charset=utf8mb4", $username, $password);
            $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
            return $pdo;
        } catch (PDOException $e) {
            die("Error connecting to the database: " . $e->getMessage());
        }
    }
    
    public function getUserById(int $id): ?array
    {
        $stmt = $this->pdo->prepare("SELECT * FROM User WHERE UserID = :id");
        $stmt->execute(['id' => $id]);
        return $stmt->fetch(PDO::FETCH_ASSOC) ?: null;
    }
    
    public function getUserByEmail(string $email): ?array
    {
        $stmt = $this->pdo->prepare("SELECT * FROM User WHERE Email = :email");
        $stmt->execute(['email' => $email]);
        return $stmt->fetch(PDO::FETCH_ASSOC) ?: null;
    }
    
    public function createUser(string $name, string $username, string $email, string $password): bool
    {
        $hashedPassword = password_hash($password, PASSWORD_DEFAULT);
        $stmt = $this->pdo->prepare("INSERT INTO User (Name, Username, Email, Password) VALUES (:name, :username, :email, :password)");
        
        try {
            return $stmt->execute([
                'name' => $name,
                'username' => $username,
                'email' => $email,
                'password' => $hashedPassword
            ]);
        } catch (PDOException $e) {
            return false;
        }
    }
    
    public function updateUser(int $id, array $data): bool
    {
        $updateFields = [];
        $params = ['id' => $id];
        
        foreach ($data as $key => $value) {
            if (!empty($value) && in_array($key, ['Name', 'Username', 'Email', 'Password'])) {
                if ($key === 'Password') {
                    $value = password_hash($value, PASSWORD_DEFAULT);
                }
                $updateFields[] = "$key = :$key";
                $params[$key] = $value;
            }
        }
        
        if (empty($updateFields)) {
            return false;
        }
        
        $sql = "UPDATE User SET " . implode(', ', $updateFields) . " WHERE UserID = :id";
        $stmt = $this->pdo->prepare($sql);
        
        try {
            return $stmt->execute($params);
        } catch (PDOException $e) {
            return false;
        }
    }
} 