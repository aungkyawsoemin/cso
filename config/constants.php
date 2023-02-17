<?php

define("STATUS_HIDE", 0);
define("STATUS_SHOW", 1);

define("QUIZ_LEVEL_EASY", 0);
define("QUIZ_LEVEL_MEDIUM", 1);
define("QUIZ_LEVEL_HARD", 2);

define("QUESTION_TYPE_SINGLE", 0);
define("QUESTION_TYPE_MULTIPLE", 1);
define("QUESTION_TYPE_DROPDOWN", 2);
define("QUESTION_TYPE_RANGE", 3);

define("INCORRECT_ANSWER", 0);
define("CORRECT_ANSWER", 1);

define("DEFAULT_PER_PAGE", 10);

return [
    'STATUS' => ['HIDE', 'SHOW'],
    'QUIZ_LEVEL' => ['EASY', 'MEDIUM', 'HARD'],
];