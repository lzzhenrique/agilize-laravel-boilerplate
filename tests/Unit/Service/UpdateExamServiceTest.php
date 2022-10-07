<?php

namespace Tests\Unit\Service;


use App\Models\Exam;
use App\Models\Question;
use App\Models\Snapshot;
use App\Models\Subject;
use App\Repositorys\AnswerRepository;
use App\Repositorys\ExamRepository;
use App\Repositorys\QuestionRepository;
use App\Repositorys\SnapshotRepository;
use App\Repositorys\StudentRepository;
use App\Repositorys\SubjectRepository;
use App\Services\ExamService;
use App\Services\SnapshotService;
use Tests\TestCase;

class UpdateExamServiceTest extends TestCase
{
    public function testUpdateFunctionShouldReturnAArrayWithResultKeys()
    {
        // given
        $examService = $this->getExamService();

        // when
        $result = $examService->update(
            '05b6127c-bc7f-4d53-8e08-221e9cf593e7',
            $this->getStudentAnswers(),
            new \DateTime('2022-10-10 16:00:00'),
        );

        // then
        $this->assertIsArray($result);
        $this->assertArrayHasKey('Exam', $result);
        $this->assertArrayHasKey('score', $result);
    }

    public function testUpdateFunctionShouldReturnAExceptionWhenDifferenceBetweenCreatedAtAndFinishedAtIsSuperiorThanOneHour()
    {
        $this->expectException(\Exception::class);

        $examService = $this->getExamService();

        // when
         $examService->update(
            '05b6127c-bc7f-4d53-8e08-221e9cf593e7',
            $this->getStudentAnswers(),
            new \DateTime('2022-10-10 18:00:00'),
        );
    }

    private function getExamService()
    {
        $snapshotMock = $this->createMock(Snapshot::class);

        $examMock = $this->createMock(Exam::class);
        $examMock->method('getCreatedAt')->willReturn(new \DateTime('2022-10-10 15:30:00'));
        $examMock->method('getQuestionQuantity')->willReturn(3);

        $subjectRepositoryMock = $this->createMock(SubjectRepository::class);

        $examRepositoryMock = $this->createMock(ExamRepository::class);
        $examRepositoryMock->method('getById')->willReturn($examMock);

        $snapshotServiceMock = $this->createMock(SnapshotService::class);

        $snapshotRepositoryMock = $this->createMock(SnapshotRepository::class);
        $snapshotRepositoryMock->method('getScoreByExam')->willReturn(2);
        $snapshotRepositoryMock->method('getCorrectAnswersByExam')->willReturn($this->getCorrectAnswers());

        $questionRepositoryMock = $this->createMock(QuestionRepository::class);
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

    private function getStudentAnswers()
    {
        return[
            "quantos cantos um campo de futebol tem" => "true",
		    "Quantas cores a bandeira do SP tem?" => "três",
            "marca de chuteira" => "nike"
        ];
    }

    private function getCorrectAnswers()
    {
        return [
            [
                "question" => "quantos cantos um campo de futebol tem",
			    "student_answer" => "true",
			    "correctAnswer" => "quatro"
		    ],
		    [
                "question" => "Quantas cores a bandeira do SP tem?",
			    "student_answer" => "três",
			    "correctAnswer" => "três"
		   ],
            [
                "question" => "marca de chuteira",
    			"student_answer" => "nike",
	    		"correctAnswer" => "nike"
            ],
        ];
    }
}