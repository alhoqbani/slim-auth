<?php

namespace App\Validation;

use Respect\Validation\Exceptions\NestedValidationException;

class Validator
{
    
    protected $errors = [];
    
    public function validate($request, array $rules)
    {
        try {
            foreach ($rules as $field => $rule) {
                $rule->setName($field)->assert($request->getParam($field));
            }
        } catch (NestedValidationException $e) {
            $this->errors[$field] = $e->getMessages();
        }
        
        return $this;
    }
    
    public function failed()
    {
        return ! empty($this->errors);
    }
}