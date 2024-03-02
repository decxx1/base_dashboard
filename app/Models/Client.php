<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Models\User;

class Client extends Model
{
    use HasFactory;

    protected $fillable = [
        'user_id',
        'name',
        'street',
        'street_number',
        'zip_code',
        'city',
        'state',
        'country',
        'longitude',
        'latitude',
    ];

    public function user()
    {
        return $this->belongsTo(User::class, 'user_id');
    }

    public function getFormattedAddress()
    {
        $addressComponents = [
            $this->number,
            $this->street,
            $this->city,
            $this->state,
            $this->country,
            $this->zip_code,
        ];

        $formattedAddress = implode(', ', array_filter($addressComponents));

        return $formattedAddress;
    }

}
