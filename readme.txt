To run/test the source code, please do the following steps:

1. First, type the cli command "composer update" to get dependencies (packages) installed in the "vendor" folder.
    $ composer update

2. Change DB connection settings in the file "\src\bootstrap.php"
$capsule->addConnection([
    'driver' => 'mysql',
    'host' => 'localhost',
    'database' => 'coccoc',
    'username' => 'root',
    'password' => '',
    'charset' => 'utf8',
    'collation' => 'utf8_unicode_ci',
    'prefix' => '',
]);

3. (Optional) To be convenient, we can use the Built-in PHP web server to run the source code by using the cli command:
    $ php -S localhost:80 (or any port other than 80)
    Example: C:\workspace\php\coccoc>php -S localhost:8080

4. Type the below URLs in order in the Browser to start testing:
    (1) http://localhost (or http://localhost/index.html)       => To create DB and click banner
    (2) http://localhost/backoffice.php                         => To check the result of hit statistics

5. Run PHPUnit test by executing the following command:
    $ vendor\bin\phpunit tests
    Example: C:\workspace\php\coccoc>vendor\bin\phpunit tests




