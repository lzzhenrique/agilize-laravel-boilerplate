<?php

namespace Tests\Unit\Service;


use App\Models\Question;
use App\Models\Subject;
use App\Repositorys\QuestionRepository;
use App\Repositorys\SubjectRepository;
use App\Services\QuestionService;
use Tests\TestCase;

class CreateQuestionServiceTest extends TestCase
{
    public function testCreateFunctionShouldReturnAQuestion()
    {
        // given
        $questionMock = $this->createMock(Question::class);
        $subjectMock = $this->createMock(Subject::class);

        $questionRepositoryMock = $this->createMock(QuestionRepository::class);
        $questionRepositoryMock->method('create')->willReturn($questionMock);

        $subjectRepositoryMock = $this->createMock(SubjectRepository::class);
        $subjectRepositoryMock->method('getById')->willReturn($subjectMock);

        $questionService = new QuestionService($subjectRepositoryMock, $questionRepositoryMock);

        // when
        $result = $questionService->create('Quem descobriu o Brasil?', '001aeb1d-9671-b55a-287e-2afbb7d936b0');

        // then
        $this->assertInstanceOf(Question::class, $result);
    }

    public function testCreateFunctionShouldReturnAExceptionIfQuestionIsEmpty()
    {
        $this->expectException(\Exception::class);

        $questionRepositoryMock = $this->createMock(QuestionRepository::class);
        $subjectRepositoryMock = $this->createMock(SubjectRepository::class);

        $questionService = new QuestionService($subjectRepositoryMock, $questionRepositoryMock);

        $questionService->create('', '001aeb1d-2569-a56d-287e-2afbb7d936b0');
    }

    public function testCreateFunctionShouldReturnAExceptionIfQuestionDoenstHaveSubject()
    {
        $this->expectException(\Exception::class);

        $questionMock = $this->createMock(Question::class);

        $questionRepositoryMock = $this->createMock(QuestionRepository::class);
        $questionRepositoryMock->method('create')->willReturn($questionMock);

        $subjectRepositoryMock = $this->createMock(SubjectRepository::class);
        $subjectRepositoryMock->method('getById')->willReturn(null);

        $questionService = new QuestionService($subjectRepositoryMock, $questionRepositoryMock);

        $questionService->create('Quem descobriu o Brasil?', '001aeb1d-2569-a56d-287e-2afbb7d936b0');
    }
}