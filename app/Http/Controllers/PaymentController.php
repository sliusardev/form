<?php

namespace App\Http\Controllers;

use App\Models\Payment;
use Illuminate\Http\Request;

class PaymentController extends Controller
{
    public function index(Request $request)
    {
        $query = Payment::query()->with(['user', 'company']);

        if ($request->filled('search')) {
            $searchTerm = $request->input('search');
            $query->where(function ($q) use ($searchTerm) {
                $q->where('user.name', 'like', '%' . $searchTerm . '%')
                    ->orWhere('company.name', 'like', '%' . $searchTerm . '%');
            });
        }

        if ($request->filled('sort')) {
            $direction = $request->input('direction', 'asc');
            if (in_array($direction, ['asc', 'desc'])) {
                $query->orderBy($request->input('sort'), $direction);
            }
        }

        $payments = $query->paginate(25);

        return view('dashboard.payments.index', [
            'payments' => $payments
        ]);
    }
}
