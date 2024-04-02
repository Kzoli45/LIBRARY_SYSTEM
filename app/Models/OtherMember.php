<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class OtherMember extends LibraryMember
{
    public function __construct()
    {
        parent::__construct(2, 14);
    }
}
