<?php

declare(strict_types=1);

namespace Clickedu\Machine\Note\Domain;

interface StudentRepository {

    public function searchNote(string $name, int $term): int;

    public function searchRange(int $note): string;
}
