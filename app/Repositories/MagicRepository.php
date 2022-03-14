<?php

namespace App\Repositories;

use App\Interfaces\MagicRepositoryInterface;
use App\Models\Magic;
use App\Models\MagicPhrase;

/**
 * We are using here so called Repository pattern
 * Class MagicRepository
 * @package App\Repositories
 */
class MagicRepository implements MagicRepositoryInterface
{
    /**
     * Get all magic items
     * @return \Illuminate\Database\Eloquent\Collection
     */

    public function all()
    {
        return Magic::all();
    }

    /**
     * Get all new not notified phrases
     * @return MagicPhrase
     */

    public function allNotNotifiedPhrases()
    {
        return MagicPhrase::where('notified', false)->get();
    }

    /**
     * Find magic and phrases by slug
     * @param string $magicSlug
     * @return Magic
     */

    public function findBySlug($magicSlug)
    {
        $find = Magic::where('slug', $magicSlug)->first();
        return $find;
    }

    /**
     * Add magic
     * @param string $title
     * @return int
     */

    public function add($title)
    {
        $magic = Magic::create(
            ['title' => $title]
        );

        return $magic->id;
    }

    /**
     * Add magic phrase
     * @param int $magicId
     * @param string $title
     * @param string $description
     * @return int
     */

    public function addPhrase($magicId, $title, $description)
    {
        $phrase = MagicPhrase::create(
            [
                'title' => $title,
                'description' => $description,
                'magic_id' => $magicId,
            ]
        );

        return $phrase->id;
    }


    /**
     * View phrase
     * @param $id
     * @return MagicPhrase
     */

    public function viewPhrase($id)
    {
        $phrase = MagicPhrase::find($id);

        return $phrase;
    }


    /**
     * Delete phrase
     * @param $id
     * @return bool
     */

    public function deletePhrase($id)
    {
        $delete = MagicPhrase::find($id)->delete();

        return $delete;
    }

    /**
     * @param int $phraseId
     * @return bool
     */

    public function notified($phraseId)
    {
        return MagicPhrase::find($phraseId)->update(['notified' => true]);
    }
}
