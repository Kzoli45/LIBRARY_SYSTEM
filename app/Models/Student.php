<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Student extends LibraryMember
{
    public function __construct()
    {
        parent::__construct(5, 60);
    }
}
