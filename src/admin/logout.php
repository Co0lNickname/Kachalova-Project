<?php
require_once __DIR__ . '/../../src/services/SessionService.php';

$sessionService = new SessionService();
$sessionService->logout();

header('Location: /index.php');
exit();