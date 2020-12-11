<?php

namespace App;

use DB;
use Illuminate\Database\Eloquent\Model;

class ThomsonReuters3 extends Model {

	protected $table = 'reuters_databank3';

	/**
	 * The attributes that are mass assignable.
	 *
	 * @var array
	 */
	protected $fillable = [
		'UID',
		'LAST_NAME',
		'FIRST_NAME',
		'ALIASES',
		'LOW_QUALITY_ALIASES',
		'ALTERNATIVE_SPELLING',
		'CATEGORY',
		'TITLE',
		'SUB_CATEGORY',
		'POSITION',
		'AGE',
		'DOB',
		'DOBS',
		'PLACE_OF_BIRTH',
		'DECEASED',
		'PASSPORTS',
		'PASSPORT_COUNTRY',
		'SSN',
		'IDENTIFICATION_NUMBERS',
		'LOCATIONS',
		'COUNTRIES',
		'CITIZENSHIP',
		'COMPANIES',
		'E_I',
		'LINKED_TO',
		'FURTHER_INFORMATION',
		'KEYWORDS',
		'EXTERNAL_SOURCES',
		'ENTERED',
		'UPDATED',
		'EDITOR',
		'AGE_DATE',
		'UPDATECATEGORY',
		'CREATED_AT',
	];

	/**
	 * The attributes that should be hidden for arrays.
	 *
	 * @var array
	 */
	protected $hidden = [
		'ID',
    ];
    


}