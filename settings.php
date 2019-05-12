<?php

    return [

            'settings' => [

                'displayErrorDetails' => true,
                'view' => [
                    'path' => __DIR__ . '/resources/views',
                    'twig' => [
                    'cache' => false
                    ]
                ],
				'db' => [
					'host' => '172.17.0.10',  //127.0.0.1
					'user' => 'sio',             //root
					'pass' => '0550002D',
					'dbname' => 'portefeuilleNumerique'
				]
            ]
    ];