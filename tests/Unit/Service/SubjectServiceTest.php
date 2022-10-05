<?php

namespace Tests\Unit;

use App\Models\Subject;
use App\Repositorys\SubjectRepository;
use App\Services\SubjectService;
use PHPUnit\Framework\TestCase;

class SubjectServiceTest extends TestCase
{
    public function testCreateFunctionShouldReturnASubject()
    {
        // given
        $subjectMock = $this->createMock(Subject::class);

        $subjectRepositoryMock = $this->createMock(SubjectRepository::class);
        $subjectRepositoryMock->method('create')->willReturn($subjectMock);

        $subjectService = new SubjectService($subjectRepositoryMock);

        // when
        $result = $subjectService->create('Matematica');

        // then
        $this->assertInstanceOf(Subject::class, $result);
    }

    public function testCreateFunctionShouldReturnAExceptionIfSubjectIsEmpty()
    {
        $this->expectException(\Exception::class);

        // given
        $subjectMock = $this->createMock(Subject::class);

        $subjectRepositoryMock = $this->createMock(SubjectRepository::class);
        $subjectRepositoryMock->method('create')->willReturn($subjectMock);

        $subjectService = new SubjectService($subjectRepositoryMock);

        // when
        $subjectService->create(null);
    }

    public function testCreateFunctionShouldReturnAExceptionIfSubjectIsLesserThanThreeCaracters()
    {
        $this->expectException(\Exception::class);

        // given
        $subjectMock = $this->createMock(Subject::class);

        $subjectRepositoryMock = $this->createMock(SubjectRepository::class);
        $subjectRepositoryMock->method('create')->willReturn($subjectMock);

        $subjectService = new SubjectService($subjectRepositoryMock);

        // when
        $subjectService->create('aa');
    }

}
