<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;

class TestData extends ApiBaseModel
{
    use HasFactory;
    protected $fillable = ['name', 'email', 'age'];

    public function relation()
    {
        return $this->hasOne(TestDataRelation::class);
    }
}
