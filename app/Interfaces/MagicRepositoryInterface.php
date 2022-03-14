<?php

namespace App\Interfaces;

interface MagicRepositoryInterface
{
    public function all();
    public function allNotNotifiedPhrases();
    public function findBySlug($magicSlug);
    public function add($title);
    public function addPhrase($magicId, $title, $description);
    public function notified($phraseId);
}
