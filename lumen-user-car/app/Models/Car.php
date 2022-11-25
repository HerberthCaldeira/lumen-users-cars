<?php

namespace App\Models;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Models\User;
use Illuminate\Database\Eloquent\SoftDeletes;
class Car extends Model
{
    use HasFactory;
    use SoftDeletes;
    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'user_id',
        'model'
    ];

    public function users(){
        return $this->belongsToMany(User::class);
    }


    protected static function boot() {
        parent::boot();
        static::deleting(function($offer) {
            $offer->users()->detach() ;
        });
    }

}
