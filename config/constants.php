<?php



return [

    'options' => [
        
    'er_api' => 'https://er.app-prokakis.com/',
	'credit_point' => 0.02,

        'referral_point' => 0.01,

        'profile' => 'PROFILE_AVATAR',

        'profileSC' => 'PROFILE_AVATAR_SUB_CON',

        'profileMC' => 'PROFILE_AVATAR_MAS_CON',

        'awards' => 'AWARDS_FILE',

        'purchase_invoices' => 'PURCHASE_INVOICE_FILE',

        'sales_invoices' => 'SALES_INVOICE_FILE',

        'certification' => 'CERTIFICATE_FILE',

        'certificationSC' => 'CERTIFICATE_FILE_SUB_CON',

        'certificationMC' => 'CERTIFICATE_FILE_MAS_CON',

        'banner' => 'BANNER_IMG',

        'consultant_project' => 'CONSULTANT_PROJECT',

        'PAYPAL_SUCCESS_URL' => env('APP_URL').'buyTokens/success',

        'PAYPAL_CANCEL_URL' => env('APP_URL').'buyTokens/cancel',

        //PAYPAL
	
        'PAYPAL_API_ENDPOINT' => 'https://api-3t.paypal.com/nvp',

        'PAYPAL_API_USERNAME'  =>  'elisha_api1.ebos-sg.com', //'prokakis_api1.ebos-sg.com',

        'PAYPAL_API_PASSWORD'  =>  'A9AKE2YNH5ALBMHC', //'EJB9VDFEBSNCP4VF',

        'PAYPAL_API_SIGNATURE' =>  'A0uEaIiR68-zbTrTIDvzrysBqj-hA4T1Vx4Em8F05JuqIZMmQ2FjxqE1', //'A11hCuW2jv0cvaoyfsUIz4shGj31AtiF6Noshk.lKnk1nR4adZ-GtgYT',

        'PAYPAL_API_REDIRECT' => 'https://www.paypal.com/cgi-bin/webscr?cmd=_express-checkout&token=',

        'PAYPAL_IPN_BACKTOPAYPAL_SANBOX' => 'https://ipnpb.paypal.com/cgi-bin/webscr',
        

	/*
        'SANDBOX_PAYPAL_API_ENDPOINT' => 'https://api-3t.paypal.com/nvp',

        'SANDBOX_PAYPAL_API_USERNAME'  => 'elisha_api1.ebos-sg.com',

        'SANDBOX_PAYPAL_API_PASSWORD'  => 'A9AKE2YNH5ALBMHC',

        'SANDBOX_PAYPAL_API_SIGNATURE' => 'A0uEaIiR68-zbTrTIDvzrysBqj-hA4T1Vx4Em8F05JuqIZMmQ2FjxqE1',

        'SANDBOX_PAYPAL_API_REDIRECT' => 'https://www.paypal.com/cgi-bin/webscr?cmd=_express-checkout&token=',

        'PAYPAL_IPN_BACKTOPAYPAL_SANBOX' => 'https://ipnpb.paypal.com/cgi-bin/webscr',

        'PAYPAL_IPN_BACKTOPAYPAL_LIVE' => 'https://ipnpb.paypal.com/cgi-bin/webscr',
	 */
        



     	//------------------



        //PAYPAL SANDBOX

        /*'PAYPAL_USERNAME' => 'vic_snts@yahoo.com',

        'PAYPAL_PASSWORD' => 'mariavictoria120306*',

        'PAYPAL_API_ENDPOINT' => 'https://api-3t.sandbox.paypal.com/nvp',

        'PAYPAL_API_USERNAME'  => 'vic_snts_api1.yahoo.com',

        'PAYPAL_API_PASSWORD'  => 'WRJ6Z9LZWSV3FRS8',

        'PAYPAL_API_SIGNATURE' => 'ApG3OSCqH3ajiXF47F5KV7skAHpVApw-5ai0JI90Umq16FYosz6mC3Jc',

        'PAYPAL_API_REDIRECT' => 'https://www.sandbox.paypal.com/cgi-bin/webscr?cmd=_express-checkout&token=',

        'PAYPAL_IPN_BACKTOPAYPAL_SANBOX' => 'https://ipnpb.sandbox.paypal.com/cgi-bin/webscr',*/

        //------------------

    



    ]

];