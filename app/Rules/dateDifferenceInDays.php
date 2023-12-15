<?php

namespace App\Rules;

use Carbon\Carbon;
use Closure;
use Illuminate\Contracts\Validation\ValidationRule;

class dateDifferenceInDays implements ValidationRule
{
    /**
     * Run the validation rule.
     *
     * @param  \Closure(string): \Illuminate\Translation\PotentiallyTranslatedString  $fail
     */
    protected $request;
    public function __construct($request)
    {
        $this->request = $request;
    }
    public function validate(string $attribute, mixed $value, Closure $fail): void
    {
        $request = $this->request;
        $fdate = Carbon::parse(Carbon::createFromFormat('d, F Y', $request->from_date)->format('Y-m-d'));
        $tdate = Carbon::parse(Carbon::createFromFormat('d, F Y', $request->to_date)->format('Y-m-d'));
        if ($fdate->diffInDays($tdate) > 90) :
            $fail('Maximum allowd range is 90 days!');
        endif;
    }
}
