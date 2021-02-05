<?php

declare(strict_types=1);

namespace Clickedu\Machine\Note\Infrastructure;

use Clickedu\Machine\Note\Domain\StudentRepository;

class ArrayStudentRepository implements StudentRepository {

    private function alumnos() {
        return [
            [
                'name' => 'Student1',
                'notas_trimestre' => [
                    '1' => 4,
                    '2' => 6,
                    '3' => 3,
                ],
            ],
            [
                'name' => 'Student2',
                'notas_trimestre' => [
                    '1' => 10,
                    '2' => 9,
                    '3' => 8,
                ],
            ],
            [
                'name' => 'Student3',
                'notas_trimestre' => [
                    '1' => 7,
                    '2' => 6,
                    '3' => 8,
                ],
            ]
        ];
    }

    private function range() {
        return [
            [
                'nota' => 'INSUFICIENT',
                'minor_range' => 0,
                'mayor_range' => 4,
            ],
            [
                'nota' => 'SUFICIENT',
                'minor_range' => 5,
                'mayor_range' => 5,
            ],
            [
                'nota' => 'BÉ',
                'minor_range' => 6,
                'mayor_range' => 7,
            ],
            [
                'nota' => 'NOTABLE',
                'minor_range' => 8,
                'mayor_range' => 9,
            ],
            [
                'nota' => 'EXCEL.LENT ',
                'minor_range' => 10,
                'mayor_range' => 10,
            ]
        ];
    }

    public function searchNote(string $name, int $term): int {
        $index = array_search($name, array_column($this->alumnos(), 'name'));
        if ($index >= 0) {
            $alumno = $this->alumnos()[$index];
            return $alumno['notas_trimestre'][(string) $term];
        } else {
            throw new \Exception($name . ' don\'t exist');
        }
    }

    public function searchRange(int $note): string {
        $exist_row = array_values(array_filter(array_map(function($row) use ($note) {
                            if ($row['minor_range'] <= $note && $note <= $row['mayor_range']) {
                                return $row;
                            }
                        }, $this->range())));

        $row = array_shift($exist_row);

        if ($row) {
            return ucfirst(strtolower($row['nota']));
        } else {
            throw new \Exception('Note don\'t allowed');
        }
    }

}
