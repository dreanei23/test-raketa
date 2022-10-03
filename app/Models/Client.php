<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Models\Email;
use App\Models\Phone;


class Client extends Model
{
    use HasFactory;

    public function emails()
    {
        return $this->hasMany(Email::class);
    }

    public function phones()
    {
        return $this->hasMany(Phone::class);
    }

    public function saveEmails($emails)
    {
        if (!empty($emails)) {
            $this->emails()->delete();
            $emails_array = [];
            foreach ($emails as $email) {
                $emails_array[] = new Email($email);
            }
            return $this->emails()->saveMany($emails_array);
        }

        return false;
    }

    public function savePhones($phones)
    {
        if (!empty($phones)) {
            $this->phones()->delete();
            $phones_array = [];
            foreach ($phones as $phone) {
                $phones_array[] = new Phone($phone);
            }
            return $this->phones()->saveMany($phones_array);
        }

        return false;
    }

}
