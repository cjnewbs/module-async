<?php

declare(strict_types=1);

namespace Newbury\Async\Console;

use Symfony\Component\Console\Command\Command;
use Symfony\Component\Console\Output\OutputInterface;
use Symfony\Component\Console\Input\InputInterface;
use Symfony\Component\Console\Input\InputArgument;
use Magento\Framework\App\ObjectManager;
use Psr\Log\LoggerInterface;

/**
 * Class Runner
 * @package Newbury\Async\Console
 * @author Craig Newbury <craig@newbury.me>
 */
class Runner extends Command
{
    /**
     * @var ObjectManager
     */
    protected $objectManager;

    /**
     * @var LoggerInterface
     */
    protected $logger;

    /**
     * Runner constructor.
     * @param ObjectManager $objectManager
     * @param LoggerInterface $logger
     * @param string|null $name
     */
    public function __construct(
        ObjectManager $objectManager,
        LoggerInterface $logger,
        string $name = null
    ) {
        $this->objectManager = $objectManager;
        $this->logger = $logger;
        parent::__construct($name);
    }

    /**
     * Configure the command
     */
    protected function configure()
    {
        $this->setName('newbury:async:runner')->setDescription('Runs Async Task.');
        $this->addArgument('class');
        $this->addArgument('method');
        $this->addArgument(
            'args',
            InputArgument::IS_ARRAY
        );
    }

    /**
     * @param InputInterface $input
     * @param OutputInterface $output
     * @return int|void|null
     */
    protected function execute(InputInterface $input, OutputInterface $output)
    {
        $class = $input->getArgument('class');
        $method = $input->getArgument('method');
        $args = $input->getArgument('args');

        $instance = $this->objectManager->create($class);

        try {
            $instance->$method(...$args);
        } catch (\Exception $e) {
            $this->logger->error(
                __("Error during async execution of $class::$method"),
                $e->getTrace()
            );
        }
    }
}
