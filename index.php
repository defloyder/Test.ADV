<?php

function reverseWords($input) {
    preg_match_all('/[\w\']+|[^\w\s]+/', $input, $matches);
    
    $result = '';
    
    foreach ($matches[0] as $word) {
        preg_match_all('/\p{L}/u', $word, $letters);
        preg_match_all('/[^a-zA-Z\s]/', $word, $non_letters);
        
        $reversed_letters = array_reverse($letters[0]);
        
        $reversed_word = '';
        $letter_index = 0;
        $non_letter_index = 0;
        for ($i = 0; $i < strlen($word); $i++) {
            if (preg_match('/[a-zA-Z]/', $word[$i])) {
                $reversed_word .= ctype_upper($word[$i]) ? mb_strtoupper($reversed_letters[$letter_index]) : mb_strtolower($reversed_letters[$letter_index]);
                $letter_index++;
            } else {
                $reversed_word .= $non_letters[0][$non_letter_index];
                $non_letter_index++;
            }
        }
        
        $result .= $reversed_word;
    }
    
    return $result;
}

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
            echo "Тест $i пройден.\n";
            $num_passed++;
        } else {
            echo "Тест $i провален. Ожидается: {$expected_results[$i]}, получено: $result\n";
        }
    }

    echo "Пройдено $num_passed из $num_tests тестов.\n";
}

testReverseWords();
