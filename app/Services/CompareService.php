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

        if ($this->jsonLeft->json_base64 == $this->jsonRight->json_base64) {
            $response['diff'] = 'ARE_EQUALS';
        } else if (strlen($this->jsonLeft->json_base64) != strlen($this->jsonRight->json_base64)) {
            $response['diff'] = 'HAVE_DIFFERENT_SIZE';
        } else {
            $response['diff'] = 'ARE_DIFFERENT_AND_SAME_SIZE';
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

        for ($i = 0; $i < strlen($lB64); $i++) {
            if ($lB64[$i] != $rB64[$i]) {
                $len++;
                if (!$offset) {
                    $offset = $i;
                }
            } else {
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
