<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class MagicPhrase extends Model
{
    // Panaudojam trait
    use HasFactory;
    use SoftDeletes;

    protected $guarded = [];

    /**
     * Inverse magic relation'as
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */

    public function magic()
    {
        return $this->belongsTo(Magic::class);
    }
}
