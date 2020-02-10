<?php


namespace App\Service;


class GradeCalculator
{
    public function calculateGrade($mark)
    {
        $grade = "";
        if ($mark < 0 || $mark > 100) {
            throw new \DomainException("Mark value must be between 0 and 100");
        } elseif ($mark >= 95) {
            $grade="A1";
        } elseif ($mark >= 89) {
            $grade="A2";
        } elseif ($mark >= 83) {
            $grade="A3";
        } elseif ($mark >= 76) {
            $grade="A4";
        } elseif ($mark >= 70) {
            $grade="A5";
        } elseif ($mark >= 67) {
            $grade="B1";
        } elseif ($mark >= 64) {
            $grade="B2";
        } elseif ($mark >= 60) {
            $grade="B3";
        } elseif ($mark >= 57) {
            $grade="C1";
        } elseif ($mark >= 54) {
            $grade="C2";
        } elseif ($mark >= 50) {
            $grade="C3";
        } elseif ($mark >= 47) {
            $grade="D1";
        } elseif ($mark >= 44) {
            $grade="D2";
        } elseif ($mark >= 40) {
            $grade="D3";
        } elseif ($mark >= 37) {
            $grade="MF1";
        } elseif ($mark >= 34) {
            $grade="MF2";
        } elseif ($mark >= 30) {
            $grade="MF3";
        } elseif ($mark >= 20) {
            $grade="CF";
        } elseif ($mark >= 0) {
            $grade="BF";
        }
        return $grade;
    }
}