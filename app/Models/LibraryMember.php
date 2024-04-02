<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class LibraryMember extends Model
{
    protected $maxBooks;
    protected $loanDuration;

    public function __construct($maxBooks, $loanDuration)
    {
        $this->maxBooks = $maxBooks;
        $this->loanDuration = $loanDuration;
    }

    public function getMaxBooks()
    {
        return $this->maxBooks;
    }

    public function getLoanDuration()
    {
        return $this->loanDuration;
    }
}

class Student extends LibraryMember
{
    public function __construct()
    {
        parent::__construct(5, 60);
    }
}

class Teacher extends LibraryMember
{
    public function __construct()
    {
        parent::__construct(999, 365);
    }
}

class ForeignMember extends LibraryMember
{
    public function __construct()
    {
        parent::__construct(4, 30);
    }
}

class OtherMember extends LibraryMember
{
    public function __construct()
    {
        parent::__construct(2, 14);
    }
}
