<?php
namespace App\Http\Controllers\Receptionist;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Debit;
// use Illuminate\Http\Request;
// use App\Models\Debit;
use Illuminate\Support\Facades\Auth;

class DebitController extends Controller
{
    public function index()
    {
        $debits = Debit::where('userId', Auth::id())->get();
        return view('receptionist.pages.debit.index', compact('debits'));
    }

    public function create()
    {
        return view('receptionist.pages.debit.create');
    }

    public function store(Request $request)
    {
        $request->validate([
            'debitAmount' => 'required|numeric|min:0',
            'debitDetail' => 'required|string',
            'createdDate' => 'required|date'
        ]);

        Debit::create([
            'userId' => Auth::id(),
            'debitAmount' => $request->debitAmount,
            'debitDetail' => $request->debitDetail,
            'createdDate' => $request->createdDate
        ]);

        return redirect()->route('debit.index')->with('success', 'Debit transaction added successfully.');
    }

    public function destroy(Debit $debit)
    {
        $debit->delete();
        return redirect()->route('debit.index')->with('success', 'Debit transaction deleted successfully.');
    }
}
