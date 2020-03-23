<?php

namespace App;

use Illuminate\Database\Eloquent\Model;


class ReportGenerationTemplate extends Model
{
     
     protected $table = 'report_generation_template';

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
    ];

    /**
     * The attributes that should be hidden for arrays.
     *
     * @var array
     */
    protected $hidden = [
        'id', 
    ];
   

}
