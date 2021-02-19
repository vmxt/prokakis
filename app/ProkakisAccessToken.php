<?php

namespace App;

class ProkakisAccessToken
{

    private $publickey = '07a932dd17adc59b49561f33980ec5254688a41f133b8a26e76c611073ade89b';
    private $secretkey = '5254688a41f133b8a26e76c611073ade89b';
    private $saltedDate;
    private $genCode;

    function __construct()
    {
        $this->prokakisAlgo();
    }
	
    function prokakisAlgo()
    {
        $this->saltedDate = date('YmdHis');
        $this->genCode = hash_hmac('haval256,5', $this->publickey, $this->secretkey.$this->saltedDate);
        return $this->genCode;
    }

    function registeredToken()
    {
        $public_key = base64_encode($this->publickey);
        $gen_Code = base64_encode($this->genCode);
        $salt_Date = base64_encode($this->saltedDate);
        $url = $salt_Date.'|'.$gen_Code.'|'.$public_key;
		return $url;
		
    }

    function getTokenValue()
    {
        return $this->genCode;
    }

    public static function getSCode()
    {
        $saltedDate = date('YmdHis');
        $genCode = hash_hmac('haval256,5', '07a932dd17adc59b49561f33980ec5254688a41f133b8a26e76c611073ade89b',
        '5254688a41f133b8a26e76c611073ade89b'.$saltedDate);
        $public_key = base64_encode('07a932dd17adc59b49561f33980ec5254688a41f133b8a26e76c611073ade89b');
        $gen_Code = base64_encode($genCode);
        $salt_Date = base64_encode($saltedDate);
        $url = $salt_Date.'|'.$gen_Code.'|'.$public_key;
        return $url;
    }

}