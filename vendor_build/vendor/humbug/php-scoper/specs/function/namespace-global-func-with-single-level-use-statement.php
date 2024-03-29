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
    'title' => 'Global function call imported with a use statement in a namespace',
    // Default values. If not specified will be the one used
    'prefix' => 'Humbug',
    'whitelist' => [],
    'whitelist-global-constants' => \true,
    'whitelist-global-classes' => \false,
    'whitelist-global-functions' => \false,
    'registered-classes' => [],
    'registered-functions' => [],
], 'Global function call imported with a use statement in a namespace' => <<<'PHP'
<?php

namespace A;

use function main;

main();
----
<?php

namespace Humbug\A;

use function Humbug\main;
main();

PHP
, 'Global FQ function call imported with a use statement in a namespace' => <<<'PHP'
<?php

namespace A;

use function main;

\main();
----
<?php

namespace Humbug\A;

use function Humbug\main;
\Humbug\main();

PHP
];
