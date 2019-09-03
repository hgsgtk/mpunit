<?php declare(strict_types=1);

require_once __DIR__ . '/vendor/autoload.php';

(2 === 1 + 1) or die("LINE: " . __LINE__);
(3.0 === 1.5 + 1.5) or die("LINE: " . __LINE__);
$date = date('Y-m-d', 4502304000);
("2112-09-13" === $date) or die("LINE: " . __LINE__);

$a = [1, 2, 3];
(1 == array_shift($a)) or die("LINE: " . __LINE__);

echo "ok" . PHP_EOL;
