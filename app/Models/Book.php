<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Book extends Model
{
    use HasFactory;

    protected $fillable = ["author", "title", "publisher", "year", "release", "ISBN", "takeable"];

    public function scopeFilters($query, array $filters)
    {
        if ($filters['search'] ?? false) {
            $search = $filters['search'];
            $category = $filters['category'];
            $query->where($category, 'like', '%' . $search . '%');
        }
    }
}
