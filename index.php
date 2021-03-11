<?php
$minPHPVersion = '7.2';
if (phpversion() < $minPHPVersion)
{
	die("Your PHP version must be {$minPHPVersion} or higher to run CodeIgniter. Current version: " . phpversion());
}
unset($minPHPVersion);

define('FCPATH', __DIR__ . DIRECTORY_SEPARATOR);

$pathsPath = realpath(FCPATH . 'app/Config/Paths.php');

chdir(__DIR__);

require $pathsPath;
$paths = new Config\Paths();

$app = require rtrim($paths->systemDirectory, '/ ') . '/bootstrap.php';

$app->run();
