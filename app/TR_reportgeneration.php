<?php

namespace App;

use Illuminate\Database\Eloquent\Model;


class TR_reportgeneration extends Model
{

     protected $table = 'tr_report_generation';

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'uid', 'request_id', 'company_req_id', 'company_prov_id', 'created_at', 'updated_at', 'status', 'added_by' 
    ];

    /**
     * The attributes that should be hidden for arrays.
     *
     * @var array
     */
    protected $hidden = [
       'id' 
    ];

    public static function saveTR($tr, $req, $user_id){

       if(trim($tr) != ''){
       $cc = TR_reportgeneration::where('uid', $tr)->where('request_id')->count();
        if($cc == 0){
            TR_reportgeneration::create([
                'uid' => trim($tr), 
                'request_id' => $req->id, 
                'company_req_id' => $req->company_id, 
                'company_prov_id' => $req->source_company_id, 
                'created_at' => date('Y-m-d'), 
                'status'  => 1,
                'added_by' => $user_id,
            ]);
        }

       }    
    }


}
