<?php

declare(strict_types=1);

namespace App;

use App\Container\JMSFactory;
use App\Container\MonologFactory;
use App\Container\ValidationFactory;
use App\Util\Serialize\SerializeUtil;
use App\Util\ReadArchive\ReadArchiveSQL;
use App\Util\Converter\ConverterIdCnpjCpf;
use App\Util\ValidationCnpjCpf\ValidationCnpjCpf;
use App\Util\Validation\ValidationService;
use Symfony\Component\Validator\Validation;
use App\Util\Serialize\SerializeUtilFactory;
use App\Util\ReadArchive\ReadArchiveSQLFactory;
use App\Util\Converter\ConverterIdCnpjCpfFactory;
use App\Util\ValidationCnpjCpf\ValidationCnpjCpfFactory;
use App\Util\Validation\ValidationServiceFactory;

/**
 * The configuration provider for the App module
 *
 * @see https://docs.zendframework.com/zend-component-installer/
 */
class ConfigProvider
{
    /**
     * Returns the configuration array
     *
     * To add a bit of a structure, each section is defined in a separate
     * method which returns an array with its configuration.
     *
     */
    public function __invoke(): array
    {
        return [
            'dependencies' => $this->getDependencies(),
            'templates'    => $this->getTemplates(),
        ];
    }

    /**
     * Returns the container dependencies
     */
    public function getDependencies(): array
    {
        return [
            'invokables' => [
                Handler\PingHandler::class => Handler\PingHandler::class,
            ],
            'factories'  => [
                Handler\HomePageHandler::class => Handler\HomePageHandlerFactory::class,
                'serializer' => JMSFactory::class,
                MonologFactory::class => MonologFactory::class,
                SerializeUtil::class => SerializeUtilFactory::class,
                ValidationService::class => ValidationServiceFactory::class,
                Validation::class => ValidationFactory::class,
                ReadArchiveSQL::class => ReadArchiveSQLFactory::class,

                #Util converter
                ConverterIdCnpjCpf::class => ConverterIdCnpjCpfFactory::class,
                ValidationCnpjCpf::class => ValidationCnpjCpfFactory::class,
            ],
        ];
    }

    /**
     * Returns the templates configuration
     */
    public function getTemplates(): array
    {
        return [
            'paths' => [
                'app'    => [__DIR__ . '/../templates/app'],
                'error'  => [__DIR__ . '/../templates/error'],
                'layout' => [__DIR__ . '/../templates/layout'],
            ],
        ];
    }
}
