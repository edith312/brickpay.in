<?php
defined('BASEPATH') or exit('No direct script access allowed');

$autoload['packages'] = array();

$autoload['libraries'] = array('email', 'session', 'database', 'cart', 'table', 'upload', 'user_agent', 'form_validation', 'encrypt');

$autoload['drivers'] = array();

// mail_helper, email_helper, details
$autoload['helper'] = array('url', 'common_helper', 'form', 'html', 'date', 'security');

$autoload['config'] = array();

$autoload['language'] = array();

$autoload['model'] = array('Login_model', 'Dashboard_model', 'CommonModal', 'CompanyModal', 'FreelancerModal', 'Payment_model', 'Company_model', 'User_model', 'Project_model');

// Shiv Web Developer