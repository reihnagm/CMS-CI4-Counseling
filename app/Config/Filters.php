<?php 
namespace Config;

use CodeIgniter\Config\BaseConfig;

class Filters extends BaseConfig
{
	public $aliases = [
    'isLoggedIn' => \App\Filters\isLoggedIn::class,
		'csrf'     => \CodeIgniter\Filters\CSRF::class,
		'toolbar'  => \CodeIgniter\Filters\DebugToolbar::class,
		'honeypot' => \CodeIgniter\Filters\Honeypot::class,
	];

	public $globals = [
		'before' => [
			//'honeypot'
			// 'csrf',
		],
		'after'  => [
			'toolbar',
			//'honeypot'
		],
	];

	// Works on all of a particular HTTP method
	// (GET, POST, etc) as BEFORE filters only
	//     like: 'post' => ['CSRF', 'throttle'],
	public $methods = [];

	// List filter aliases and any before/after uri patterns
	// that they should run on, like:
	//    'isLoggedIn' => ['before' => ['account/*', 'profiles/*']],
  public $filters = [
		'isLoggedIn' => [
			'before' => [
				'/',
				'admin/follow-up',
				'admin/follow-up-detail',
                'admin/dashboard',
                'admin/report',
                'admin/user'
			],
			'after'  => ['admin/auth/login']
		],
	];
}
