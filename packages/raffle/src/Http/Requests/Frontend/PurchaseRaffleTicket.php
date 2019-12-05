<?php

namespace Packages\Raffle\Http\Requests\Frontend;

use App\Rules\BalanceIsSufficient;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Http\Request;
use Packages\Raffle\Models\Raffle;

class PurchaseRaffleTicket extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     *
     * @return bool
     */
    public function authorize()
    {
        // note that $this->raffle will be available if Raffle model is type hinted in the corresponding Controller method
        return $this->raffle
            && $this->raffle->status == Raffle::STATUS_IN_PROGRESS
            && !$this->raffle->is_end_date_passed;
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    public function rules(Request $request)
    {
        return [
            'quantity' => [
                'required',
                'integer',
                'min:1',
                'max:' . $this->raffle->getMaxTicketsUserCanPurchase($this->user()),
                new BalanceIsSufficient((int) $request->quantity * $this->raffle->ticket_price)
            ]
        ];
    }

    public function messages()
    {
        return [
            'quantity.max' => __('You can not purchase more than :max ticket(s).'),
        ];
    }
}
