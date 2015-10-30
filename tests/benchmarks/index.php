<?php

require __DIR__ . '/../../vendor/autoload.php';

mt_srand(time());

$benchmarkSuite = new Lavoiesl\PhpBenchmark\Benchmark;

echo 'Searching benchmarks in: ' . __DIR__ . PHP_EOL;
foreach(new FilesystemIterator(__DIR__) as $fileInfo) {
	$filename = $fileInfo->getFilename();
	if (basename(__FILE__) !== $filename) {
		echo 'Loading benchmark from: ' . $filename . PHP_EOL;
		include $filename;
	}
}

$benchmarkSuite->run();
