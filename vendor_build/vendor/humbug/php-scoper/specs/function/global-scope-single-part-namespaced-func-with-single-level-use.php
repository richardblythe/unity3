<?php

declare (strict_types=1);
namespace Unity3_Vendor;

/*
 * This file is part of the humbug/php-scoper package.
 *
 * Copyright (c) 2017 Théo FIDRY <theo.fidry@gmail.com>,
 *                    Pádraic Brady <padraic.brady@gmail.com>
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */
return ['meta' => [
    'title' => 'Namespaced function call imported with a use statement in the global scope',
    // Default values. If not specified will be the one used
    'prefix' => 'Humbug',
    'whitelist' => [],
    'whitelist-global-constants' => \true,
    'whitelist-global-classes' => \false,
    'whitelist-global-functions' => \true,
    'registered-classes' => [],
    'registered-functions' => [],
], 'Namespaced function call imported with a partial use statement in the global scope' => <<<'PHP'
<?php

class Foo {}

use Foo;

Foo\main();
----
<?php

namespace Humbug;

class Foo
{
}
use Humbug\Foo;
Foo\main();

PHP
, 'FQ namespaced function call imported with a partial use statement in the global scope' => <<<'PHP'
<?php

class Foo {}

use Foo;

\Foo\main();
----
<?php

namespace Humbug;

class Foo
{
}
use Humbug\Foo;
\Humbug\Foo\main();

PHP
, 'Whitelisted namespaced function call imported with a partial use statement in the global scope' => ['whitelist' => ['Unity3_Vendor\\Foo\\main'], 'registered-functions' => [['Unity3_Vendor\\Foo\\main', 'Unity3_Vendor\\Humbug\\Foo\\main']], 'payload' => <<<'PHP'
<?php

namespace {
    class Foo {}
}

namespace Foo {
    function main() {}
}

namespace {
    use Foo;
    
    Foo\main();
}
----
<?php

namespace Humbug;

class Foo
{
}
namespace Humbug\Foo;

function main()
{
}
namespace Humbug;

use Humbug\Foo;
Foo\main();

PHP
]];
