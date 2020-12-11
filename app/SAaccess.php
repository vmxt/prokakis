<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use App\User;
use App\CompanyProfile;

class SAaccess extends Model
{
     
     protected $table = 'sa_access';

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'user_id', 'company_id', 'sa_config_id', 'created_by', 'created_at', 'updated_at',
    ];

    /**
     * The attributes that should be hidden for arrays.
     *
     * @var array
     */
    protected $hidden = [
        'id', 
    ];
   
    public static function checkUserAccess($userId, $companyId, $configId)
    {
      $count =  SAaccess::where('user_id', $userId)->where('company_id', $companyId)->where('sa_config_id', $configId)->count();
        if($count > 0){
            return true;
        } else {
            return false;    
        }
    }


    public static function evalSAaccess($userId, $companyId, $configId)
    {
      $usr = User::find($userId);

        if($usr !== NULL){   

           if($usr->m_id !== NULL)
           {

            $companyId = CompanyProfile::getCompanyId($user_id);

            $count =  SAaccess::where('user_id', $userId)->where('company_id', $companyId)->where('sa_config_id', $configId)->count();

            
                if($count > 0){
                    return true;

                } else {
                    return redirect('home')->with('message', 'You are restricted to open page, please check with the administrator.');

                    return false;   

                }
          } 
            
        } 
    }
   

}
