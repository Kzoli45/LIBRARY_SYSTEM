<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Member extends Model
{
    use HasFactory;

    protected $fillable = ["name", "postcode", "city", "street", "door", "type", "contact", "deleted"];

    public function scopeFilters($query, array $filters)
    {
        if ($filters['search'] ?? false) {
            $search = $filters['search'];
            $category = $filters['category'];
            $query->where($category, 'like', '%' . $search . '%');
        }
    }

    public function lendings()
    {
        return $this->hasMany(Lending::class);
    }
}
