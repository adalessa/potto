<?php

namespace Potto;

class DockerCompose
{
    const DOCKER_FOLDER = '.docker';
    protected $projectDir;

    public function __construct()
    {
        $this->projectDir = getcwd();
    }

    public function getDirectory()
    {
        return $this->projectDir . '/'. self::DOCKER_FOLDER;
    }

    public function getProjectName()
    {
        $path = explode('/', $this->projectDir);
        return array_pop($path);
    }

    public function run(... $commands)
    {
        $cmds = array_map(function ($cmd) {
            return is_array($cmd) ? implode(' ', $cmd) : $cmd;
        }, $commands);
        $args = implode(' ', $cmds);
        passthru(
            'cd '. $this->getDirectory() .
            ' && docker-compose -p '.$this->getProjectName() .' '. $args
        );
    }
}
