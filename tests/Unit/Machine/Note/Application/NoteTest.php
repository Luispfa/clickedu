<?php

declare(strict_types=1);

namespace Clickedu\Tests\Unit\Machine\Note\Application;

use PHPUnit\Framework\TestCase;
use Clickedu\Machine\Note\Domain\StudentRepository;

final class NoteTest extends TestCase {

    /** @test */
    public function it_should_return_one_note() {
        $name = 'student1';
        $term = 2;
        $description = null;

        $repository = $this->createMock(StudentRepository::class);
        
        $repository->method('searchNote')->with($name, $term)->willReturn(6);
        $output = $repository->searchNote($name, $term);

        if ($description) {
            $repository->method('searchRange')->with($name, $term)->willReturn(6);
            $output = $this->studentRepository->searchRange($output);
        }

        $this->assertIsInt($output);
    }
    
    /** @test */
    public function it_should_return_one_range() {
        $name = 'student2';
        $term = 3;
        $description = 'description';

        $repository = $this->createMock(StudentRepository::class);
        
        $repository->method('searchNote')->with($name, $term)->willReturn(6);
        $output = $repository->searchNote($name, $term);

        if ($description) {
            $repository->method('searchRange')->with($output)->willReturn('Notable');
            $output = $repository->searchRange($output);
        }

        $this->assertStringContainsString($output, 'Notable');
    }

}
