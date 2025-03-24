<?php
namespace App\Http\Controllers\Receptionist;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Stock;

class StockController extends Controller
{
    public function index()
    {
        $stocks = Stock::all();
        return view('receptionist.pages.stock.index', compact('stocks'));
    }

    public function create()
    {
        return view('receptionist.pages.stock.create');
    }

    public function store(Request $request)
    {
        $request->validate([
            'userId' => 'required|integer',
            'itemName' => 'required|string|max:255',
            'itemDetail' => 'required',
            'expDate' => 'required|date',
            'itmQnt' => 'required|integer',
            'itmPrice' => 'required|integer',
            'createdDate' => 'required|date',
        ]);

        Stock::create($request->all());
        return redirect()->route('stock.index')->with('success', 'Stock added successfully');
    }
    public function destroy($id)
{
    $stock = Stock::findOrFail($id);
    $stock->delete();

    return redirect()->route('stock.index')->with('success', 'Stock deleted successfully!');
}

}
