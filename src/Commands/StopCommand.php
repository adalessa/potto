<?php

namespace Potto\Commands;

use Potto\DockerCompose;
use Symfony\Component\Filesystem\Filesystem;
use Symfony\Component\Console\Command\Command;
use Symfony\Component\Console\Input\InputOption;
use Symfony\Component\Console\Input\InputArgument;
use Symfony\Component\Console\Input\InputInterface;
use Symfony\Component\Console\Output\OutputInterface;
use Symfony\Component\Console\Exception\RuntimeException;

class StopCommand extends Command
{
    public function configure()
    {
        $this->setName('stop')
            ->setDescription('Stops the containers');
    }

    public function execute(InputInterface $input, OutputInterface $output)
    {
        (new DockerCompose())->run('stop');
    }
}
