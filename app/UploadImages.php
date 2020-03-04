<?php

namespace App;

use App;
use Illuminate\Database\Eloquent\Scope;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Builder;


class UploadImages extends Model
{

     protected $table = 'uploaded_images';

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
      'company_id', 'user_id', 'file_category', 'file_source', 'file_name', 'orig_filename', 'added_by', 'status', 'expiry_date',
    ];

    /**
     * The attributes that should be hidden for arrays.
     *
     * @var array
     */
    protected $hidden = [
        'id', 'updated_at', 'created_at'  
    ];
 
    public static function getFileNames($uid, $cid, $fc, $mode){
       $result = UploadImages::where('user_id', $uid) 
               ->where('company_id', $cid)
               ->where('file_category', $fc)
               ->orderBy('id', 'desc')
               ->take($mode)
               ->get();
       
       if( $result != null && isset($result[0]->id) ){
           if($result[0]->status == '1' && $mode == 1){
            return $result[0]->file_name;
           } else {
              $arrF = array(); 
              foreach($result as $data){
                if($data->status == '1'){  
                $arrF[] = array($data->id, $data->file_name, $data->orig_filename, $data->created_at, $data->expiry_date);  
                }
                
              } 
              return $arrF; 
           }
       }
    }

    public function validateWithExpiryDate()
    {

    }
    
   
}
