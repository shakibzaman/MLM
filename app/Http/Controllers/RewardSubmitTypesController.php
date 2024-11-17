<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use App\Models\RewardSubmitType;
use Illuminate\Http\Request;
use Exception;

class RewardSubmitTypesController extends Controller
{

    /**
     * Display a listing of the reward submit types.
     *
     * @return \Illuminate\View\View
     */
    public function index()
    {
        $rewardSubmitTypes = RewardSubmitType::paginate(25);

        return view('reward_submit_types.index', compact('rewardSubmitTypes'));
    }

    /**
     * Show the form for creating a new reward submit type.
     *
     * @return \Illuminate\View\View
     */
    public function create()
    {
        
        
        return view('reward_submit_types.create');
    }

    /**
     * Store a new reward submit type in the storage.
     *
     * @param Illuminate\Http\Request $request
     *
     * @return \Illuminate\Http\RedirectResponse | \Illuminate\Routing\Redirector
     */
    public function store(Request $request)
    {
        
        $data = $this->getData($request);
        
        RewardSubmitType::create($data);

        return redirect()->route('reward_submit_types.reward_submit_type.index')
            ->with('success_message', 'Reward Submit Type was successfully added.');
    }

    /**
     * Display the specified reward submit type.
     *
     * @param int $id
     *
     * @return \Illuminate\View\View
     */
    public function show($id)
    {
        $rewardSubmitType = RewardSubmitType::findOrFail($id);

        return view('reward_submit_types.show', compact('rewardSubmitType'));
    }

    /**
     * Show the form for editing the specified reward submit type.
     *
     * @param int $id
     *
     * @return \Illuminate\View\View
     */
    public function edit($id)
    {
        $rewardSubmitType = RewardSubmitType::findOrFail($id);
        

        return view('reward_submit_types.edit', compact('rewardSubmitType'));
    }

    /**
     * Update the specified reward submit type in the storage.
     *
     * @param int $id
     * @param Illuminate\Http\Request $request
     *
     * @return \Illuminate\Http\RedirectResponse | \Illuminate\Routing\Redirector
     */
    public function update($id, Request $request)
    {
        
        $data = $this->getData($request);
        
        $rewardSubmitType = RewardSubmitType::findOrFail($id);
        $rewardSubmitType->update($data);

        return redirect()->route('reward_submit_types.reward_submit_type.index')
            ->with('success_message', 'Reward Submit Type was successfully updated.');  
    }

    /**
     * Remove the specified reward submit type from the storage.
     *
     * @param int $id
     *
     * @return \Illuminate\Http\RedirectResponse | \Illuminate\Routing\Redirector
     */
    public function destroy($id)
    {
        try {
            $rewardSubmitType = RewardSubmitType::findOrFail($id);
            $rewardSubmitType->delete();

            return redirect()->route('reward_submit_types.reward_submit_type.index')
                ->with('success_message', 'Reward Submit Type was successfully deleted.');
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
                'name' => 'string|min:1|max:255|nullable',
            'is_active' => 'boolean|nullable', 
        ];

        
        $data = $request->validate($rules);


        $data['is_active'] = $request->has('is_active');


        return $data;
    }

}
