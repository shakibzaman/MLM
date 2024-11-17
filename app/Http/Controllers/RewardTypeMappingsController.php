<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use App\Models\RewardSite;
use App\Models\RewardSubmitType;
use App\Models\RewardTypeMapping;
use Illuminate\Http\Request;
use Exception;
use Illuminate\Validation\Rule;

class RewardTypeMappingsController extends Controller
{

    /**
     * Display a listing of the reward type mappings.
     *
     * @return \Illuminate\View\View
     */
    public function index()
    {
        $rewardTypeMappings = RewardTypeMapping::with('rewardsite', 'rewardsubmittype')->paginate(25);

        return view('reward_type_mappings.index', compact('rewardTypeMappings'));
    }

    /**
     * Show the form for creating a new reward type mapping.
     *
     * @return \Illuminate\View\View
     */
    public function create()
    {
        $rewardSites = RewardSite::pluck('name', 'id')->all();
        $rewardSubmitTypes = RewardSubmitType::pluck('name', 'id')->all();

        return view('reward_type_mappings.create', compact('rewardSites', 'rewardSubmitTypes'));
    }

    /**
     * Store a new reward type mapping in the storage.
     *
     * @param Illuminate\Http\Request $request
     *
     * @return \Illuminate\Http\RedirectResponse | \Illuminate\Routing\Redirector
     */
    public function store(Request $request)
    {

        $data = $this->getData($request);

        RewardTypeMapping::create($data);

        return redirect()->route('reward_type_mappings.reward_type_mapping.index')
            ->with('success_message', 'Reward Type Mapping was successfully added.');
    }

    /**
     * Display the specified reward type mapping.
     *
     * @param int $id
     *
     * @return \Illuminate\View\View
     */
    public function show($id)
    {
        $rewardTypeMapping = RewardTypeMapping::with('rewardsite', 'rewardsubmittype')->findOrFail($id);

        return view('reward_type_mappings.show', compact('rewardTypeMapping'));
    }

    /**
     * Show the form for editing the specified reward type mapping.
     *
     * @param int $id
     *
     * @return \Illuminate\View\View
     */
    public function edit($id)
    {
        $rewardTypeMapping = RewardTypeMapping::findOrFail($id);
        $rewardSites = RewardSite::pluck('name', 'id')->all();
        $rewardSubmitTypes = RewardSubmitType::pluck('name', 'id')->all();

        return view('reward_type_mappings.edit', compact('rewardTypeMapping', 'rewardSites', 'rewardSubmitTypes'));
    }

    /**
     * Update the specified reward type mapping in the storage.
     *
     * @param int $id
     * @param Illuminate\Http\Request $request
     *
     * @return \Illuminate\Http\RedirectResponse | \Illuminate\Routing\Redirector
     */
    public function update($id, Request $request)
    {

        $data = $this->getData($request);

        $rewardTypeMapping = RewardTypeMapping::findOrFail($id);
        $rewardTypeMapping->update($data);

        return redirect()->route('reward_type_mappings.reward_type_mapping.index')
            ->with('success_message', 'Reward Type Mapping was successfully updated.');
    }

    /**
     * Remove the specified reward type mapping from the storage.
     *
     * @param int $id
     *
     * @return \Illuminate\Http\RedirectResponse | \Illuminate\Routing\Redirector
     */
    public function destroy($id)
    {
        try {
            $rewardTypeMapping = RewardTypeMapping::findOrFail($id);
            $rewardTypeMapping->delete();

            return redirect()->route('reward_type_mappings.reward_type_mapping.index')
                ->with('success_message', 'Reward Type Mapping was successfully deleted.');
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
            'reward_site_id' => [
                'nullable',
                // Ensure the combination of reward_site_id and reward_submit_type_id is unique
                Rule::unique('reward_type_mappings')->where(function ($query) use ($request) {
                    return $query->where('reward_submit_type_id', $request->reward_submit_type_id);
                })
            ],
            'reward_submit_type_id' => 'nullable',
            'reward_amount' => 'string|min:1|nullable',
            'is_active' => 'boolean|nullable',
        ];


        $data = $request->validate($rules);


        $data['is_active'] = $request->has('is_active');


        return $data;
    }
}
