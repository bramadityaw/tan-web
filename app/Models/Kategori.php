<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Spatie\Sluggable\HasSlug;
use Spatie\Sluggable\SlugOptions;

class Kategori extends Model
{
    use HasFactory;
    use HasSlug;

    /**
	 * Get the options for generating the slug.
	 */
    public function getSlugOptions() : SlugOptions
    {
        return SlugOptions::create()
            ->generateSlugsFrom('value')
            ->saveSlugsTo('slug');
    }

    /**
     * The table associated with the model.
     *
     * @var string
     */
    protected $table = 'kategori';

    protected $fillable = [
        'value',
    ];
}
