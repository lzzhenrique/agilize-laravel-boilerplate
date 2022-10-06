<?php

namespace Tests\Unit\Service;


use App\Models\Answer;
use App\Models\Question;
use App\Repositorys\AnswerRepository;
use App\Repositorys\QuestionRepository;
use App\Services\AnswerService;
use PHPUnit\Framework\TestCase;


class CreateAnswerServiceTest extends TestCase
{
    public function testCreateFunctionShouldReturnAAnswer()
    {
        // given
        $questionMock = $this->createMock(Question::class);

        $questionRepositoryMock = $this->createMock(QuestionRepository::class);
        $questionRepositoryMock->method('getById')->willReturn($questionMock);

        $answerRepositoryMock = $this->createMock(AnswerRepository::class);

        $answerService = new AnswerService($answerRepositoryMock, $questionRepositoryMock);

        // when
        $result = $answerService->create(
            'Neymar Jr',
            '001aeb1d-2569-a56d-287e-2afbbc9637a6',
            true
        );

        // then
        $this->assertInstanceOf(Answer::class, $result);
    }

    public function testCreateFunctionShouldReturnAExceptionIfAnswerIsEmpty()
    {
        $this->expectException(\Exception::class);

        // given
        $questionRepositoryMock = $this->createMock(QuestionRepository::class);
        $answerRepositoryMock = $this->createMock(AnswerRepository::class);

        $answerService = new AnswerService($answerRepositoryMock, $questionRepositoryMock);

        // when
        $result = $answerService->create(
            '',
            '001aeb1d-2569-a56d-287e-2afbbc9637a6',
            true
        );
    }

    public function testCreateFunctionShouldReturnAExceptionIfQuestionIsEmpty()
    {
        $this->expectException(\Exception::class);

        // given
        $questionRepositoryMock = $this->createMock(QuestionRepository::class);
        $answerRepositoryMock = $this->createMock(AnswerRepository::class);

        $answerService = new AnswerService($answerRepositoryMock, $questionRepositoryMock);

        // when
        $result = $answerService->create(
            'neymar jr',
            '',
            true
        );
    }

    public function testCreateFunctionShouldReturnAExceptionIfIscorrectIsEmpty()
    {
        $this->expectException(\Exception::class);

        // given
        $questionRepositoryMock = $this->createMock(QuestionRepository::class);
        $answerRepositoryMock = $this->createMock(AnswerRepository::class);

        $answerService = new AnswerService($answerRepositoryMock, $questionRepositoryMock);

        // when
        $result = $answerService->create(
            'neymar jr',
            '001aeb1d-2569-a56d-287e-2afbbc9637a6',
            ''
        );
    }

    public function testCreateFunctionShouldReturnAExceptionIfAnswerDoesNotHaveAExistentQuestion()
    {
        $this->expectException(\Exception::class);

        // given
        $questionRepositoryMock = $this->createMock(QuestionRepository::class);
        $questionRepositoryMock->method('getById')->willReturn(null);

        $answerRepositoryMock = $this->createMock(AnswerRepository::class);

        $answerService = new AnswerService($answerRepositoryMock, $questionRepositoryMock);

        // when
        $result = $answerService->create(
            'neymar jr',
            '001aeb1d-2569-a56d-287e-2afbbc9637a6',
            true
        );
    }

    public function isCorrectProvider()
    {
        return [
            'inteiro' => [1],
            'string preenchida' => ['true'],
            'objeto' =>[new \DateTime()],
        ];
    }

    /**
     * @dataProvider  isCorrectProvider
     */
    public function testCreateFunctionShouldReturnAExceptionIfIscorrectHaveAValueDifferentThanABoolean($isCorrect)
    {
        $this->expectException(\Exception::class);

        // given
        $questionMock = $this->createMock(Question::class);

        $questionRepositoryMock = $this->createMock(QuestionRepository::class);
        $questionRepositoryMock->method('getById')->willReturn($questionMock);

        $answerRepositoryMock = $this->createMock(AnswerRepository::class);

        $answerService = new AnswerService($answerRepositoryMock, $questionRepositoryMock);

        // when
        $answerService->create(
            'neymar jr',
            '001aeb1d-2569-a56d-287e-2afbbc9637a6',
            $isCorrect
        );
    }
}