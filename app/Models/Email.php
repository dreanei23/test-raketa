<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Email extends Model
{
    use HasFactory;

    protected $fillable = ['email', 'is_main'];

    public function getEmailTextAttribute($value)
    {
        return $this->is_main ? $this->email . ' - основная' : $this->email;
    }
}
