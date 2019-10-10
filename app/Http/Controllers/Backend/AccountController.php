<?php

namespace App\Http\Controllers\Backend;

use App\Http\Controllers\Controller;
use App\Models\Account;
use App\Models\Credit;
use App\Models\Debit;
use App\Models\Sort\Backend\AccountSort;
use App\Models\User;
use App\Services\AccountService;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class AccountController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        $sort = new AccountSort($request);
        $search = $request->query('search');

        $accounts = Account::with('user')
            // when search is provided
            ->when($search, function($query, $search) {
                // query related user model
                $query->whereHas('user', function($query) use($search) {
                    $query
                        ->whereRaw('LOWER(name) LIKE ?', ['%'. strtolower($search) . '%'])
                        ->orWhereRaw('LOWER(email) LIKE ?', ['%'. strtolower($search) . '%']);
                });
            })
            ->orderBy($sort->getSortColumn(), $sort->getOrder())
            ->paginate($this->rowsPerPage);

        return view('backend.pages.accounts.index', [
            'accounts'  => $accounts,
            'search'    => $search,
            'sort'      => $sort->getSort(),
            'order'     => $sort->getOrder(),
        ]);
    }

    public function increaseBalance(Request $request) {
	    $user = Auth::user();

	    if (floatval($user->account->balance) > 0) {
	    	if ($user->account->currency_id != $request->get('currency_id')) {
			    throw new \Exception("can not work with 2 currencies ".$user->account->balance.' > '.$user->account->currency_id.'  '.$request->get('currency_id'));
		    }
	    }

	    $transactionable = new Credit();
	    $transactionable->account()->associate($user->account);
	    $transactionable->amount = $request->get('amount');
	    $transactionable->currency_id = $request->get('currency_id');
	    $transactionable->save();

	    $accountService = new AccountService($user->account);
	    $accountService->transaction($transactionable, $transactionable->amount, $transactionable->currency_id);
	    return [
	    	'success' => true,
		    'amount' => $transactionable->amount,
		    'currency' => $transactionable->currency_id,
	    ];
    }

	public function cashOut(Request $request) {
		$user = Auth::user();

		$response = [
			'amount' => $user->account->balance,
			'currency_id' => $user->account->currency_id,
		];

		$transactionable = new Credit();
		$transactionable->account()->associate($user->account);
		$transactionable->amount = -$user->account->balance;
		$transactionable->currency_id = $user->account->currency_id;
		$transactionable->save();

		$accountService = new AccountService($user->account);
		$accountService->transaction($transactionable, $transactionable->amount, $transactionable->currency_id);

		$response['success'] = true;
		return $response;
	}
}
