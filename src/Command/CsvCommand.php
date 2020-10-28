<?php

namespace App\Command;

use App\Controller\QAController;
use Symfony\Component\Console\Command\Command;
use Symfony\Component\Console\Input\InputInterface;
use Symfony\Component\Console\Output\OutputInterface;

class CsvCommand extends Command
{
    protected static $defaultName = 'app:export-csv';

    protected function execute(InputInterface $input, OutputInterface $output)
    {
        $controller = new QAController();
        $controller->exportCSV();
        
        return Command::SUCCESS;
    }
}