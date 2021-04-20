<?php

namespace App\Services;

use App\Models\JsonLeft;
use App\Models\JsonRight;

class CompareService
{
    private $jsonLeft;
    private $jsonRight;

    public function __construct(JsonLeft $jsonLeft, JsonRight $jsonRight)
    {
        $this->jsonLeft = $jsonLeft;
        $this->jsonRight = $jsonRight;
    }

    public function compare()
    {
        $response = [];

        // COMPARE IF THE BASE64 STRING IS EQUAL
        if ($this->jsonLeft->json_base64 == $this->jsonRight->json_base64) {
            $response['diff'] = 'ARE_EQUALS';

            // COMPARE IF THE BASE64 STRINGS HAVE DIFFERENT SIZE 
        } else if (strlen($this->jsonLeft->json_base64) != strlen($this->jsonRight->json_base64)) {
            $response['diff'] = 'HAVE_DIFFERENT_SIZE';
        } else {
            // AND THEN THEY ARE DIFFERENT BUT THE HAVE THE SAME SIZE 
            $response['diff'] = 'ARE_DIFFERENT_AND_SAME_SIZE';

            // CALL THE METHOD TO CHECK THE DIFFERENT SLICES 
            $response['diffs'] = $this->differences();
        }

        return $response;
    }

    private function differences()
    {
        $rB64 =  $this->jsonLeft->json_base64;
        $lB64 =  $this->jsonRight->json_base64;
        $diffs = [];

        $offset = null;
        $len = 0;

        // FOR EACH LEFT AND RIGHT BASE64 STRINGS LETTER THERE IS A COMPARATIONS
        for ($i = 0; $i < strlen($lB64); $i++) {
            if ($lB64[$i] != $rB64[$i]) {
                $len++;
                // FREEZE THE OFFSET WHILE THERE IS DIFFERECES 
                if (!$offset) {
                    $offset = $i;
                }
            } else {
                // IF EXISTS OFFSET A NEW SLICE IS ADDED ON LIST
                if ($offset) {
                    $diffs[] = [
                        'offset' => $offset,
                        'length' => $len
                    ];
                }
                $offset = null;
                $len = 0;
            }
        }
        return $diffs;
    }
}
