<?php

namespace App\Container;

use Monolog\Logger;
use Monolog\Handler\SlackHandler;
use Monolog\Handler\StreamHandler;
use Monolog\Formatter\LineFormatter;
use Psr\Container\ContainerInterface;

class MonologFactory
{
    public function __invoke(ContainerInterface $container)
    {
        $dateFormat = "Y/m/d, H:i:s";
        $output = "%datetime% > %level_name% %message%";
        $formatter = new LineFormatter($output, $dateFormat, true);

        $logger = new Logger('Logs');
        $stream = new StreamHandler(__DIR__ . '/../../../../data/log/' . date('Y-m-d') . '.log');
        $slack = new SlackHandler(
            'xoxp-570616873424-571699965925-832057135490-3204db3022775a5738aeb410f917498f',
            '#exceptions',
            'robot'
        );
        $slack->setLevel(Logger::DEBUG);
        // $logger->debug('Consegui fazer essa poha..!!');
        $stream->setFormatter($formatter);
        
        $logger->pushHandler($stream);
        $logger->pushHandler($slack);
        return $logger;
    }
}
