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
    'title' => 'Global constant imported with a use statement used in a namespace',
    // Default values. If not specified will be the one used
    'prefix' => 'Humbug',
    'whitelist' => [],
    'whitelist-global-constants' => \false,
    'whitelist-global-classes' => \false,
    'whitelist-global-functions' => \true,
    'registered-classes' => [],
    'registered-functions' => [],
], 'Constant call imported with a use statement' => <<<'PHP'
<?php

namespace A;

use const DUMMY_CONST;

DUMMY_CONST;
----
<?php

namespace Humbug\A;

use const Humbug\DUMMY_CONST;
DUMMY_CONST;

PHP
, 'FQ constant call imported with a use statement' => <<<'PHP'
<?php

namespace A;

use const DUMMY_CONST;

\DUMMY_CONST;
----
<?php

namespace Humbug\A;

use const Humbug\DUMMY_CONST;
\Humbug\DUMMY_CONST;

PHP
, 'Whitelisted FQ constant call imported with a use statement' => ['whitelist' => ['DUMMY_CONST'], 'payload' => <<<'PHP'
<?php

namespace A;

use const DUMMY_CONST;

\DUMMY_CONST;
----
<?php

namespace Humbug\A;

use const DUMMY_CONST;
\DUMMY_CONST;

PHP
]];
