<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Models\PhoneType;

class Phone extends Model
{
    use HasFactory;

    protected $fillable = ['number', 'is_main', 'type_id'];

    public function type()
    {
        return $this->belongsTo(PhoneType::class);
    }

    public function getPhoneTextAttribute($value)
    {
        $this->number .= ' - ' . $this->type->name;
        return ($this->is_main ? $this->number . ' - основной' : $this->number);
    }
}
