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
    'title' => 'Abstract class declaration',
    // Default values. If not specified will be the one used
    'prefix' => 'Humbug',
    'whitelist' => [],
    'whitelist-global-constants' => \true,
    'whitelist-global-classes' => \false,
    'whitelist-global-functions' => \true,
    'registered-classes' => [],
    'registered-functions' => [],
], 'Declaration in the global namespace' => <<<'PHP'
<?php

abstract class A {
    public function a() {}
    abstract public function b();
}
----
<?php

namespace Humbug;

abstract class A
{
    public function a()
    {
    }
    public abstract function b();
}

PHP
, 'Declaration in the global namespace with global classes whitelisted' => ['whitelist-global-classes' => \true, 'registered-classes' => [['A', 'Unity3_Vendor\\Humbug\\A']], 'payload' => <<<'PHP'
<?php

abstract class A {
    public function a() {}
    abstract public function b();
}
----
<?php

namespace Humbug;

abstract class A
{
    public function a()
    {
    }
    public abstract function b();
}
\class_alias('Humbug\\A', 'A', \false);

PHP
], 'Declaration in the global namespace with the global namespace which is namespaced whitelisted' => ['whitelist' => ['\\*'], 'payload' => <<<'PHP'
<?php

abstract class A {
    public function a() {}
    abstract public function b();
}
----
<?php

namespace {
    abstract class A
    {
        public function a()
        {
        }
        public abstract function b();
    }
}

PHP
], 'Declaration of a whitelisted class in the global namespace' => ['whitelist' => ['A'], 'registered-classes' => [['A', 'Unity3_Vendor\\Humbug\\A']], 'payload' => <<<'PHP'
<?php

abstract class A {
    public function a() {}
    abstract public function b();
}
----
<?php

namespace Humbug;

abstract class A
{
    public function a()
    {
    }
    public abstract function b();
}
\class_alias('Humbug\\A', 'A', \false);

PHP
], 'Declaration of a whitelisted class in the global namespace which is whitelisted' => ['whitelist' => ['A', '\\*'], 'registered-classes' => [['A', 'Unity3_Vendor\\Humbug\\A']], 'payload' => <<<'PHP'
<?php

abstract class A {
    public function a() {}
    abstract public function b();
}
----
<?php

namespace {
    abstract class A
    {
        public function a()
        {
        }
        public abstract function b();
    }
}

PHP
], 'Declaration in a namespace' => <<<'PHP'
<?php

namespace Foo;

abstract class A {
    public function a() {}
    abstract public function b();
}
----
<?php

namespace Humbug\Foo;

abstract class A
{
    public function a()
    {
    }
    public abstract function b();
}

PHP
, 'Declaration in a namespace with global classes whitelisted' => ['whitelist-global-classes' => \true, 'payload' => <<<'PHP'
<?php

namespace Foo;

abstract class A {
    public function a() {}
    abstract public function b();
}
----
<?php

namespace Humbug\Foo;

abstract class A
{
    public function a()
    {
    }
    public abstract function b();
}

PHP
], 'Declaration in a whitelisted namespace' => ['whitelist' => ['Foo\\*'], 'payload' => <<<'PHP'
<?php

namespace Foo;

abstract class A {
    public function a() {}
    abstract public function b();
}
----
<?php

namespace Foo;

abstract class A
{
    public function a()
    {
    }
    public abstract function b();
}

PHP
], 'Declaration of a whitelisted class in a namespace' => ['whitelist' => ['Unity3_Vendor\\Foo\\A'], 'registered-classes' => [['Unity3_Vendor\\Foo\\A', 'Unity3_Vendor\\Humbug\\Foo\\A']], 'payload' => <<<'PHP'
<?php

namespace Foo;

abstract class A {
    public function a() {}
    abstract public function b();
}
----
<?php

namespace Humbug\Foo;

abstract class A
{
    public function a()
    {
    }
    public abstract function b();
}
\class_alias('Humbug\\Foo\\A', 'Foo\\A', \false);

PHP
], 'Declaration of a namespaced class whitelisted with a pattern' => ['whitelist' => ['Foo\\A*'], 'registered-classes' => [['Unity3_Vendor\\Foo\\A', 'Unity3_Vendor\\Humbug\\Foo\\A'], ['Unity3_Vendor\\Foo\\AA', 'Unity3_Vendor\\Humbug\\Foo\\AA'], ['Unity3_Vendor\\Foo\\A\\B', 'Unity3_Vendor\\Humbug\\Foo\\A\\B']], 'payload' => <<<'PHP'
<?php

namespace Foo;

abstract class A {
    public function a() {}
}

abstract class AA {}

abstract class B {}

namespace Foo\A;

abstract class B {}

----
<?php

namespace Humbug\Foo;

abstract class A
{
    public function a()
    {
    }
}
\class_alias('Humbug\\Foo\\A', 'Foo\\A', \false);
abstract class AA
{
}
\class_alias('Humbug\\Foo\\AA', 'Foo\\AA', \false);
abstract class B
{
}
namespace Humbug\Foo\A;

abstract class B
{
}
\class_alias('Humbug\\Foo\\A\\B', 'Foo\\A\\B', \false);

PHP
], 'Declaration of a whitelisted class in a namespace with FQCN for the whitelist' => ['whitelist' => ['Unity3_Vendor\\Foo\\A'], 'registered-classes' => [['Unity3_Vendor\\Foo\\A', 'Unity3_Vendor\\Humbug\\Foo\\A']], 'payload' => <<<'PHP'
<?php

namespace Foo;

abstract class A {
    public function a() {}
    abstract public function b();
}
----
<?php

namespace Humbug\Foo;

abstract class A
{
    public function a()
    {
    }
    public abstract function b();
}
\class_alias('Humbug\\Foo\\A', 'Foo\\A', \false);

PHP
], 'Declaration of a class belonging to a whitelisted namespace' => ['whitelist' => ['\\*'], 'payload' => <<<'PHP'
<?php

namespace Foo;

abstract class A {
    public function a() {}
    abstract public function b();
}
----
<?php

namespace Foo;

abstract class A
{
    public function a()
    {
    }
    public abstract function b();
}

PHP
], 'Multiple declarations in different namespaces with whitelisted classes' => ['whitelist' => ['Unity3_Vendor\\Foo\\WA', 'Unity3_Vendor\\Bar\\WB', 'WC'], 'registered-classes' => [['Unity3_Vendor\\Foo\\WA', 'Unity3_Vendor\\Humbug\\Foo\\WA'], ['Unity3_Vendor\\Bar\\WB', 'Unity3_Vendor\\Humbug\\Bar\\WB'], ['WC', 'Unity3_Vendor\\Humbug\\WC']], 'payload' => <<<'PHP'
<?php

namespace Foo {

    abstract class A {
        public function a() {}
    }

    abstract class WA {
        public function a() {}
    }
}

namespace Bar {

    abstract class B {
        public function b() {}
    }

    abstract class WB {
        public function b() {}
    }
}

namespace {

    abstract class C {
        public function c() {}
    }

    abstract class WC {
        public function c() {}
    }
}
----
<?php

namespace Humbug\Foo;

abstract class A
{
    public function a()
    {
    }
}
abstract class WA
{
    public function a()
    {
    }
}
\class_alias('Humbug\\Foo\\WA', 'Foo\\WA', \false);
namespace Humbug\Bar;

abstract class B
{
    public function b()
    {
    }
}
abstract class WB
{
    public function b()
    {
    }
}
\class_alias('Humbug\\Bar\\WB', 'Bar\\WB', \false);
namespace Humbug;

abstract class C
{
    public function c()
    {
    }
}
abstract class WC
{
    public function c()
    {
    }
}
\class_alias('Humbug\\WC', 'WC', \false);

PHP
]];
