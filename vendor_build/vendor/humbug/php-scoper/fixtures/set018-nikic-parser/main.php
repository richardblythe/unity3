<?php

declare (strict_types=1);
namespace Unity3_Vendor;

use Unity3_Vendor\PhpParser\NodeDumper;
use Unity3_Vendor\PhpParser\ParserFactory;
require_once __DIR__ . '/vendor/autoload.php';
$code = <<<'CODE'
<?php

namespace Unity3_Vendor;

function test($foo)
{
    \var_dump($foo);
}
CODE;
$parser = (new ParserFactory())->create(ParserFactory::PREFER_PHP7);
$ast = $parser->parse($code);
$dumper = new NodeDumper();
echo $dumper->dump($ast) . "\n";
