<?php

namespace aplikace\core;

class Session
{
    protected const FLASH_KLIC = 'flash_messages';

    public function __construct()
    {
        session_start();
        $flashZpravy = $_SESSION[self::FLASH_KLIC] ?? [];
        foreach ($flashZpravy as $klic => &$flashZprava) {
            // oznaceni k odstranění
            $flashZprava['odstranit'] = true;
        }

        $_SESSION[self::FLASH_KLIC] = $flashZpravy;
    }

    public function nastavFlash($klic, $zprava)
    {
        $_SESSION[self::FLASH_KLIC][$klic] = [
            'odstranit' => false,
            'hodnota' => $zprava];
    }

    public function ziskejFlash($klic)
    {
        return $_SESSION[self::FLASH_KLIC][$klic]['hodnota'] ?? false;
    }

    public function nastav($klic, $hodnota)
    {
        $_SESSION[$klic] = $hodnota;
    }

    public function ziskej($klic)
    {
        return $_SESSION[$klic] ?? false;
    }

    public function odstran($klic)
    {
        unset($_SESSION[$klic]);
    }

    public function __destruct()
    {
        // Iterujte(opakujte?) přes označení k odstranění
        $flashZpravy = $_SESSION[self::FLASH_KLIC] ?? [];
        foreach ($flashZpravy as $klic => &$flashZprava) {
            if ($flashZprava['odstranit']) {
                unset($flashZpravy[$klic]);
            }
        }

        $_SESSION[self::FLASH_KLIC] = $flashZpravy;
    }
}