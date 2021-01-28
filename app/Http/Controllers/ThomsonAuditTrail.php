<?php

namespace App;

use App;
use Illuminate\Database\Eloquent\Scope;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Support\Facades\DB;

class ThomsonAuditTrail extends Model
{
     
     protected $table = 'thomson_audit_trail';

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
          'data_uid',  'requestor_id', 'actions', 'info', 'creted_at', 'updated_at'
    ];

    /**
     * The attributes that should be hidden for arrays.
     *
     * @var array
     */
    protected $hidden = [
       'id'
    ];
   

}
