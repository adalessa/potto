# Potto (pot in japanese)

It's a command line tool to have local laravel php environments set it up in seconds

This tool has a a prebuild docker-compose configuration that will fit basic projects, it has an apache, php, mysql, node and a redis
service configure.

to install the package you need to install it globally using composer 
```
composer global require adalessa/potto
```

be sure to have the composer added to your PATH that will usually this may help you

```
export PATH=$PATH:$HOME/.config/composer/vendor/bin
```

Adding this line to yout .bashrc or to .zshrc will add the composer bin directory to the machine path, at least for linux and mac machines

### Command line interaction

Potto is build on top of the popular symfony console package that provides the basic interaction of the command line.

```
potto list  

Potto 0.0.1

Usage:
  command [options] [arguments]

Options:
  -h, --help            Display this help message
  -q, --quiet           Do not output any message
  -V, --version         Display this application version
      --ansi            Force ANSI output
      --no-ansi         Disable ANSI output
  -n, --no-interaction  Do not ask any interactive question
  -v|vv|vvv, --verbose  Increase the verbosity of messages: 1 for normal output, 2 for more verbose output and 3 for debug

Available commands:
  art      Runs an Artisan command
  composer Runs a composer command
  down     Down the containers | destroys the containers
  help     Displays help for a command
  init     Initialize a project
  list     Lists commands
  mysql    Connects to the mysql
  node     Runs an Node command
  ps       Shows the status of the containers
  stop     Stops the containers
  up       Starts the containers
```

## Dependencies

As this is an docker implementation have docker and docker compose installed it's a must as the current user should have rights 
to run the docker command without sudo, this can be done adding the user to the group docker.

As this is a compsoser tool you need to have installed php and composer in order to install it


## Usage

Once you have your Laravel project folder, go to that folder and run

```
potto init
```

This is the common installation that will copy the docker-compose configuration to a new .docker directory if the directory exists will not do anything

During this process you can set it different options as the php version that you want, node version, mysql version, port for the application and mysql password

```
potto init --help

Usage:
  init [options] [--] [<php>]

Arguments:
  php                        What version of php should we use [default: "7.1"]

Options:
      --node[=NODE]          Define the node version [default: "8"]
  -p, --port[=PORT]          Define the node port for the apache [default: "8000"]
      --mysql[=MYSQL]        Define the mysql version [default: "latest"]
  -u, --user[=USER]          Define the user uid [default: "1000"]
      --mysql_pw[=MYSQL_PW]  Define the mysql password [default: "root"]
  -h, --help                 Display this help message
  -q, --quiet                Do not output any message
  -V, --version              Display this application version
      --ansi                 Force ANSI output
      --no-ansi              Disable ANSI output
  -n, --no-interaction       Do not ask any interactive question
  -v|vv|vvv, --verbose       Increase the verbosity of messages: 1 for normal output, 2 for more verbose output and 3 for debug

Help:
  Initialize a project
```
this configuration will be stored in a .env file inside of the .docker

That's all you need go to the [http://localhost:8000] and start coding your app


You can change the configuration at any time, a re build will be necessary
this can be done running
```
potto up -b
```

The containers for the apache, php and the node are prepare to write the files with the uid of defined in the environment file


### Mysql
To connect to the mysql you can simple run 
```
potto mysql
```
that will promt you for the password

in your laravel confiruation you should change the DB_HOST=db

### Artisan

To run artisan command it's simple as

```
potto art
```

that will run the php artisan inside of the php container

### Composer

To run a composer command you run
```
potto composer
```

### Node
As you can imagine at this point all you need to do to install dependencies
```
potto node npm install
```

if you preffer yarn

```
potto node yarn install
```
and for the builing process

```
potto node npm run dev
```

to watch the files use the watch-poll


### Docker compose 
This also has a couple of wrapers for docker compose
ps, stop, down, up
you always can go to the .docker folder and run everything from there.

### Sharing 

you are safe to add .docker folder to your repository, there is a .gitignore file to ignore the .env file and the storage folder inside of the .docker directory


### Where is my DB data

The database information is stored in the storage folder inside of the .docker directory


### Improving

If you like this idea feel free to  contribute and improve it
