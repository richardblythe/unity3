<?php

declare (strict_types=1);
namespace Unity3_Vendor;

use Unity3_Vendor\Symfony\Component\DependencyInjection\ContainerBuilder;
use Unity3_Vendor\Symfony\Component\DependencyInjection\Reference;
require_once __DIR__ . '/vendor/autoload.php';
interface Salute
{
    public function salute() : string;
}
\class_alias('Unity3_Vendor\\Salute', 'Salute', \false);
class Foo implements Salute
{
    private $bar;
    public function __construct(Bar $bar)
    {
        $this->bar = $bar;
    }
    public function salute() : string
    {
        return $this->bar->salute();
    }
}
\class_alias('Unity3_Vendor\\Foo', 'Foo', \false);
class Bar implements Salute
{
    public function salute() : string
    {
        return "Hello world!";
    }
}
\class_alias('Unity3_Vendor\\Bar', 'Bar', \false);
$container = new ContainerBuilder();
$container->register(Foo::class, Foo::class)->addArgument(new Reference(Bar::class))->setPublic(\true);
$container->register(Bar::class, Bar::class);
$container->compile();
echo $container->get(Foo::class)->salute() . \PHP_EOL;
