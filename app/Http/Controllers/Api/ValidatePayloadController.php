<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Traits\EmailRule;
use App\Traits\NumberRule;
use Illuminate\Http\Request;
use Illuminate\Http\JsonResponse;
use App\Traits\AlphaRule;
use App\Traits\RequiredRule;

class ValidatePayloadController extends Controller
{
    use AlphaRule, RequiredRule, EmailRule, NumberRule;

    /**
     * ValidatePayloadController
     * @param Request $request
     * @return JsonResponse
     */
    public function __invoke(Request $request): JsonResponse
    {
        if(empty($request->all())){
            return response()->json([
                'message' => 'Bad Request. Request must contain a valid data payload'
            ], 422);
        }

        $errors = [];
        foreach($request->all() as $key => $value){
            $validateRequest = $this->validator($key, $value);
            if(!empty($validateRequest)){
                $errors[$key] = $validateRequest;
            }
        }

        if(count($errors)){
            return response()->json([
                'message' => 'Bad Request. Invalid Params',
                'errors' => $errors
            ], 422);
        }
        return response()->json(["status" => true], 200);
    }


    /**
     * Validate this Request
     *
     * @param string Field key
     * @param array Field data
     * @return Array
     **/
    protected function validator(string $key, array $data): Array
    {
        $rules = explode('|', $data['rules']);
        $messages = [];
        foreach($rules as $rule){
            switch ($rule){
                case 'alpha':
                    $alphaErrors = $this->alpha($key, $data['value']);
                    if(!is_null($alphaErrors)){
                        $messages[] = $alphaErrors;
                    }
                    break;
                case 'required':
                    $requiredErrors = $this->required($key, $data['value']);
                    if(!is_null($requiredErrors)){
                        $messages[] = $requiredErrors;
                    }
                    break;
                case 'email':
                    $emailErrors = $this->email($key, $data['value']);
                    if(!is_null($emailErrors)){
                        $messages[] = $emailErrors;
                    }
                    break;
                case 'number':
                    $numberErrors = $this->number($key, $data['value']);
                    if(!is_null($numberErrors)){
                        $messages[] = $numberErrors;
                    }
                    break;
                default:
                    $messages[] = 'The '. $key . ' field has invalid rule set. Please check our documentation for available rule sets';
            }
        }
        return count($messages) ? $messages : [];
    }

    protected function payloadIsRequired(Request $request)
    {

    }
}
