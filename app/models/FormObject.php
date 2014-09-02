<?php

trait FormObject
{
    protected $validator;

    public function save()
    {
        return true;
    }

    public function isValid()
    {
        return $this->validator->passes();
    }

    public function getErrors()
    {
        return $this->validator->messages();
    }
}
