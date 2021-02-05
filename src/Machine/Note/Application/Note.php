<?php

declare(strict_types=1);

namespace Clickedu\Machine\Note\Application;

use Clickedu\Machine\Note\Domain\StudentRepository;

final class Note {

    private $studentRepository;

    public function __construct(StudentRepository $studentRepository) {
        $this->studentRepository = $studentRepository;
    }

    public function __invoke(string $name, int $term, string $description) {
        try {
            $output = $this->studentRepository->searchNote($name, $term);
            if ($description) {
                $output = $this->studentRepository->searchRange($output);
            }

            return $output;
        } catch (\Exception $exc) {
            return $exc->getMessage();
        }
    }

}
