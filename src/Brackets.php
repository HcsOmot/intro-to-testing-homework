<?php

class Brackets
{
    public function isValid(string $bracketsFormation)
    {
        $stack = [];

        $firstCharacter = $bracketsFormation[0];
        if (in_array($firstCharacter, [')', ']', '}'])){
            return 0;
        }

        $bracketsLength = strlen($bracketsFormation);
        for ($i = 0; $i < $bracketsLength; ++$i) {
            $currentBracket = $bracketsFormation[$i];

            if ($currentBracket === '(' || $currentBracket === '[' || $currentBracket === '{') {
                array_unshift($stack, $currentBracket);
            } elseif ('}' === $currentBracket) {
                if (empty($stack)){
                    return 0;
                }
                if('{' === $stack[0]){
                    array_shift($stack);
                } else{
                    return 0;
                }
            } elseif (']' === $currentBracket) {
                if (empty($stack)){
                    return 0;
                }
                if('[' === $stack[0]){
                    array_shift($stack);
                }else{
                    return 0;
                }
            } elseif (')' === $currentBracket) {
                if (empty($stack)){
                    return 0;
                }
                if('(' === $stack[0]){
                    array_shift($stack);
                }else{
                    return 0;
                }
            }
        }

        return (int) empty($stack);
    }
}
