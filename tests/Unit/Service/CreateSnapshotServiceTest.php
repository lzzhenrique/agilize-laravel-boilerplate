<?php

namespace Tests\Unit\Service;


use App\Models\Answer;
use App\Models\Exam;
use App\Models\Question;
use App\Models\Subject;
use App\Repositorys\AnswerRepository;
use App\Repositorys\QuestionRepository;
use App\Repositorys\SnapshotRepository;
use App\Services\SnapshotService;
use Doctrine\Common\Collections\ArrayCollection;
use Tests\TestCase;

class CreateSnapshotServiceTest extends TestCase
{
    public function testCreateFunctionShouldReturnAArrayWithQuestionsAndAnswers()
    {
        // given
        $snapshotService = $this->getSnapshotService();
        $examMock = $this->getExamMock();

        // when
        $result = $snapshotService->create($examMock);

        // then
        $this->assertIsArray($result);
    }

    private function getSnapshotService()
    {
        $snapshotRepositoryMock = $this->createMock(SnapshotRepository::class);

        $answerRepositoryMock = $this->createMock(AnswerRepository::class);

        $questionRepositoryMock = $this->createMock(QuestionRepository::class);
        $questionRepositoryMock->method('getAllQuestionsBySubject')->willReturn($this->getArrayQuestionsMock());

        return new SnapshotService(
            $questionRepositoryMock,
            $answerRepositoryMock,
            $snapshotRepositoryMock
        );
    }

    public function getExamMock()
    {
        $subjectMock = $this->createMock(Subject::class);

        $examMock = $this->createMock(Exam::class);
        $examMock->method('getSubject')->willReturn($subjectMock);
        $examMock->method('getQuestionQuantity')->willReturn(2);

        return $examMock;
    }

    public function getArrayQuestionsMock()
    {
        $questionMock = $this->createMock(Question::class);

        $answerMock1 = $this->createMock(Answer::class);
        $answerMock1->method('getAnswer')->willReturn('5');

        $answerMock2 = $this->createMock(Answer::class);
        $answerMock2->method('getAnswer')->willReturn('1');

        $questionMock->method('getQuestion')->willReturn('Quantas copas o Brasil ganhou?');
        $questionMock->method('getAnswers')->willReturn(new ArrayCollection([$answerMock1, $answerMock2]));

        return [$questionMock];
    }
}