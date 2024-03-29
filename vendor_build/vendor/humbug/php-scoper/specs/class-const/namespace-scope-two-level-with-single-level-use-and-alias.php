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
    'title' => 'Class constant call of a namespaced class imported with an aliased use statement in a namespace',
    // Default values. If not specified will be the one used
    'prefix' => 'Humbug',
    'whitelist' => [],
    'whitelist-global-constants' => \true,
    'whitelist-global-classes' => \false,
    'whitelist-global-functions' => \true,
    'registered-classes' => [],
    'registered-functions' => [],
], 'Constant call on a namespaced class partially imported with an aliased use statement' => ['payload' => <<<'PHP'
<?php

namespace {
    class Foo {}
}

namespace Foo {
    class Bar {}
}

namespace A {
    use Foo as X;
    
    X\Bar::MAIN_CONST;
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
namespace Humbug\A;

use Humbug\Foo as X;
X\Bar::MAIN_CONST;

PHP
], 'Constant call on a namespaced class imported with an aliased use statement' => ['payload' => <<<'PHP'
<?php

namespace Foo {
    class Bar {}
}

namespace A {
    use Foo\Bar as X;
    
    X::MAIN_CONST;
}
----
<?php

namespace Humbug\Foo;

class Bar
{
}
namespace Humbug\A;

use Humbug\Foo\Bar as X;
X::MAIN_CONST;

PHP
], 'FQ constant call on a namespaced class imported with an aliased use statement' => ['payload' => <<<'PHP'
<?php

namespace {
    class Foo {}
}

namespace X {
    class Bar {}
}

namespace A {
    use Foo as X;
    
    \X\Bar::MAIN_CONST;
}
----
<?php

namespace Humbug;

class Foo
{
}
namespace Humbug\X;

class Bar
{
}
namespace Humbug\A;

use Humbug\Foo as X;
\Humbug\X\Bar::MAIN_CONST;

PHP
], 'FQ Constant call on a whitelisted namespaced class partially imported with an aliased use statement' => ['whitelist' => ['Unity3_Vendor\\Foo\\Bar'], 'registered-classes' => [['Unity3_Vendor\\Foo\\Bar', 'Unity3_Vendor\\Humbug\\Foo\\Bar']], 'payload' => <<<'PHP'
<?php

namespace {
    class Foo {}
}

namespace Foo {
    class Bar {}
}

namespace A {
    use Foo as X;
    
    X\Bar::MAIN_CONST;
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
namespace Humbug\A;

use Humbug\Foo as X;
X\Bar::MAIN_CONST;

PHP
]];
