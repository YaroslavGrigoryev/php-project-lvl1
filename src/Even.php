<?php

namespace BrainGames\Even;

use function cli\prompt;
use function cli\line;

function outputMessages(string $name, $statusReply = null)
{
    if ($statusReply === true) {
        $message = 'Correct!';
    } elseif ($statusReply === false) {
        $message = 'Answer "yes" if the number is even, otherwise answer "no".';
    } elseif ($statusReply === 'finish') {
        $message = "Congratulations, {$name}!";
    } else {
        $message = 'Answer "yes" if the number is even, otherwise answer "no".';
    }
    line($message, null, "");
}

function generatedNumber(): int
{
    $number = rand(0, 100);
    line("Question: {$number}");

    return $number;
}

function isEven(int $number): bool
{
    return $number % 2 === 0;
}

function checkedAnswer(int $number): bool
{
    $answer = prompt('Your answer');
    if ($answer === 'yes') {
        return isEven($number) === true;
    } elseif ($answer === 'no') {
        return isEven($number) === false;
    } else {
        return false;
    }
}

function evenGame($name)
{
    $i = 0;
    while ($i !== 3) {
        $number = generatedNumber();
        $statusReply = checkedAnswer($number);
        if ($statusReply === true) {
            outputMessages($name, $statusReply);
            $i++;
        } elseif ($statusReply === false) {
            $i = 0;
        }
    }
    outputMessages($name, 'finish');
}
