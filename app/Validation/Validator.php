<?php
    namespace Crypto\Validation;

    use Respect\Validation\Validator as Respect;
    use Respect\Validation\Exceptions\NestedValidationException as Disobey;

    class Validator
    {
        protected $errors;

        public function validate($request, array $rules)
        {
            foreach ($rules as $field => $rule) {
                try{
                    $rule->setName(ucfirst($field))->assert($request->getParam($field));
                }catch(Disobey $e){
                    $this->errors[$field] = $e->getMessages();
                }
            }

            $_SESSION['errors'] = $this->errors;

            return $this;
        }

        public function invalidate()
        {
            return !empty($this->errors);
        }
    }
    