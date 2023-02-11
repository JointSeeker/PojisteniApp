<?php
/* načtení autoloaderu z composeru
* DIR - složka celé aplikace
 * a místo kde se autoload nachází
*/
mb_internal_encoding('UTF-8');

use aplikace\controllers\AutorizacniKontroler;
use aplikace\controllers\PojistenecKontroler;
use aplikace\controllers\SitovyKontroler;
use aplikace\core\Aplikace;

require_once __DIR__ . '/../vendor/autoload.php';
$dotenv = \Dotenv\Dotenv::createImmutable(dirname(__DIR__));
$dotenv->load();

$konfigurace = [
    'tridaUzivatel' =>\aplikace\models\Pojistnik::class,
    'databaze' => [
        'dsn' => $_ENV['DB_DSN'],
        'uzivatel' => $_ENV['DB_UZIVATEL'],
        'heslo' => $_ENV['DB_HESLO']
    ]
];

$aplikace = new Aplikace(dirname(__DIR__), $konfigurace);

//přiřazení cest pro ziskání pohledu přes Smerovac,
// zadáme zda jí chceme ziskat(get) nebo nastavit(post)
//Vybereme pohled a poté v poli vybereme odkud se má třída načíst a jaká třída se má načíst
$aplikace->smerovac->ziskej('/', [SitovyKontroler::class, 'home']);
$aplikace->smerovac->ziskej('/kontakt', [SitovyKontroler::class, 'kontakt']);
$aplikace->smerovac->nastav('/kontakt', [SitovyKontroler::class, 'manipulujKontakt']);
$aplikace->smerovac->ziskej('/profil', [SitovyKontroler::class, 'profil']);
$aplikace->smerovac->ziskej('/pojistenci', [PojistenecKontroler::class, 'pojistenec']);
$aplikace->smerovac->nastav('/pojistenci', [PojistenecKontroler::class, 'pojistenec']);

$aplikace->smerovac->ziskej('/prihlaseni', [AutorizacniKontroler::class, 'prihlaseni']);
$aplikace->smerovac->nastav('/prihlaseni', [AutorizacniKontroler::class, 'prihlaseni']);
$aplikace->smerovac->ziskej('/registrace', [AutorizacniKontroler::class, 'registrace']);
$aplikace->smerovac->nastav('/registrace', [AutorizacniKontroler::class, 'registrace']);
$aplikace->smerovac->ziskej('/odhlaseni', [AutorizacniKontroler::class, 'odhlaseni']);


$aplikace->spust();