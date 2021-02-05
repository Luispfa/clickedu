<?php

namespace Clickedu\Console;

use Symfony\Component\Console\Command\Command;
use Symfony\Component\Console\Input\InputArgument;
use Symfony\Component\Console\Input\InputInterface;
use Symfony\Component\Console\Input\InputOption;
use Symfony\Component\Console\Output\OutputInterface;
use Clickedu\Machine\Note\Application\Note;
use Clickedu\Machine\Note\Infrastructure\ArrayStudentRepository;

class MachineCommand extends Command {

    protected static $defaultName = 'app:grades';

    protected function configure() {
        $this->addArgument(
                'name',
                InputArgument::REQUIRED,
                'nom de l’alumne'
        );

        $this->addArgument(
                'term',
                InputArgument::REQUIRED,
                'avaluació de la que volem obtenir l’avaluació '
        );

        $this->addOption(
                'description',
                'd',
                InputOption::VALUE_NONE,
                $description = 'indicarà que retornarem la nota en descriptiu (insuficient, notable, excel·lent) en funció del rang de notes de la taula 2. '
        );
    }

    protected function execute(InputInterface $input, OutputInterface $output) {
        $name = ucfirst(strtolower($input->getArgument('name')));
        $term = $input->getArgument('term');
        $description = $input->getOption('description');

        try {
            $note = new Note(new ArrayStudentRepository());
            $output->writeln($note($name, $term, $description));
        } catch (\Exception $exc) {
            $output->writeln($exc->getMessage());
        }
    }

}
