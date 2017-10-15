<?php

namespace Potto\Commands;

use Symfony\Component\Filesystem\Filesystem;
use Symfony\Component\Console\Command\Command;
use Symfony\Component\Console\Input\InputOption;
use Symfony\Component\Console\Input\InputArgument;
use Symfony\Component\Console\Input\InputInterface;
use Symfony\Component\Console\Output\OutputInterface;
use Symfony\Component\Console\Exception\RuntimeException;

class UpCommand extends Command
{
    public function configure()
    {
        $this->setName('up')
            ->setDescription('Starts the containers');
    }

    public function execute(InputInterface $input, OutputInterface $output)
    {

        $directory = getcwd().'/.docker';
        passthru('cd '. $directory .' && docker-compose up -d');
    }
}
