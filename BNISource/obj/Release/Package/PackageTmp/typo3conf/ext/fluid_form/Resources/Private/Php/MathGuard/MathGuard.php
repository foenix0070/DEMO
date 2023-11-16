<?php

/**
 * MathGuard is a PHP class that inserts a small piece of HTML code into your HTML form which requires the user to
 * evaluate an expression consisting of two random numbers. When user submits the form with the answer, the answer
 * is hashed and compared to the security code that has been submitted as well. This way you can easily protect your
 * forms from spambots.
 *
 * @author Matej Koval
 * @link http://www.codegravity.com/projects/mathguard
 * @author Reinhard Führicht <rf@typoheads.at>
 */
class MathGuard
{
    protected static $linefeed = LF;

    /**
     * You can also modify $output to your needs
     * @param int $prime
     * @param string $inputId
     * @return string
     */
    public static function produceOutput($prime = 37, $inputId = ''): string
    {
        $a = rand() % 10; // generates the random number
        $b = rand() % 10; // generates the random number
        $code = MathGuard::generateCode($a, $b, $prime);
        $output = '<div class="input-group-prepend" id="mathguard">' . self::$linefeed;
        $output .= '<div class="input-group-text">' . self::$linefeed;
        $output .= '<pre>' . MathGuard::renderExpression($a, $b) . '</pre>' . self::$linefeed;
        $output .= '</div>' . self::$linefeed;
        $output .= '</div>' . self::$linefeed;
        $output .= '<input type="text" class="form-control" aria-describedby="mathguard" name="mathguard_answer" ';
        $output .= 'maxlength="2" id="' . $inputId . '"/>' . self::$linefeed;
        $output .= '<input type="hidden" name="mathguard_code" value="' . $code . '" />';
        return $output;
    }

    /**
     * Function that converts the decimal number to line of 3 random characters
     * @param int $dec number that is being converted to line of 3 random characters
     * @return string
     */
    public static function decToBin(int $dec): string
    {
        $pattern = '123456789ABCDEFGHIJKLMNOPQRSTUWXYZ'; //without zero, it was interpreted as an empty space
        $output = '   ';
        $i = 0;
        do {
            if ($dec % 2) {
                $rand = rand() % 34;
                $output[2 - $i] = $pattern [$rand];
            } else {
                $output[2 - $i] = ' ';
            }
            $dec = (int)($dec / 2);
            $i++;
        } while ($dec > 0);
        // Wrap into spans
        $length = strlen($pattern);
        for ($i = 0; $i < $length; $i++) {
            $output = str_replace($pattern[$i], '<span>' . $pattern[$i] . '</span>', $output);
        }
        return $output;
    }

    /**
     * Function that renders a final 3x5 matrix consisting of random characters
     * @param int $a number a that renders to the 3x5 matrix consisting of random characters
     * @param int $b number b that renders to the 3x5 matrix consisting of random characters
     * @return string
     */
    public static function renderExpression(int $a, int $b): string
    {
        // Digits
        $number = [
            [7, 5, 5, 5, 7],
            [2, 6, 2, 2, 7],
            [7, 1, 7, 4, 7],
            [7, 1, 7, 1, 7],
            [4, 5, 7, 1, 1],
            [7, 4, 7, 1, 7],
            [7, 4, 7, 5, 7],
            [7, 1, 1, 1, 1],
            [7, 5, 7, 5, 7],
            [7, 5, 7, 1, 7]
        ];
        $plus = [0, 2, 7, 2, 0];
        $eq = [0, 7, 0, 7, 0];
        $output = '';
        for ($line = 0; $line < 5; $line++) {
            $output .= MathGuard::decToBin($number[$a][$line]) . '   ';
            $output .= MathGuard::decToBin($plus[$line]) . '   ';
            $output .= MathGuard::decToBin($number[$b][$line]) . '   ';
            $output .= MathGuard::decToBin($eq[$line]) . self::$linefeed;
            // Replace zeros
            $output = str_replace('0', ' ', $output);
        }
        $output = str_replace(' ', '<span class="space">_</span>', $output);
        return $output;
    }

    /**
     * A main hashing function: concat of user's answer,
     * hour and the additional prime number (default 37)
     * @param int $input
     * @param int $prime
     * @return string
     */
    public static function encode(int $input, int $prime): string
    {
        return md5($input . date('z') . $prime);
    }

    /**
     * This function generates the hash code from the two numbers
     * @param int $a First number
     * @param int $b Second number
     * @param int $prime Additional number to encode with
     * @return string
     */
    public static function generateCode(int $a, int $b, int $prime): string
    {
        return MathGuard::encode($a + $b, $prime);
    }

    /**
     * This function checks whether the answer and generated security code match
     * @param int $mathGuardAnswer Answer the user has entered
     * @param string $mathGuardCode Hashcode the mathguard has generated
     * @param int $prime Default prime is 37
     * @return bool
     */
    public static function checkResult(int $mathGuardAnswer, string $mathGuardCode, int $prime = 37): bool
    {
        $result_encoded = MathGuard::encode($mathGuardAnswer, $prime);
        if ($result_encoded == $mathGuardCode) {
            return true;
        }
        return false;
    }

    /**
     * This function inserts the two math term into your form,
     * the parameter is optional
     * @param int $prime Default prime is 37, you can change it when specifying the different parameter
     * @param string $inputId Id for HTML input
     * @return string
     */
    public static function insertQuestion(int $prime = 37, string $inputId = ''): string
    {
        return MathGuard::produceOutput($prime, $inputId);
    }

    /**
     * This function returns math expression into your form, the parameter is optional
     * quite similar to insertQuestion, but returns the output as a text instead of echoing
     * @param int $prime Default prime is 37, you can change it when specifying the different parameter
     * @return string
     */
    public static function returnQuestion(int $prime = 37): string
    {
        return MathGuard::produceOutput($prime);
    }
}
