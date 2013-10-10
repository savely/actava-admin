<?php
/**
 *
 * common.php configuration file
 *
 * @author Antonio Ramirez <amigo.cobos@gmail.com>
 * @link http://www.ramirezcobos.com/
 * @link http://www.2amigos.us/
 * @copyright 2013 2amigOS! Consultation Group LLC
 * @license http://www.opensource.org/licenses/bsd-license.php New BSD License
 */
return array(
	'basePath' => realPath(__DIR__ . '/..'),
	'preload' => array('log'),
	'aliases' => array(
		//'vendor' => 'application.vendor'
        'bootstrap' => dirname(__FILE__) . '/../lib/vendor/2amigos/yiistrap',
        'yiiwheels' => dirname(__FILE__) . '/../lib/vendor/2amigos/yiiwheels',        
	),
	'import' => array(
		'application.controllers.*',
		'application.extensions.components.*',
		'application.extensions.behaviors.*',
		'application.helpers.*',
		'application.models.*',
		'application.lib.vendor.2amigos.yiistrap.helpers.*',
		'application.lib.vendor.2amigos.yiiwheels.helpers.*',
	),
	'components' => array(
/*		'db'=>array(
			'connectionString' => 'mysql:host=localhost;port=3306;dbname=ma_internet_v2',
            'username' => 'root',
            'password' => '',
            'enableProfiling' => true,
            'enableParamLogging' => true,
            'charset' => 'utf8',            
		),*/
		'errorHandler' => array(
			'errorAction' => 'site/error',
		),
		'log' => array(
			'class'  => 'CLogRouter',
			'routes' => array(
				array(
					'class'        => 'CFileLogRoute',
					'levels'       => 'error, warning',
				),
			),
		),
	),
	'params' => array(

		// php configuration
		'php.defaultCharset' => 'utf-8',
		'php.timezone'       => 'UTC',
	)
);