<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Member extends Model
{
    use HasFactory;

    protected $fillable = ["name", "postcode", "city", "street", "door", "type", "contact"];

    public function lendings()
    {
        return $this->hasMany(Lending::class);
    }
}
