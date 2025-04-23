<?php

class SessionService 
{
    public function __construct() 
    {
        if (session_status() === PHP_SESSION_NONE) {
            session_start();
        }
    }
    
    public function isLoggedIn(): bool 
    {
        return isset($_SESSION['client_id']);
    }
    
    public function getUserId(): ?int 
    {
        return $_SESSION['client_id'] ?? null;
    }
    
    public function setUserId(int $userId): void 
    {
        $_SESSION['client_id'] = $userId;
    }
    
    public function logout(): void 
    {
        unset($_SESSION['client_id']);
        session_destroy();
    }
    
    public function setFlashMessage(string $type, string $message): void 
    {
        $_SESSION['flash'][$type] = $message;
    }
    
    public function getFlashMessage(string $type): ?string 
    {
        if (isset($_SESSION['flash'][$type])) {
            $message = $_SESSION['flash'][$type];
            unset($_SESSION['flash'][$type]);
            return $message;
        }
        return null;
    }
    
    public function hasFlashMessage(string $type): bool 
    {
        return isset($_SESSION['flash'][$type]);
    }
} 