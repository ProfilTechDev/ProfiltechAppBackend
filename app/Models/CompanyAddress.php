<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class CompanyAddress extends Model
{
    protected $fillable = [
        'company_id',
        'address',
        'city',
        'state',
        'zip',
        'country',
    ];

    public function company()
    {
        return $this->belongsTo(Company::class);
    }
}
