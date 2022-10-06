<?php

namespace Tests\Unit\Service;

use App\Models\Subject;
use App\Repositorys\SubjectRepository;
use App\Services\SubjectService;
use PHPUnit\Framework\TestCase;

class CreateSubjectServiceTest extends TestCase
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
        $subjectRepositoryMock = $this->createMock(SubjectRepository::class);
        $subjectService = new SubjectService($subjectRepositoryMock);

        // when
        $subjectService->create(null);
    }

    public function testCreateFunctionShouldReturnAExceptionIfSubjectHasLessThanThreeCaracters()
    {
        $this->expectException(\Exception::class);

        // given
        $subjectRepositoryMock = $this->createMock(SubjectRepository::class);
        $subjectService = new SubjectService($subjectRepositoryMock);

        // when
        $subjectService->create('ob');
    }
}
