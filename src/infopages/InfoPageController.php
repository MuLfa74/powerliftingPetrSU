<?php

namespace App\InfoPages;

class InfoPageController
{   
    public function __construct(){
    }

    /**
     * Отображает страницу с инструкцией для новичков.
     *
     * @return void
     */
    public function forNewbies(): void
    {
        require __DIR__ . '/views/for_newbies.php';
    }

    /**
     * Отображает страницу с контактной информацией.
     *
     * @return void
     */
    public function contacts(): void
    {
        require __DIR__ . '/views/contacts.php';
    }
}
