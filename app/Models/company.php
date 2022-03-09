<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use App\Models\User;
class company extends Model
{
    use HasFactory, SoftDeletes;

    protected $fillable = [
        'name',
        'email',
        'tel',
    ];
    public function users()
    {
        return $this->hasMany('App\Models\User', 'company_id', 'id');
        // return $this->hasMany(\User::class);
    }
    // public function count()
    // {
    //     return 1;
    // }
    /**
     * Create a new factory instance for the model.
     *
     * @return \Illuminate\Database\Eloquent\Factories\Factory
     */
    // protected static function newFactory()
    // {
    //     return company::new();
    //     // company::factory()->has(User::factory()->Admin())->has(User::factory()->User()->count(99))->count(100)->create();
    //     // return true;
    // }
}
