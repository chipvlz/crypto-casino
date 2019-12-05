<?php

namespace Packages\Raffle\Http\Controllers\Frontend;

use App\Http\Controllers\Controller;
use App\Services\AccountService;
use Illuminate\Http\Request;
use Illuminate\Support\Carbon;
use Packages\Raffle\Events\RaffleTicketPurchased;
use Packages\Raffle\Http\Requests\Frontend\PurchaseRaffleTicket;
use Packages\Raffle\Models\Raffle;
use Packages\Raffle\Services\RaffleService;

class RaffleController extends Controller
{
    public function index()
    {
        $raffle = Raffle::orderBy('id', 'desc')->first();

        return view('raffle::frontend.pages.index', [
            'raffle'        => $raffle,
            'tickets'       => $raffle->tickets ?? NULL,
            'participants'  => $raffle ? $raffle->accounts()->with('user')->get()->groupBy('user_id')->map(function ($accounts) {
                return (object) [
                    'user'           => $accounts[0]->user,
                    'tickets_count'  => count($accounts),
                    'last_purchased' => Carbon::parse(max(array_column(array_column($accounts->toArray(), 'pivot'), 'created_at')))
                ];
            })->sortByDesc('tickets_count') : collect(),
        ]);
    }

    /**
     * Purchase raffle tickets
     * It's important to type hint Raffle model, so it's accessible in PurchaseRaffleTicket request
     *
     * @param PurchaseRaffleTicket $request
     * @param Raffle $raffle
     * @return \Illuminate\Http\RedirectResponse
     */
    public function ticket(PurchaseRaffleTicket $request, Raffle $raffle)
    {
        RaffleService::purchaseTicket($raffle, $request->user(), $request->quantity);

        return back()->with('success', __('You have successfully purchased raffle tickets.'));
    }

    /**
     * Raffles history
     *
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function history()
    {
        $raffles = Raffle::orderBy('id', 'desc')
            ->where('status', Raffle::STATUS_COMPLETED)
            ->where('win_amount', '>', 0) // raffles without winner are not displayed
            ->withCount('tickets')
            ->paginate($this->rowsPerPage);

        return view('raffle::frontend.pages.history', [
            'raffles' => $raffles
        ]);
    }
}
