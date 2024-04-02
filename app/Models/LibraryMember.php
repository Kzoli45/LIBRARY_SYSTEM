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
