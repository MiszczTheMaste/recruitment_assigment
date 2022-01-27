<?php

namespace App\Command;

use App\Product\Controller\AddProductAction;
use Symfony\Component\Console\Command\Command;
use Symfony\Component\Console\Input\InputInterface;
use Symfony\Component\Console\Output\OutputInterface;
use Symfony\Component\Console\Input\InputArgument;
use Symfony\Component\Filesystem\Filesystem;

class InsertCSV extends Command
{
    protected static $defaultName = 'app:insert';

    private AddProductAction $addProductController;

    private string $fileDirectory;

    public function __construct(AddProductAction $addProductController, string $fileDirectory)
    {
        parent::__construct();
        $this->addProductController = $addProductController;
        $this->fileDirectory = $fileDirectory;
    }

    protected function configure(): void
    {
        $this->addArgument('fileName', InputArgument::REQUIRED, 'File name');
    }

    protected function execute(InputInterface $input, OutputInterface $output): int
    {
        if ($this->addProductController->addProduct($input->getArgument('fileName'))) {
            echo "File imported succesfuly";
            $filesystem = new Filesystem();
            $filesystem->remove($this->fileDirectory . "/" . $input->getArgument('fileName'));
            return Command::SUCCESS;
        } else {
            echo "Error occured during executing command";
            return Command::FAILURE;
        }
    }
}
