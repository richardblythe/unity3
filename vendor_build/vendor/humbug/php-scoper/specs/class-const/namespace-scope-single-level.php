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
    'title' => 'Class constant call in a namespace',
    // Default values. If not specified will be the one used
    'prefix' => 'Humbug',
    'whitelist' => [],
    'whitelist-global-constants' => \true,
    'whitelist-global-classes' => \false,
    'whitelist-global-functions' => \true,
    'registered-classes' => [],
    'registered-functions' => [],
], 'Constant call on a class belonging to the global namespace or the current namespace' => ['payload' => <<<'PHP'
<?php

namespace X;

class Command {}

Command::MAIN_CONST;
----
<?php

namespace Humbug\X;

class Command
{
}
Command::MAIN_CONST;

PHP
], 'FQ constant call on a class belonging to the global namespace or the current namespace' => ['payload' => <<<'PHP'
<?php

namespace {
    class Command {}
}

namespace X {
    \Command::MAIN_CONST;
}
----
<?php

namespace Humbug;

class Command
{
}
namespace Humbug\X;

\Humbug\Command::MAIN_CONST;

PHP
], 'Constant call on a whitelisted class belonging to the global namespace' => ['payload' => <<<'PHP'
<?php

namespace X;

use Reflector;

Reflector::MAIN_CONST;
----
<?php

namespace Humbug\X;

use Reflector;
Reflector::MAIN_CONST;

PHP
]];
