<?php

function reverseWords($input) {
    // Разделение строки на слова с учётом пунктуации
    preg_match_all('/[\w\']+|[^\w\s]+/', $input, $matches);
    
    $result = '';
    
    foreach ($matches[0] as $word) {
        // Разделение слова на буквы с сохранением регистра
        preg_match_all('/\p{L}/u', $word, $letters);
        preg_match_all('/[^a-zA-Z\s]/', $word, $non_letters);
        
        // Реверс букв в слове с сохранением регистра
        $reversed_letters = array_reverse($letters[0]);
        
        // Сбор результата с учётом пунктуации
        $reversed_word = '';
        $letter_index = 0;
        $non_letter_index = 0;
        for ($i = 0; $i < strlen($word); $i++) {
            if (preg_match('/[a-zA-Z]/', $word[$i])) {
                // Если текущий символ - буква, добавляем реверсированную букву
                $reversed_word .= ctype_upper($word[$i]) ? strtoupper($reversed_letters[$letter_index]) : strtolower($reversed_letters[$letter_index]);
                $letter_index++;
            } else {
                // Иначе добавляем символ пунктуации
                $reversed_word .= $non_letters[0][$non_letter_index];
                $non_letter_index++;
            }
        }
        
        $result .= $reversed_word;
    }
    
    return $result;
}


// Функция для проверки результатов
function testReverseWords() {
    $inputs = [
        "Cat, is 'cold' now!",
        "houSe",
        "elEpHant",
        "third-part",
        "can`t"
    ];

    $expected_results = [
        "Tac, si 'dloc' won!",
        "esuOh",
        "tnAhPele",
        "driht-trap",
        "nac`t"
    ];

    $num_tests = count($inputs);
    $num_passed = 0;

    for ($i = 0; $i < $num_tests; $i++) {
        $result = reverseWords($inputs[$i]);
        if ($result === $expected_results[$i]) {
            echo "Test $i passed.\n";
            $num_passed++;
        } else {
            echo "Test $i failed. Expected: {$expected_results[$i]}, got: $result\n";
        }
    }

    echo "Passed $num_passed out of $num_tests tests.\n";
}

// Запуск тестов
testReverseWords();