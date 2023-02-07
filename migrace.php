<?php

namespace aplikace;

mb_internal_encoding('UTF-8');

use aplikace\core\Aplikace;
use Dotenv\Dotenv;

require_once __DIR__ . '/vendor/autoload.php';
$dotenv = Dotenv::createImmutable(__DIR__);
$dotenv->load();

$konfigurace = [
    'databaze' => [
        'dsn' => $_ENV['DB_DSN'],
        'uzivatel' => $_ENV['DB_UZIVATEL'],
        'heslo' => $_ENV['DB_HESLO']
    ]
];

$aplikace = new Aplikace(__DIR__, $konfigurace);

$aplikace->db->aplikujMigrace();