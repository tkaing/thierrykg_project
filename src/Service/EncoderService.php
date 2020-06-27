<?php

namespace App\Service;

use Hashids\Hashids;

class EncoderService {

    public function encode($integerId, $stringSalt, int $length = 10) {

        $dateSalt = new \DateTime();
        $dateSalt = $dateSalt->format('d-m-Y-H-i-s-u');
        $dateAndStringSalt = "$dateSalt-$stringSalt";

        $encoder = new Hashids($dateAndStringSalt, $length, 'ABCDEFGHIJKLMNOPQRSTUVWXYZ1234567890');
        return $encoder->encode($integerId);
    }

    public function decode($encoded) {
        $encoder = new Hashids();
        return $encoder->decode($encoded);
    }
}
