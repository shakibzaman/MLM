<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use App\Models\Customer;
use App\Models\ExtraReward;
use App\Models\RewardSite;
use App\Models\RewardSubmitType;
use App\Models\RewardTypeMapping;
use Illuminate\Http\Request;
use Exception;
use Illuminate\Support\Facades\Auth;

class RewardSitesController extends Controller
{

    /**
     * Display a listing of the reward sites.
     *
     * @return \Illuminate\View\View
     */
    public function index()
    {
        $rewardSites = RewardSite::paginate(25);

        return view('reward_sites.index', compact('rewardSites'));
    }

    /**
     * Show the form for creating a new reward site.
     *
     * @return \Illuminate\View\View
     */
    public function create()
    {


        return view('reward_sites.create');
    }

    /**
     * Store a new reward site in the storage.
     *
     * @param Illuminate\Http\Request $request
     *
     * @return \Illuminate\Http\RedirectResponse | \Illuminate\Routing\Redirector
     */
    public function store(Request $request)
    {

        $data = $this->getData($request);

        RewardSite::create($data);

        return redirect()->route('reward_sites.reward_site.index')
            ->with('success_message', 'Reward Site was successfully added.');
    }

    /**
     * Display the specified reward site.
     *
     * @param int $id
     *
     * @return \Illuminate\View\View
     */
    public function show($id)
    {
        $rewardSite = RewardSite::findOrFail($id);

        return view('reward_sites.show', compact('rewardSite'));
    }

    /**
     * Show the form for editing the specified reward site.
     *
     * @param int $id
     *
     * @return \Illuminate\View\View
     */
    public function edit($id)
    {
        $rewardSite = RewardSite::findOrFail($id);


        return view('reward_sites.edit', compact('rewardSite'));
    }

    /**
     * Update the specified reward site in the storage.
     *
     * @param int $id
     * @param Illuminate\Http\Request $request
     *
     * @return \Illuminate\Http\RedirectResponse | \Illuminate\Routing\Redirector
     */
    public function update($id, Request $request)
    {

        $data = $this->getData($request);

        $rewardSite = RewardSite::findOrFail($id);
        $rewardSite->update($data);

        return redirect()->route('reward_sites.reward_site.index')
            ->with('success_message', 'Reward Site was successfully updated.');
    }

    /**
     * Remove the specified reward site from the storage.
     *
     * @param int $id
     *
     * @return \Illuminate\Http\RedirectResponse | \Illuminate\Routing\Redirector
     */
    public function destroy($id)
    {
        try {
            $rewardSite = RewardSite::findOrFail($id);
            $rewardSite->delete();

            return redirect()->route('reward_sites.reward_site.index')
                ->with('success_message', 'Reward Site was successfully deleted.');
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
            'url' => 'string|min:1|nullable',
            'is_active' => 'boolean|nullable',
        ];


        $data = $request->validate($rules);


        $data['is_active'] = $request->has('is_active');


        return $data;
    }

    public function extraRewards()
    {

        $customer = Auth::guard('customer')->user();
        $extraRewardQuery = ExtraReward::with('reward_mapping')->where('customer_id', $customer->id);
        $extraRewards = $extraRewardQuery->get();
        $extraRewardId = $extraRewardQuery->where('status', 2)->pluck('reward_mapping_id');



        $rewardMappingsiteQuery = RewardTypeMapping::with(['rewardSite', 'rewardSubmitType'])
            ->whereNotIn('id', $extraRewardId);
        $rewardMappingsites = $rewardMappingsiteQuery->get();
        $rewardMappingsitesPluck = $rewardMappingsiteQuery->pluck('reward_site_id')->unique();
        $sites = RewardSite::whereIn('id', $rewardMappingsitesPluck)->get();
        return view('customer.rewards.index', compact('sites', 'rewardMappingsites', 'extraRewards', 'customer'));
    }
    public function extraRewardList($type = null)
    {
        $statusLabels = config('app.statuses');

        $statusType = $statusLabels[strtolower($type)] ?? null;
        $reward_query = ExtraReward::with('customer', 'reward_mapping', 'reward_mapping.rewardSite', 'reward_mapping.rewardSubmitType');
        if ($statusType != null) {
            $rewards_list = $reward_query->where('status', $statusType)->paginate(20);
        } else {
            $rewards_list = $reward_query->paginate(20);
        }
        return view('extra_reward.index', compact('rewards_list', 'type'));
    }

    public function extraRewardShow($id)
    {
        $reward = ExtraReward::with('changeby', 'customer', 'reward_mapping', 'reward_mapping.rewardSite', 'reward_mapping.rewardSubmitType')->where('id', $id)->first();
        return view('extra_reward.modal.view', compact('reward'));
    }
    public function extraRewardUpdate(Request $request, $id)
    {
        try {
            $reward = ExtraReward::where('id', $id)->first();
            info('Reward ', [$reward]);

            $reward->status = $request->status;
            $reward->status_change_by = Auth::user()->id;
            $reward->status_change_date = now();
            $update_reward = $reward->save();

            $reward_mapping = RewardTypeMapping::where('id', $reward->reward_mapping_id)->first();
            info('Reward type', [$reward_mapping]);

            if ($update_reward) {
                if ($request->status == config('app.statuses.approved')) {
                    $customer = Customer::where('id', $reward->customer_id)->first();
                    if ($customer) {
                        $customer->reward_point += $reward_mapping->reward_amount;
                        $customer->save();
                    }
                }
            }
            return redirect()->back()->with('success', 'Status Changed successful.');
        } catch (Exception $e) {
            return redirect()->back()->with('error', 'Sorry Reward point added failed.');
        }
    }

    public function extraRewardStore(Request $request)
    {
        // Validate the file is an image and URL field
        $request->validate([
            'image_upload' => 'required|image|mimes:jpeg,png,jpg,gif|max:2048',
            'url' => 'required|url',  // Add validation for the URL field
        ], [
            'image_upload.required' => 'Please upload an image.',
            'image_upload.image' => 'The file must be an image.',
            'image_upload.mimes' => 'The image must be a file of type: jpeg, png, jpg, gif.',
            'image_upload.max' => 'The image size should not exceed 2MB.',
            'url.required' => 'Please enter a valid URL.',
            'url.url' => 'The URL must be a valid format.',
        ]);

        $extra_reward =  ExtraReward::where('reward_mapping_id', $request->review_from)
            ->where('customer_id', Auth::guard('customer')->user()->id)
            ->first();

        // Handle the image upload
        if ($request->file('image_upload')) {
            $file = $request->file('image_upload');
            $fileName = time() . '_' . $file->getClientOriginalName();
            $filePath = $file->storeAs('uploads', $fileName, 'public'); // Store in the 'uploads' directory inside 'public'
            if ($extra_reward) {
                $extra_reward->image = $filePath;
                $extra_reward->url = $request->url;
                $extra_reward->status = 1;
                $extra_reward->save();
            } else {
                // Now, save the data in the ExtraReward model
                $extraReward = ExtraReward::create([
                    'reward_mapping_id' => $request->review_from,
                    'image' => $filePath,  // Save the path of the uploaded image
                    'url' => $request->url,
                    'status' => 1,
                    'customer_id' => Auth::guard('customer')->user()->id,
                    // Save the store URL
                ]);
            }

            // Return with success message
            return back()->with('success', 'Image and URL uploaded successfully!');
        }


        // If no image is uploaded, return an error
        return back()->with('error', 'Failed to upload image.');
    }
}
