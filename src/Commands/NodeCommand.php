<?php

namespace Potto\Commands;

use Symfony\Component\Filesystem\Filesystem;
use Symfony\Component\Console\Command\Command;
use Symfony\Component\Console\Input\InputOption;
use Symfony\Component\Console\Input\InputArgument;
use Symfony\Component\Console\Input\InputInterface;
use Symfony\Component\Console\Output\OutputInterface;
use Symfony\Component\Console\Exception\RuntimeException;

class NodeCommand extends Command
{
    public function configure()
    {
        $this->setName('node')
            ->setDescription('Runs an Node command')
            ->addArgument(
                'expression',
                InputArgument::IS_ARRAY,
                'Command to run',
                []
            )
            ;
    }

    public function execute(InputInterface $input, OutputInterface $output)
    {
        $cmd = $input->getArgument('expression');
        // check if docker folder exists
        $directory = getcwd().'/.docker';
        passthru('cd '. $directory .' && docker-compose run node ' . implode(' ', $cmd));
    }
}
