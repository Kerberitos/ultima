<?php 

return array( 
	
	/*
	|--------------------------------------------------------------------------
	| oAuth Config
	|--------------------------------------------------------------------------
	*/

	/**
	 * Storage
	 */
	'storage' => 'Session', 

	/**
	 * Consumers
	 */
	'consumers' => array(

		/**
		 * Credenciales nuevas Facebook final 2015 Miradita Loja. Con nuevo logo
		 * Utilizando API v 2.3 en la app de facebook
		 */


        'Facebook' => array(
            'client_id'     => '636043603194061',
            'client_secret' => '63fcbde27ce86e3ade679a99e45e29f1',

            'scope'         => array('email','user_friends','user_status'),

        ),

        /**
		 * Credenciales nuevas Google final 2015 Miradita Loja. Con nuevo logo
		 */

		'Google' => array(
			'client_id'     => '156908383656-im7b14ar1arridb53jq0na9hhn7rgks3.apps.googleusercontent.com',
			'client_secret' => 'YbfRJwhafzKMwgvbSwK9favo',
			'scope'         => array('userinfo_email', 'userinfo_profile'),
		),

		/**
		 * Credenciales nuevas Twiter final 2015 Miradita Loja. Con nuevo logo
		 */


		'Twitter' => array(
			'client_id'     => 'a6GZSj4o7TmgrnvvJjerM6Qbn',
			'client_secret' => 'WI19j7R5YFShkTIScOdEDgTBzsnIHcimdkbgDokhTrZss78kQc',
					// No scope - oauth1 doesn't need scope
		),	

	)

);