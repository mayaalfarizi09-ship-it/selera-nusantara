<?php

namespace App\Http\Controllers;

use App\Http\Requests\ReservationRequest;
use App\Models\Reservation;

class ReservationController extends Controller
{
    public function index()
    {
        return view('pages.reservation.index');
    }

    public function store(ReservationRequest $request)
    {
        Reservation::create($request->validated());

        return back()->with('success', 'Reservasi Anda berhasil dikirim. Kami akan mengonfirmasi melalui telepon/WhatsApp.');
    }
}
