<?php

namespace App\Command;

use Symfony\Component\Console\Command\Command;
use Symfony\Component\Console\Input\InputInterface;
use Symfony\Component\Console\Output\OutputInterface;

class CsvCommand extends Command
{
    protected static $defaultName = 'app:export-csv';

    protected function execute(InputInterface $input, OutputInterface $output)
    {
        exportCSV();
        
        return Command::SUCCESS;
    }
}