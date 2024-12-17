<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class TestDataRelation extends Model
{
    use HasFactory;

    protected $fillable = ['test_data_id', 'relation_name', 'relation_email', 'relation_age'];

    public function testData()
    {
        return $this->belongsTo(TestData::class);
    }
}
