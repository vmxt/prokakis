<?php

namespace App;

use Illuminate\Database\Eloquent\Model;


class BrandSlogan extends Model
{
     
     protected $table = 'brand_slogan';

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'user_id', 'company_id', 'brand', 'slogan','created_at', 'updated_at' 
    ];

    /**
     * The attributes that should be hidden for arrays.
     *
     * @var array
     */
    protected $hidden = [
        'id',  
    ];
    
    public static function processUserAndCompanyIds($userId, $companyId, $brand, $slogan){
        
       $c = BrandSlogan::where('user_id', $userId) //'num_of_employee'
               ->where('company_id', $companyId)
               ->orderBy('id', 'desc')
               ->take(1)
               ->get();
       
        if($c->count() == 0){
                BrandSlogan::create([
                        'user_id' => $userId,
                        'company_id'=>$companyId,
                        'brand' => $brand,
                        'slogan' => $slogan,
                    ]);  
        } else {
            $u = BrandSlogan::find($c[0]->id);
            $u->brand = $brand;
            $u->slogan = $slogan;
            $u->save();
        }
        
        
    }
   
}
