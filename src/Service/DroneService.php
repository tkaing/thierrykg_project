<?php

namespace App\Service;


use Symfony\Component\Validator\Validator\ValidatorInterface;

class DroneService {

    private $validator;

    public function __construct(ValidatorInterface $validator)
    {
        $this->validator = $validator;
    }

    public function hasError($object) {
        return $this->validator->validate($object)->count() > 0;
    }

    public function getMessage($object) {
        $violations = $this->validator->validate($object);
        $violation = $violations->get(0);
        return "{$violation->getPropertyPath()} = {$violation->getMessage()}";
    }
}
