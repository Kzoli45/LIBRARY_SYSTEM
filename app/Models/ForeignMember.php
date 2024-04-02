<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ForeignMember extends LibraryMember
{
    public function __construct()
    {
        parent::__construct(4, 30);
    }
}
