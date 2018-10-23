<?php
declare(strict_types=1);

namespace App\Command;


use App\UseCase\ImportApartments;
use Psr\Log\LoggerInterface;
use Symfony\Component\Console\Command\Command;
use Symfony\Component\Console\Input\InputInterface;
use Symfony\Component\Console\Output\OutputInterface;

class ImportApartmentsCommand extends Command
{
    /**
     * @var LoggerInterface
     */
    private $logger;
    /**
     * @var ImportApartments
     */
    private $importUseCase;
    /**
     * @var string
     */
    private $url;

    public function __construct(
        LoggerInterface $logger,
        ImportApartments $importUseCase,
        string $url
    )
    {
        parent::__construct();
        $this->logger = $logger;
        $this->importUseCase = $importUseCase;
        $this->url = $url;
    }

    protected function configure(): void
    {
        $this->setName('app:apartments:import')
            ->setDescription('Imports apartments from given resource');
    }

    protected function execute(InputInterface $input, OutputInterface $output)
    {
        $this->logger->info('Starting import..');

        $this->importUseCase->execute($this->url);

        $this->logger->info('Import finished!');
    }
}
