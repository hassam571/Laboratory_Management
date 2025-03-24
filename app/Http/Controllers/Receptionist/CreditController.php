<?php
namespace App\Http\Controllers\Receptionist;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Debit;
// use Illuminate\Http\Request;
use App\Models\Credit;
use Illuminate\Support\Facades\Auth;

class CreditController extends Controller
{
    public function index()
    {
        $credits = Credit::where('userId', Auth::id())->get();
        return view('receptionist.pages.credit.index', compact('credits'));
    }

    public function create()
    {
        return view('receptionist.pages.credit.create');
    }

    public function store(Request $request)
    {
        $request->validate([
            'creditAmount' => 'required|numeric|min:0',
            'creditDetail' => 'required|string',
            'createdDate' => 'required|date'
        ]);

        Credit::create([
            'userId' => Auth::id(),
            'creditAmount' => $request->creditAmount,
            'creditDetail' => $request->creditDetail,
            'createdDate' => $request->createdDate
        ]);

        return redirect()->route('credit.index')->with('success', 'Credit transaction added successfully.');
    }

    public function destroy(Credit $credit)
    {
        $credit->delete();
        return redirect()->route('credit.index')->with('success', 'Credit transaction deleted successfully.');
    }
}
