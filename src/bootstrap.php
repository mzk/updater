<?php

declare(strict_types=1);

namespace Updater;

use Nette;
use Nette\CommandLine\Parser as CommandLine;


if (@!include __DIR__ . '/../vendor/autoload.php') {
	echo('Install packages using `composer update`');
	exit(1);
}

set_exception_handler(function ($e) {
	echo "Error: {$e->getMessage()}\n";
	echo $e;
	die(2);
});

set_error_handler(function ($severity, $message, $file, $line) {
	if (($severity & error_reporting()) === $severity) {
		throw new \ErrorException($message, 0, $severity, $file, $line);
	}
	return FALSE;
});


echo '
Nette Updater v0.1
------------------
';

$cmd = new CommandLine(<<<XX
Usage:
    updater [options] <directory>

Options:
    -i | --ignore <mask>  Directories to ignore
    -f | --fix            Fixes files


XX
, [
	'path' => [CommandLine::REALPATH => TRUE],
	'--ignore' => [CommandLine::REPEATABLE => TRUE],
]);

if ($cmd->isEmpty()) {
	$cmd->help();
	exit;
}

$options = $cmd->parse();

$finder = Nette\Utils\Finder::findFiles('*.php')
	->from($options['path'])
	->exclude('.git', ...$options['--ignore']);

$collector = new Collector;
$classes = $collector->collect($finder);

$analyzer = new Analyzer;
$analyzer->analyze($classes, !$options['--fix']);
