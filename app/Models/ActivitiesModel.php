<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\URL;

class ActivitiesModel extends Model
{
    use HasFactory;
    protected $table = 'activities';
    protected $fillable = ['user_id', 'name','created_at','updated_at','url','method','user_agent','crud'];
    public $timestamps = true;


    public static function addActivity($activity_name = null, $crud = false)
    {
        $request = Request::capture();
        ActivitiesModel::create([
        'user_id' => auth()->user()->id,
        'name' => $activity_name,
        'url' => URL::full(),
        'method' => $request->method(),
        'crud' => $crud,
        'user_agent' => $request->header('user-agent'),
       ]);
    }


}
