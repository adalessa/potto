<?php

namespace Potto\Commands;

use Symfony\Component\Filesystem\Filesystem;
use Symfony\Component\Console\Command\Command;
use Symfony\Component\Console\Input\InputOption;
use Symfony\Component\Console\Input\InputArgument;
use Symfony\Component\Console\Input\InputInterface;
use Symfony\Component\Console\Output\OutputInterface;
use Symfony\Component\Console\Exception\RuntimeException;

class InitializeCommand extends Command
{
    public function configure()
    {
        $this->setName('init')
            ->setDescription('Initialize a project')
            ->addArgument(
                'php',
                InputArgument::OPTIONAL,
                'What version of php should we use',
                '7.1'
            )
            ->addOption(
                'node',
                null,
                InputOption::VALUE_OPTIONAL,
                'Define the node version',
                '8'
            )
            ->addOption(
                'port',
                '-p',
                InputOption::VALUE_OPTIONAL,
                'Define the node port for the apache',
                '8000'
            )
            ->addOption(
                'mysql',
                null,
                InputOption::VALUE_OPTIONAL,
                'Define the mysql version',
                'latest'
            )
            ->addOption(
                'user',
                '-u',
                InputOption::VALUE_OPTIONAL,
                'Define the user uid',
                '1000'
            )
            ->addOption(
                'mysql_pw',
                null,
                InputOption::VALUE_OPTIONAL,
                'Define the mysql password',
                'root'
            );
    }

    public function execute(InputInterface $input, OutputInterface $output)
    {

        // check if docker folder exists
        $directory = getcwd().'/.docker';
        $this->verifyDockerDoesNotExists($directory);

        $fs = new Filesystem();
        $fs->mirror(__DIR__.'/../stubs/docker/', $directory);

        $this->setEnvironment($input, $directory);

        passthru('cd '. $directory .' && docker-compose up -d');
        $output->writeln('Docker is set it up');
    }

    protected function verifyDockerDoesNotExists($directory)
    {
        if ((is_dir($directory) || is_file($directory)) && $directory != getcwd()) {
            throw new RuntimeException('Docker is Already set it up');
        }
    }

    protected function setEnvironment(InputInterface $input, $directory)
    {
        $env = file_get_contents(__DIR__.'/../stubs/env.stub');
        $env = str_replace('DUMMY_PHP_VERSION', $input->getArgument('php'), $env);
        $env = str_replace('DUMMY_NODE_VERSION', $input->getOption('node'), $env);
        $env = str_replace('DUMMY_PORT', $input->getOption('port'), $env);
        $env = str_replace('DUMMY_MYSQL_VERSION', $input->getOption('mysql'), $env);
        $env = str_replace('DUMMY_MYSQL_PASSWORD', $input->getOption('mysql_pw'), $env);
        $env = str_replace('DUMMY_USER_UID', $input->getOption('user'), $env);

        file_put_contents($directory.'/.env', $env);
    }
}
