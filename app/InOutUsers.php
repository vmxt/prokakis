<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use App\CompanyProfile;

class InOutUsers extends Model {

	protected $table = 'in_out_users';

	/**
	 * The attributes that are mass assignable.
	 *
	 * @var array
	 */
	protected $fillable = [
        'user_id', 'status', 'created_at', 'updated_at',
    ];

    /**
	 * The attributes that should be hidden for arrays.
	 *
	 * @var array
	 */
	protected $hidden = [
		'id',
	];
    
    public static function insert_updateDB($data)
    {
       $rs = InOutUsers::where('user_id', $data['user_id'])->first();
        
       if($rs == null){ 
            InOutUsers::create([
                'user_id'       => $data['user_id'], 
                'status'        => $data['status'], 
                'created_at'    => date('Y-m-d'), 
            ]);

        } else {
            $rs->status  = $data['status']; 
            $rs->save();
        }

    }

    //return 1 or 0
    //1 for online, 0 for offline
    public static function checkOnlineByCompany($company_id)
    {
       $rs =  CompanyProfile::find($company_id);
       if($rs != null){
           $io = InOutUsers::where('user_id', $rs->user_id)->first();
           if($io != null){

                if($io->status == 1){
                        return 1;
                } else {
                    return 0;
                }

           } else {
               return 0;
           }
       } 
    }

}
