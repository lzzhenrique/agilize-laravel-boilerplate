<?php

namespace App\Services;


use App\Models\Exam;
use App\Models\Question;
use App\Repositorys\ExamRepository;
use App\Repositorys\QuestionRepository;
use App\Repositorys\StudentRepository;
use App\Repositorys\SubjectRepository;
use Carbon\Carbon;

class ExamService
{
    protected SubjectRepository $subjectRepository;
    protected ExamRepository $examRepository;
    protected StudentRepository $studentRepository;
    protected QuestionRepository $questionRepository;

    protected SnapshotService $snapshotService;

    public function __construct(
        SubjectRepository  $subjectRepository,
        ExamRepository     $examRepository,
        StudentRepository  $studentRepository,
        QuestionRepository $questionRepository,
        SnapshotService    $snapshotService
    )
    {
        $this->subjectRepository = $subjectRepository;
        $this->examRepository = $examRepository;
        $this->studentRepository = $studentRepository;
        $this->questionRepository = $questionRepository;
        $this->snapshotService = $snapshotService;
    }

    public function create($studentId, $subjectId, $questionQuantity)
    {
        $this->validateExamCreation(
            [
                'studentId' => $studentId,
                'subjectId' => $subjectId,
                'questionQuantity' => $questionQuantity
            ]
        );

        $exam = $this->createExam($studentId, $subjectId, $questionQuantity);
        $snapshot = $this->createExamSnapshot($exam);

        return $this->createExamResponse($exam, $snapshot);
    }

    public function update($examId, $answers, $finishedAt)
    {
        $exam = $this->examRepository->getById($examId);
        $this->validateExamUpdate($exam, $finishedAt);
    }

    private function validateExamCreation($request)
    {
        foreach ($request as $key => $value) {
            if (!isset($value)) {
                throw new \Exception("the $key value not can be empty!");
            }
        }

        if ($this->questionRepository->countQuestionsBySubject($request['subjectId']) < $request['questionQuantity']) {
            throw new \Exception("the quantity of questions is less than the requested quantity");
        }
    }

    private function validateExamUpdate(Exam $exam, $finishedAt)
    {
        $finishedAtToCarbon = Carbon::parse($finishedAt);

        if ($finishedAtToCarbon->diffInHours($exam->getCreatedAt()->format('Y-m-d H:i:s')) > 1) {
            throw new \Exception("the exam has expired");
        }
    }

    private function createExam($studentId, $subjectId, $questionQuantity)
    {
        return $this->examRepository->create(
            new Exam(
                $this->studentRepository->getById($studentId),
                $this->subjectRepository->getById($subjectId),
                $questionQuantity
            )
        );
    }

    private function createExamSnapshot(Exam $exam)
    {
        return $this->snapshotService->create($exam);
    }

    private function createExamResponse(Exam $exam, $snapshot)
    {
        return [
            'exam' => $exam->getId(),
            'student' => $exam->getStudent()->getStudentName(),
            'subject' => $exam->getSubject()->getSubjectName(),
            'questionsAndAnswers' => $snapshot,
            'startedAt' => $exam->getCreatedAt()->format('Y-m-d H:i:s')
        ];
    }
}