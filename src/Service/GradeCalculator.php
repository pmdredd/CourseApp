<?php

namespace App\Service;

/**
 * Class GradeCalculator
 * @package App\Service
 *
 * Service class containing logic for calculating grades (e.g. A1, B3, MF) from marks 0-100.
 * When using this class you should call calculateGrade(), which calls out to the private functions
 * that calculate different grades depending on if the submission has been submit a second time.
 */
class GradeCalculator
{
    /**
     * @param $mark int
     * @param $resubmitted bool
     * @return string
     */
    public function calculateGrade(int $mark, bool $resubmitted): string
    {
        if ($resubmitted) {
            return $this->calculateResubmittedSubmissionGrade($mark);
        } else {
            return $this->calculateFirstSubmissionGrade($mark);
        }
    }

    /**
     * @param $mark
     * @return string
     */
    private function calculateFirstSubmissionGrade(int $mark): string
    {
        $grade = "";
        if ($mark < 0 || $mark > 100) {
            throw new \DomainException("Mark value must be between 0 and 100");
        } elseif ($mark >= 95) {
            $grade = "A1";
        } elseif ($mark >= 89) {
            $grade = "A2";
        } elseif ($mark >= 83) {
            $grade = "A3";
        } elseif ($mark >= 76) {
            $grade = "A4";
        } elseif ($mark >= 70) {
            $grade = "A5";
        } elseif ($mark >= 67) {
            $grade = "B1";
        } elseif ($mark >= 64) {
            $grade = "B2";
        } elseif ($mark >= 60) {
            $grade = "B3";
        } elseif ($mark >= 57) {
            $grade = "C1";
        } elseif ($mark >= 54) {
            $grade = "C2";
        } elseif ($mark >= 50) {
            $grade = "C3";
        } elseif ($mark >= 47) {
            $grade = "D1";
        } elseif ($mark >= 44) {
            $grade = "D2";
        } elseif ($mark >= 40) {
            $grade = "D3";
        } elseif ($mark >= 37) {
            $grade = "MF1";
        } elseif ($mark >= 34) {
            $grade = "MF2";
        } elseif ($mark >= 30) {
            $grade = "MF3";
        } elseif ($mark >= 20) {
            $grade = "CF";
        } else {
            $grade = "BF";
        }
        return $grade;
    }

    /**
     * @param $mark int
     * @return string
     */
    private function calculateResubmittedSubmissionGrade(int $mark): string
    {
        $grade = "";
        if ($mark < 0 || $mark > 100) {
            throw new \DomainException("Mark value must be between 0 and 100");
        } elseif ($mark >= 40) {
            $grade = "D3";
        } elseif ($mark >= 37) {
            $grade = "MF1";
        } elseif ($mark >= 34) {
            $grade = "MF2";
        } elseif ($mark >= 30) {
            $grade = "MF3";
        } elseif ($mark >= 20) {
            $grade = "CF";
        } else {
            $grade = "BF";
        }
        return $grade;
    }
}
