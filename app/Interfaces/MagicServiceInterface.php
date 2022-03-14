<?php

namespace App\Interfaces;

interface MagicServiceInterface
{
    public function getAll();
    public function findBySlug($magicSlug);
    public function add($title);
    public function addPhrase($magicId, $title, $description);
}
