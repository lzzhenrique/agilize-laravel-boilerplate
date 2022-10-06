<?php

namespace Tests\Unit\Service;


use App\Models\Exam;
use App\Models\Question;
use App\Models\Snapshot;
use App\Repositorys\AnswerRepository;
use App\Repositorys\ExamRepository;
use App\Repositorys\QuestionRepository;
use App\Repositorys\SnapshotRepository;
use App\Repositorys\StudentRepository;
use App\Repositorys\SubjectRepository;
use App\Services\ExamService;
use App\Services\SnapshotService;
use Tests\TestCase;

class ExamServiceTest extends TestCase
{
    public function testCreateFunctionShouldReturnAExam()
    {
        // given
        $questionMock = $this->createMock(Question::class);
        $snapshotMock = $this->createMock(Snapshot::class);


        $subjectRepositoryMock = $this->createMock(SubjectRepository::class);
        $examRepositoryMock = $this->createMock(ExamRepository::class);

        $snapshotServiceMock = $this->createMock(SnapshotService::class);
        $snapshotServiceMock->method('create')->willReturn([$snapshotMock, $snapshotMock, $snapshotMock, $snapshotMock]);

        $snapshotRepositoryMock = $this->createMock(SnapshotRepository::class);

        $questionRepositoryMock = $this->createMock(QuestionRepository::class);
        $questionRepositoryMock->method('countQuestionsBySubject')->willReturn(10);

        $studentRepositoryMock = $this->createMock(StudentRepository::class);


        $examService = new ExamService(
            $subjectRepositoryMock,
            $examRepositoryMock,
            $studentRepositoryMock,
            $questionRepositoryMock,
            $snapshotServiceMock,
            $snapshotRepositoryMock
        );

        // when
        $result = $examService->create(
            '05b6127c-bc7f-4d53-8e08-221e9cf593e7',
            'e913e8f0-bff2-4ec1-b15a-80568e430147',
            9
        );

        // then
        $this->assertInstanceOf(Exam::class, $result);
    }
}