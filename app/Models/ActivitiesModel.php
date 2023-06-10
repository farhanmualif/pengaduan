<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ActivitiesModel extends Model
{
    use HasFactory;
    use HasFactory;
    protected $table = 'activities';
    protected $fillable = ['user_id', 'email','activity_name','created_at','updated_at'];
    public $timestamps = true;

    public static function addActivity($activity_name)
    {
        ActivitiesModel::create([
        'user_id' => auth()->user()->id,
        'email' => auth()->user()->email,
        'activity_name' => $activity_name,
       ]);
    }
}
