<?php

namespace App\Services;

use App\Interfaces\MagicRepositoryInterface;
use App\Interfaces\MagicServiceInterface;

class MagicService implements MagicServiceInterface
{
    private $magicRepository;

    public function __construct(MagicRepositoryInterface $magicRepository)
    {
        $this->magicRepository = $magicRepository;
    }

    /**
     * Get all magic items
     * @return \Illuminate\Database\Eloquent\Collection
     */

    public function getAll()
    {
        return $this->magicRepository->all();
    }

    /**
     * Find magic and phrases by slug
     * @param string $magic
     * @return \App\Models\Magic
     */

    public function findBySlug($magicSlug)
    {
        return $this->magicRepository->findBySlug($magicSlug);
    }

    /**
     * Add magic
     * @param string $title
     * @return int New magic ID
     */

    public function add($title)
    {
        return $this->magicRepository->add($title);
    }

    /**
     * Add magic phrase
     * @param int $magicId
     * @param string $title
     * @param string $description
     * @return int New phrase ID
     */

    public function addPhrase($magicId, $title, $description)
    {
        return $this->magicRepository->addPhrase($magicId, $title, $description);
    }

    /**
     * View phrase
     * @param $id
     * @return mixed
     */

    public function viewPhrase($id)
    {
        return $this->magicRepository->viewPhrase($id);
    }

    /**
     * Delete phrase
     * @param $id
     * @return bool
     */
    public function deletePhrase($id)
    {
        return $this->magicRepository->deletePhrase($id);
    }
}
