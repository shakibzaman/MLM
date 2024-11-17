<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use App\Models\SupportTicket;
use App\Models\SupportTicketAnswer;
use App\Models\User;
use Illuminate\Http\Request;
use Exception;

class SupportTicketAnswersController extends Controller
{

    /**
     * Display a listing of the support ticket answers.
     *
     * @return \Illuminate\View\View
     */
    public function index()
    {
        $supportTicketAnswers = SupportTicketAnswer::with('supportticket','user')->paginate(25);

        return view('support_ticket_answers.index', compact('supportTicketAnswers'));
    }

    /**
     * Show the form for creating a new support ticket answer.
     *
     * @return \Illuminate\View\View
     */
    public function create()
    {
        $supportTickets = SupportTicket::pluck('title','id')->all();
        $users = User::pluck('name','id')->all();

        return view('support_ticket_answers.create', compact('supportTickets','users'));
    }

    /**
     * Store a new support ticket answer in the storage.
     *
     * @param Illuminate\Http\Request $request
     *
     * @return \Illuminate\Http\RedirectResponse | \Illuminate\Routing\Redirector
     */
    public function store(Request $request)
    {

        $data = $this->getData($request);

        SupportTicketAnswer::create($data);

        return redirect()->back()
            ->with('success_message', 'Support Ticket Answer was successfully added.');
    }

    /**
     * Display the specified support ticket answer.
     *
     * @param int $id
     *
     * @return \Illuminate\View\View
     */
    public function show($id)
    {
        $supportTicketAnswer = SupportTicketAnswer::with('supportticket','user')->findOrFail($id);

        return view('support_ticket_answers.show', compact('supportTicketAnswer'));
    }

    /**
     * Show the form for editing the specified support ticket answer.
     *
     * @param int $id
     *
     * @return \Illuminate\View\View
     */
    public function edit($id)
    {
        $supportTicketAnswer = SupportTicketAnswer::findOrFail($id);
        $supportTickets = SupportTicket::pluck('title','id')->all();
$users = User::pluck('name','id')->all();

        return view('support_ticket_answers.edit', compact('supportTicketAnswer','supportTickets','users'));
    }

    /**
     * Update the specified support ticket answer in the storage.
     *
     * @param int $id
     * @param Illuminate\Http\Request $request
     *
     * @return \Illuminate\Http\RedirectResponse | \Illuminate\Routing\Redirector
     */
    public function update($id, Request $request)
    {

        $data = $this->getData($request);

        $supportTicketAnswer = SupportTicketAnswer::findOrFail($id);
        $supportTicketAnswer->update($data);

        return redirect()->route('support_ticket_answers.support_ticket_answer.index')
            ->with('success_message', 'Support Ticket Answer was successfully updated.');
    }

    /**
     * Remove the specified support ticket answer from the storage.
     *
     * @param int $id
     *
     * @return \Illuminate\Http\RedirectResponse | \Illuminate\Routing\Redirector
     */
    public function destroy($id)
    {
        try {
            $supportTicketAnswer = SupportTicketAnswer::findOrFail($id);
            $supportTicketAnswer->delete();

            return redirect()->route('support_ticket_answers.support_ticket_answer.index')
                ->with('success_message', 'Support Ticket Answer was successfully deleted.');
        } catch (Exception $exception) {

            return back()->withInput()
                ->withErrors(['unexpected_error' => 'Unexpected error occurred while trying to process your request.']);
        }
    }


    /**
     * Get the request's data from the request.
     *
     * @param Illuminate\Http\Request\Request $request
     * @return array
     */
    protected function getData(Request $request)
    {
        $rules = [
            'support_ticket_id' => 'nullable',
            'answer' => 'string|min:1|nullable',
            'user_id' => 'nullable',
        ];


        $data = $request->validate($rules);




        return $data;
    }

}
