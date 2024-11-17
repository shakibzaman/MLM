<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use App\Models\RankReward;
use Illuminate\Http\Request;
use Exception;

class RankRewardsController extends Controller
{

    /**
     * Display a listing of the rank rewards.
     *
     * @return \Illuminate\View\View
     */
    public function index()
    {
        $rankRewards = RankReward::paginate(25);

        return view('rank_rewards.index', compact('rankRewards'));
    }

    /**
     * Show the form for creating a new rank reward.
     *
     * @return \Illuminate\View\View
     */
    public function create()
    {


        return view('rank_rewards.create');
    }

    /**
     * Store a new rank reward in the storage.
     *
     * @param Illuminate\Http\Request $request
     *
     * @return \Illuminate\Http\RedirectResponse | \Illuminate\Routing\Redirector
     */
    public function store(Request $request)
    {

        $data = $this->getData($request);

        RankReward::create($data);

        return redirect()->route('rank_rewards.rank_reward.index')
            ->with('success_message', 'Rank Reward was successfully added.');
    }

    /**
     * Display the specified rank reward.
     *
     * @param int $id
     *
     * @return \Illuminate\View\View
     */
    public function show($id)
    {
        $rankReward = RankReward::findOrFail($id);

        return view('rank_rewards.show', compact('rankReward'));
    }

    /**
     * Show the form for editing the specified rank reward.
     *
     * @param int $id
     *
     * @return \Illuminate\View\View
     */
    public function edit($id)
    {
        $rankReward = RankReward::findOrFail($id);


        return view('rank_rewards.edit', compact('rankReward'));
    }

    /**
     * Update the specified rank reward in the storage.
     *
     * @param int $id
     * @param Illuminate\Http\Request $request
     *
     * @return \Illuminate\Http\RedirectResponse | \Illuminate\Routing\Redirector
     */
    public function update($id, Request $request)
    {

        $data = $this->getData($request);

        $rankReward = RankReward::findOrFail($id);
        $rankReward->update($data);

        return redirect()->route('rank_rewards.rank_reward.index')
            ->with('success_message', 'Rank Reward was successfully updated.');
    }

    /**
     * Remove the specified rank reward from the storage.
     *
     * @param int $id
     *
     * @return \Illuminate\Http\RedirectResponse | \Illuminate\Routing\Redirector
     */
    public function destroy($id)
    {
        try {
            $rankReward = RankReward::findOrFail($id);
            $rankReward->delete();

            return redirect()->route('rank_rewards.rank_reward.index')
                ->with('success_message', 'Rank Reward was successfully deleted.');
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
            'bonus' => 'min:1|nullable|numeric',
            'minimum_referrals' => 'min:1|nullable|numeric',
            'direct_referrals' => 'min:1|nullable|numeric',
            'active_subscribers' => 'min:1|nullable|numeric',
            'earnings' => 'min:1|nullable|numeric',
            'days' => 'min:1|nullable|numeric',
            'badge' => ['file','nullable'],
        ];


        $data = $request->validate($rules);

        if ($request->has('custom_delete_badge')) {
            $data['badge'] = null;
        }
        if ($request->hasFile('badge')) {
            $data['badge'] = $this->moveFile($request->file('badge'));
        }



        return $data;
    }

    /**
     * Moves the attached file to the server.
     *
     * @param \Symfony\Component\HttpFoundation\File\UploadedFile $file
     *
     * @return string
     */
    protected function moveFile($file)
    {
        if (!$file->isValid()) {
            return '';
        }

        $path = config('laravel-code-generator.files_upload_path', 'uploads');
        $saved = $file->store('public/' . $path, config('filesystems.default'));

        return substr($saved, 7);
    }

    public function badges()
    {
      $badges = RankReward::all();

      return view('customer.badges.index', compact('badges'));
    }

}
