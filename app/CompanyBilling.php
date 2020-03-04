<?php

namespace App;

use App;
use Illuminate\Database\Eloquent\Scope;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Builder;


class CompanyBilling extends Model
{
     
     protected $table = 'company_billing';

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'user_id', 'company_id', 'account_name', 'account_email', 'card_holder_name', 'card_number', 'security_code', 'card_expiry_date',
        'created_at', 'updated_at', 'added_by', 'edited_by' 
    ];

    /**
     * The attributes that should be hidden for arrays.
     *
     * @var array
     */
    protected $hidden = [
        'id',  
    ];
    
    public static function getBillingId($user_id, $company_id){
       $c = CompanyContacts::where('user_id', $user_id) //'num_of_employee'
               ->where('company_id', $company_id)
               ->orderBy('id', 'desc')
               ->take(1)
               ->get();
       
        if($c->count() > 0){ 
            if(isset($c[0]->id)){
             return $c[0]->id;
            }
        } else{
           return 0; 
        }
    }
   
}
