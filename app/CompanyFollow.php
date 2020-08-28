<?php

namespace App;

use App;
use Illuminate\Database\Eloquent\Scope;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Builder;


class CompanyFollow extends Model
{
     
     protected $table = 'company_follow';

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'user_id', 'company_id','created_at', 'updated_at'
    ];

    /**
     * The attributes that should be hidden for arrays.
     *
     * @var array
     */
    protected $hidden = [
        'id',  
    ];
    

    public static function getFollowCompany($user_id, $company_id){
        $result =  CompanyFollow::where('user_id', $user_id)
                        ->where('company_id', $company_id);
        if($result->count() > 0){
            $result->delete();
            $status = 'minus';
        }else{
            CompanyFollow::create([
                'user_id' => $user_id,
                'company_id' => $company_id
            ]);
            $status = 'add';

        }
        return $status;
    }

    public static function checkFollowCompany($user_id, $company_id){
        $result =  CompanyFollow::where('user_id', $user_id)
                        ->where('company_id', $company_id)->count();
   
        return $result;
    }

   
}
