<?php

namespace Potto\Commands;

use Symfony\Component\Filesystem\Filesystem;
use Symfony\Component\Console\Command\Command;
use Symfony\Component\Console\Input\InputOption;
use Symfony\Component\Console\Input\InputArgument;
use Symfony\Component\Console\Input\InputInterface;
use Symfony\Component\Console\Output\OutputInterface;
use Symfony\Component\Console\Exception\RuntimeException;

class MysqlCommand extends Command
{
    public function configure()
    {
        $this->setName('mysql')
            ->setDescription('Connects to the mysql');
    }

    public function execute(InputInterface $input, OutputInterface $output)
    {
        // check if docker folder exists
        $directory = getcwd().'/.docker';
        
        passthru('cd '. $directory .' && docker-compose exec db mysql -p');
    }
}
