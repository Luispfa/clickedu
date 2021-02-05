<?php

declare(strict_types=1);

namespace Clickedu\Tests\Unit\Machine\Note\Infrastructure;

use PHPUnit\Framework\TestCase;
use Clickedu\Machine\Note\Domain\StudentRepository;

class ArrayStudentRepository {

    /** @test */
    public function it_should_return_one_note() {
        $name = 'student1';
        $term = 2;
        $repository = $this->createMock(StudentRepository::class);
        $repository->method('searchNote')->with($name, $term)->willReturn(6);

        $this->assertEquals($repository->searchNote($name, $term), 6);
    }

    /** @test */
    public function it_should_return_one_range() {
        $note = 8;
        $repository = $this->createMock(StudentRepository::class);
        $repository->method('searchRange')->with($note)->willReturn('Notable');

        $this->assertEquals($repository->searchRange($note), 'Notable');
    }

}
