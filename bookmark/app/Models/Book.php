<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

# books => Book
# mice => Mouse

class Book extends Model
{
    use HasFactory;

    /**
     *
     */
    public function users()
    {
        return $this->belongsToMany('App\Models\User')
        ->withTimestamps() # Must be added to have Eloquent update the created_at/updated_at columns in a pibot table
        ->withPivot('notes'); # Must also specify any other fields that should be included when fetching this relationship
    }

    /**
     *
     */
    public function author()
    {
        # Book belongs to Author
        # Define an inverse one-to-many relationship.
        return $this->belongsTo('App\Models\Author');
    }

    /**
     *
     */
    public static function findBySlug($slug)
    {
        return self::where('slug', '=', $slug)->first();
    }

    /**
     * Hypotehtical method to contrast the use of static vs. not
     */
    public function isModern()
    {
        return $this->published_year > 2000;
    }
}