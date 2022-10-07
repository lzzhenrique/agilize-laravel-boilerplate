<?php

namespace Tests\Unit\Service;


use App\Models\Question;
use App\Models\Snapshot;
use App\Models\Subject;
use App\Repositorys\ExamRepository;
use App\Repositorys\QuestionRepository;
use App\Repositorys\SnapshotRepository;
use App\Repositorys\StudentRepository;
use App\Repositorys\SubjectRepository;
use App\Services\ExamService;
use App\Services\SnapshotService;
use Tests\TestCase;

class CreateExamServiceTest extends TestCase
{
    public function testCreateFunctionShouldReturnAArrayWithExamKeys()
    {
        // given
        $examService = $this->getExamService();

        // when
        $result = $examService->create(
            '05b6127c-bc7f-4d53-8e08-221e9cf593e7',
            'e913e8f0-bff2-4ec1-b15a-80568e430147',
            9
        );

        // then
        $this->assertIsArray($result);
        $this->assertArrayHasKey('exam', $result);
        $this->assertArrayHasKey('student', $result);
        $this->assertArrayHasKey('subject', $result);
        $this->assertArrayHasKey('questionsAndAnswers', $result);
        $this->assertArrayHasKey('startedAt', $result);
    }

    public function testCreateFunctionShouldReturnAExceptionWhenQuestionQuantityIsGreatherThanStoredQuestions()
    {
        $this->expectException(\Exception::class);

        $examService = $this->getExamService();

        $examService->create(
            '05b6127c-bc7f-4d53-8e08-221e9cf593e7',
            'e913e8f0-bff2-4ec1-b15a-80568e430147',
            200000
        );
    }

    public function testCreateFunctionShouldReturnAExceptionWhenStudentIdIsEmpty()
    {
        $this->expectException(\Exception::class);

        $examService = $this->getExamService();

        $examService->create(
            '',
            'e913e8f0-bff2-4ec1-b15a-80568e430147',
            200000
        );
    }

    public function testCreateFunctionShouldReturnAExceptionWhenSubjectIdIsEmpty()
    {
        $this->expectException(\Exception::class);

        $examService = $this->getExamService();

        $examService->create(
            'e913e8f0-bff2-4ec1-b15a-80568e430147',
            '',
            200000
        );
    }

    public function testCreateFunctionShouldReturnAExceptionWhenQuestionQuantityIsEmpty()
    {
        $this->expectException(\Exception::class);

        $examService = $this->getExamService();

        $examService->create(
            'e913e8f0-bff2-4ec1-b15a-80568e430147',
            'e913e8f0-bff2-4ec1-b15a-80568e430141',
            ''
        );
    }

    public function testCreateFunctionShouldReturnAExceptionWhenQuestionQuantityIsLesserOrEqualAZero()
    {
        $this->expectException(\Exception::class);

        $examService = $this->getExamService();

        $examService->create(
            'e913e8f0-bff2-4ec1-b15a-80568e430147',
            'e913e8f0-bff2-4ec1-b15a-80568e430141',
            0
        );
    }

    private function getExamService()
    {
        $questionMock = $this->createMock(Question::class);
        $snapshotMock = $this->createMock(Snapshot::class);
        $subjectMock = $this->createMock(Subject::class);

        $subjectRepositoryMock = $this->createMock(SubjectRepository::class);
        $subjectRepositoryMock->method('getById')->willReturn($subjectMock);

        $examRepositoryMock = $this->createMock(ExamRepository::class);

        $snapshotServiceMock = $this->createMock(SnapshotService::class);
        $snapshotServiceMock->method('create')->willReturn([$snapshotMock, $snapshotMock, $snapshotMock]);

        $snapshotRepositoryMock = $this->createMock(SnapshotRepository::class);

        $questionRepositoryMock = $this->createMock(QuestionRepository::class);
        $questionRepositoryMock->method('countQuestionsBySubject')->willReturn(10);

        $studentRepositoryMock = $this->createMock(StudentRepository::class);


         return new ExamService(
            $subjectRepositoryMock,
            $examRepositoryMock,
            $studentRepositoryMock,
            $questionRepositoryMock,
            $snapshotServiceMock,
            $snapshotRepositoryMock
        );
    }
}