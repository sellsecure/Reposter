<?php

$inputFile = $argv[1];
$percentage = min(100, max(0, (int) $argv[2]));

if (!file_exists($inputFile)) {
    throw new InvalidArgumentException('Invalid input file provided');
}

if (!$percentage) {
    throw new InvalidArgumentException('An integer checked percentage must be given as second parameter');
}

$xml = new SimpleXMLElement(file_get_contents($inputFile));
$classes = $xml->xpath('//class');

$totalElements = 0;
$totalCoveredElements = 0;

foreach ($classes as $class) {
    /** @var SimpleXMLElement $class */
    if (isset($class->metrics)) {
        if (isset($class->metrics['elements']) && isset($class->metrics['coveredelements'])) {
            $totalElements += (int) $class->metrics['elements'];
            $totalCoveredElements += (int) $class->metrics['coveredelements'];
        }
    }
}

$coveragePercentage = $totalElements === 0 ? 100 : ($totalCoveredElements / $totalElements) * 100;

echo "Code coverage is $coveragePercentage% - ";
if ($coveragePercentage < $percentage) {
    echo "\033[1;31mKO\033[0m (below $percentage)".PHP_EOL;
    exit(1);
}

echo "\033[1;32mOK\033[0m".PHP_EOL;
