<?php

namespace App\Exception;

use Symfony\Component\Validator\ConstraintViolationList;
use Symfony\Component\Validator\Exception\RuntimeException;

class ValidationException extends RuntimeException
{
    private ConstraintViolationList $violations;

    protected $message = "Validation failed";

    public function __construct(ConstraintViolationList $violations)
    {
        $this->violations = $violations;
        parent::__construct();

    }
    /**
     * @return ConstraintViolationList
     */
    public function getViolations(): ConstraintViolationList
    {
        return $this->violations;
    }
}