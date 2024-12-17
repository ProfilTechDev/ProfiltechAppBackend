<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Company extends Model
{
    protected $fillable = [
        'name',
        'email',
        'phone',
        'vat_number',
    ];

    protected $with = ['address'];

    public function address()
    {
        return $this->hasOne(CompanyAddress::class);
    }
}
