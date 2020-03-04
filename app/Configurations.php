<?php

namespace App;

use App;
use Illuminate\Database\Eloquent\Scope;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Builder;


class Configurations extends Model
{
     
     protected $table = 'system_configurations';

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'json_value', 'description', 'deate_added', 'date_edited', 'edited_by' , 'status',
    ];

    /**
     * The attributes that should be hidden for arrays.
     *
     * @var array
     */
    protected $hidden = [
        'id', 'code_name',  
    ];
    
    public static function getJsonValue($code_name)
    {
      $c = Configurations::where('code_name', $code_name) //'num_of_employee'
               ->orderBy('id', 'desc')
               ->take(1)
               ->get();
       $result = '';
    
            if( isset($c[0]->json_value) ){
            $result = json_decode($c[0]->json_value, true);
            }
            return $result;
    }
   
}
