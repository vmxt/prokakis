<?php

namespace App;

use App;
use Illuminate\Database\Eloquent\Scope;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Support\Facades\DB;

class TourDetail extends Model
{
     
     protected $table = 'tour_detail';

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
         'user_id', 'scope',  'created_at', 'updated_at'
    ];

    /**
     * The attributes that should be hidden for arrays.
     *
     * @var array
     */
    protected $hidden = [
       'id'
    ];
   

    public static function updateTourDetail($headId, $scope, $is_end){
 
        $res = TourDetail::where('user_id', $headId);
        if($res->count() > 0){
            if($is_end == 'end'){
                $scopes = str_replace(",".$scope, '', $res->first()->scope);
                $scope = $scopes.",".$scope;
            }else{
                if (strpos($res->first()->scope , $scope) !== false) {
                    $scope = str_replace(",".$scope, '', $res->first()->scope);
                }else{
                    $scope = $res->first()->scope.",".$scope;
                }
            }
            
            $res->update(['scope'=> $scope]);
        }else{
            TourDetail::create([
                'user_id' => $headId,
                'scope' => $scope
            ]);
        }
                

    }

}
