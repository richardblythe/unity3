<?php

declare (strict_types=1);
namespace Unity3_Vendor;

use Unity3_Vendor\PhpParser\NodeDumper;
use Unity3_Vendor\PhpParser\ParserFactory;
use Unity3_Vendor\Symfony\Component\Console\Application;
use Unity3_Vendor\Symfony\Component\Console\Command\Command;
use Unity3_Vendor\Symfony\Component\Console\Input\InputInterface;
use Unity3_Vendor\Symfony\Component\Console\Output\OutputInterface;
require_once __DIR__ . '/vendor/autoload.php';
class HelloWorldCommand extends Command
{
    protected function configure()
    {
        $this->setName('hello:world')->setDescription('Outputs \'Hello World\'');
    }
    protected function execute(InputInterface $input, OutputInterface $output)
    {
        $output->writeln('Hello world!');
    }
}
\class_alias('Unity3_Vendor\\HelloWorldCommand', 'HelloWorldCommand', \false);
$command = new HelloWorldCommand();
$application = new Application();
$application->add($command);
$application->setDefaultCommand($command->getName());
$application->run();
