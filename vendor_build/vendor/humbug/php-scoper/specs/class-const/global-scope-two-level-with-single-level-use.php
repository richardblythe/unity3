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
    'title' => 'Class constant call of a namespaced class imported with a use statement in the global scope',
    // Default values. If not specified will be the one used
    'prefix' => 'Humbug',
    'whitelist' => [],
    'whitelist-global-constants' => \true,
    'whitelist-global-classes' => \false,
    'whitelist-global-functions' => \true,
    'registered-classes' => [],
    'registered-functions' => [],
], 'Constant call on a namespaced class partially imported with a use statement' => ['payload' => <<<'PHP'
<?php

namespace {
    class Foo {}
}

namespace Foo {
    class Bar {}
}

namespace {
    use Foo;
    
    Foo\Bar::MAIN_CONST;
}
----
<?php

namespace Humbug;

class Foo
{
}
namespace Humbug\Foo;

class Bar
{
}
namespace Humbug;

use Humbug\Foo;
Foo\Bar::MAIN_CONST;

PHP
], 'Constant call on a namespaced class imported with a use statement' => ['payload' => <<<'PHP'
<?php

namespace Foo {
    class Bar {}
}

namespace Foo\Bar {
    class X {}
}

namespace {
    use Foo\Bar;
    
    Bar\X::MAIN_CONST;
}
----
<?php

namespace Humbug\Foo;

class Bar
{
}
namespace Humbug\Foo\Bar;

class X
{
}
namespace Humbug;

use Humbug\Foo\Bar;
Bar\X::MAIN_CONST;

PHP
], 'FQ constant call on a namespaced class imported with a use statement' => ['payload' => <<<'PHP'
<?php

namespace {
    class Foo {}
}

namespace Foo {
    class Bar {}
}

namespace {
    use Foo;
    
    \Foo\Bar::MAIN_CONST;
}
----
<?php

namespace Humbug;

class Foo
{
}
namespace Humbug\Foo;

class Bar
{
}
namespace Humbug;

use Humbug\Foo;
\Humbug\Foo\Bar::MAIN_CONST;

PHP
], 'FQ Constant call on a whitelisted namespaced class partially imported with a use statement' => ['whitelist' => ['Unity3_Vendor\\Foo\\Bar'], 'registered-classes' => [['Unity3_Vendor\\Foo\\Bar', 'Unity3_Vendor\\Humbug\\Foo\\Bar']], 'payload' => <<<'PHP'
<?php

namespace {
    class Foo {}
}

namespace Foo {
    class Bar {}
}

namespace {
    use Foo;
    
    Foo\Bar::MAIN_CONST;
}
----
<?php

namespace Humbug;

class Foo
{
}
namespace Humbug\Foo;

class Bar
{
}
\class_alias('Humbug\\Foo\\Bar', 'Foo\\Bar', \false);
namespace Humbug;

use Humbug\Foo;
Foo\Bar::MAIN_CONST;

PHP
], 'FQ constant call on a whitelisted namespaced class imported with a use statement' => ['whitelist' => ['Unity3_Vendor\\Foo\\Bar'], 'registered-classes' => [['Unity3_Vendor\\Foo\\Bar', 'Unity3_Vendor\\Humbug\\Foo\\Bar']], 'payload' => <<<'PHP'
<?php

namespace {
    class Foo {}
}

namespace Foo {
    class Bar {}
}

namespace {
    use Foo;
    
    \Foo\Bar::MAIN_CONST;
}
----
<?php

namespace Humbug;

class Foo
{
}
namespace Humbug\Foo;

class Bar
{
}
\class_alias('Humbug\\Foo\\Bar', 'Foo\\Bar', \false);
namespace Humbug;

use Humbug\Foo;
\Humbug\Foo\Bar::MAIN_CONST;

PHP
]];
