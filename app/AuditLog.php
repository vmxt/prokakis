<?php

namespace App;

use App;
use Illuminate\Database\Eloquent\Scope;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Builder;


class AuditLog extends Model
{
     
     protected $table = 'audit_log';

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'user_id', 'model', 'action', 'details', 'created_at', 'updated_at',
    ];

    /**
     * The attributes that should be hidden for arrays.
     *
     * @var array
     */
    protected $hidden = [
        'id',  
    ];

    public static function ok($data){

      $ok =  AuditLog::create([
         'user_id' => $data[0], 
         'model' => $data[1], 
         'action' => $data[2], 
         'details' => $data[3], 
         'created_at'=>date('Y-m-d')   
        ]);

      if($ok){
        return true;
      }

    }

    static function getLogs($id){

            return AuditLog::where('user_id', $id)

                ->orderBy('updated_at', 'desc');

           
          
    }
   
}
