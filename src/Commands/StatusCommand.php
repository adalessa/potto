<?php

namespace Potto\Commands;

use Symfony\Component\Filesystem\Filesystem;
use Symfony\Component\Console\Command\Command;
use Symfony\Component\Console\Input\InputOption;
use Symfony\Component\Console\Input\InputArgument;
use Symfony\Component\Console\Input\InputInterface;
use Symfony\Component\Console\Output\OutputInterface;
use Symfony\Component\Console\Exception\RuntimeException;

class StatusCommand extends Command
{
    public function configure()
    {
        $this->setName('ps')
            ->setDescription('Shows the status of the containers');
    }

    public function execute(InputInterface $input, OutputInterface $output)
    {

        // check if docker folder exists
        $directory = getcwd().'/.docker';
        passthru('cd '. $directory .' && docker-compose ps');
    }
}
