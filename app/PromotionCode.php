<?php

namespace App;

use App;
use Illuminate\Database\Eloquent\Scope;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Builder;


class PromotionCode extends Model
{

     protected $table = 'tbl_promocode';

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'promocode', 'status', 'created_at', 'updated_at',
    ];

    /**
     * The attributes that should be hidden for arrays.
     *
     * @var array
     */
    protected $hidden = [
        'id',
    ];

    public static function assignCode($code){

      $vCode = PromotionCode::where('promocode', $code)->where('status', 'in')->first();
      if($vCode->count() > 0){
            $p = PromotionCode::find($vCode->id);
            $p->status = 'out';
            $p->save();
      } else{
          return 'Not found =>'.$code;
      }

    }

    //initialiser
    public static function initCode(){
     $code =  PromotionCode::generateCode();

     $vCode = PromotionCode::where('promocode', $code)
               ->where('status', 'in')
               ->orderBy('id', 'desc')
               ->take(1)
               ->get();

      if($vCode->count() == 0){
             $isok = PromotionCode::create(['promocode' => $code, 'status'=>'in']);
            if($isok){
              return $code;
            }
      } else {
        return PromotionCode::initCode();
      }

   }

   //stand alone
   public static function generateCode(){
       $random_chars = '';
       $characters = array(
            "A","B","C","D","E","F","G","H","J","K","L","M",
            "N","P","Q","R","S","T","U","V","W","X","Y","Z",
            "1","2","3","4","5","6","7","8","9");

            //make an "empty container" or array for our keys
            $keys = array();

            //first count of $keys is empty so "1", remaining count is 1-7 = total 8 times
            while( count(array)$keys) - 1 < 5 ) { //five only as mentioned and promised at the chat
                //"0" because we use this to FIND ARRAY KEYS which has a 0 value
                //"-1" because were only concerned of number of keys which is 32 not 33
                //count($characters) = 33
                $x = mt_rand(0, count((array)$characters)-1);
                if(!in_array($x, $keys)) {
                   $keys[] = $x;
                }
            }

            foreach($keys as $key){
               $random_chars .= $characters[$key];
            }

         return $random_chars;
   }



}
