 
<?php

use Symfony\Bundle\FrameworkBundle\Console\Application;
use Symfony\Component\Console\Input\ArgvInput;
use Symfony\Component\Debug\Debug;

set_time_limit(0);

require __DIR__.'/../vendor/autoload.php';

 
$kernel = new AppKernel($env, $debug);
die("yes");
 try {

 
            $application = new Application($kernel);


            $application->setAutoExit(false);


            $input = new ArrayInput(array("command" => "cache:warmup", "--env" => "prod", "--no-debug" => ""));


            $output = new BufferedOutput();


            $retval = $application->run($input, $output);

            if (!$retval) {
                echo $output->fetch();
            } else {
                return "Command was not successful.\n";
            }


 } catch (\Exception $exception) {

  echo $output->fetch();

 }
 
