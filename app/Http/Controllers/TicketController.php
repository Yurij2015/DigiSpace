<?php

namespace App\Http\Controllers;

use App\Models\Ticket;
use Illuminate\Auth\Access\AuthorizationException;
use Illuminate\Contracts\Foundation\Application;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Routing\Redirector;
use Inertia\Inertia;
use Inertia\Response;

class TicketController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return Response
     */
    public function index(): Response
    {
        return Inertia::render('Tickets/Index', [
            'tickets' => Ticket::with('user:id,name')->latest()->get(),
        ]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param Request $request
     * @return Application|RedirectResponse|Redirector
     */
    public function store(Request $request): Application|RedirectResponse|Redirector
    {
        $validated = $request->validate([
            'message' => 'required|string|max:255',
        ]);

        $request->user()->tickets()->create($validated);

        return redirect(route('tickets.index'));
    }

    /**
     * Display the specified resource.
     *
     * @param Ticket $ticket
     * @return \Illuminate\Http\Response
     */
    public function show(Ticket $ticket)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param Ticket $ticket
     * @return \Illuminate\Http\Response
     */
    public function edit(Ticket $ticket)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param Request $request
     * @param Ticket $ticket
     * @return Application|Redirector|RedirectResponse
     */
    public function update(Request $request, Ticket $ticket)
    {
        $this->authorize('update', $ticket);

        $validated = $request->validate([
            'message' => 'required|string|max:255',
        ]);

        $ticket->update($validated);

        return redirect(route('tickets.index'));
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param Ticket $ticket
     * @return Application|Redirector|RedirectResponse
     * @throws AuthorizationException
     */
    public function destroy(Ticket $ticket): Redirector|RedirectResponse|Application
    {
        $this->authorize('delete', $ticket);

        $ticket->delete();

        return redirect(route('tickets.index'));
    }
}
