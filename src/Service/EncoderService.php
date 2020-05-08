<?php

namespace App\Service;

use Hashids\Hashids;

class EncoderService {

    public function encode($integerId, $stringSalt) {

        $dateSalt = new \DateTime();
        $dateSalt = $dateSalt->format('d-m-Y-H-i-s-u');
        $dateAndSecretAndStringSalt = "$dateSalt-$stringSalt";

        $encoder = new Hashids($dateAndSecretAndStringSalt, 10); // pad to length 10
        return $encoder->encode($integerId); // VolejRejNm
    }

    public function decode($encoded) {
        $encoder = new Hashids();
        return $encoder->decode($encoded);
    }

}
