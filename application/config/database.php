<?php
defined('BASEPATH') or exit('No direct script access allowed');

if (PRODUCT_ENVIRONMENT == 'PROD') {
	$active_group = 'server';
} else {
	$active_group = 'local';
}

$query_builder = TRUE;

$db['local'] = array(
	'dsn'	=> '',
	'hostname' => 'localhost',
	'username' => 'root',
	'password' => 'o?V75&S4!hH^',
	'database' => 'brickpay',
	'dbdriver' => 'mysqli',
	'dbprefix' => 'tbl_',
	'pconnect' => FALSE,
	'db_debug' => (ENVIRONMENT !== 'production'),
	'cache_on' => FALSE,
	'cachedir' => '',
	'char_set' => 'utf8',
	'dbcollat' => 'utf8_general_ci',
	'swap_pre' => '',
	'encrypt' => FALSE,
	'compress' => FALSE,
	'stricton' => FALSE,
	'failover' => array(),
	'save_queries' => TRUE
);

$db['server'] = array(
	'dsn'	=> '',
	'hostname' => 'localhost',
	'username' => 'u197249689_digital_u',
	'password' => 'Kk8vIo2[',
	'database' => 'u197249689_digital_bricks',
	'dbdriver' => 'mysqli',
	'dbprefix' => 'tbl_',
	'pconnect' => FALSE,
	'db_debug' => (ENVIRONMENT !== 'production'),
	'cache_on' => FALSE,
	'cachedir' => '',
	'char_set' => 'utf8',
	'dbcollat' => 'utf8_general_ci',
	'swap_pre' => '',
	'encrypt' => FALSE,
	'compress' => FALSE,
	'stricton' => FALSE,
	'failover' => array(),
	'save_queries' => TRUE
);
