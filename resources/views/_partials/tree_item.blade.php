@php
  if ($displayedUsers->contains($user->id)) {
      return; // Skip if this user has already been displayed
  }
  $displayedUsers->push($user->id); // Add user ID to the displayed collection
@endphp

<li style="position: relative;">
  <a href="#" class="targaryen">{{ $user->name }}</a>
  <div class="udetails">
    <div class="p-1 text-start overflow-hidden" style="font-size: 12px;">
    <span>Name: {{ $user->name }}</span> <br>
    <span>Email: {{ $user->email }}</span> <br>
    <span>Phone: {{ $user->phone }}</span> <br>
    <span>Balance: {{ $user->balance }}</span> <br>
    <span>LM package: {{ $user->lifetimePackage?->name }}</span> <br>
    <span>MS package: {{ $user->monthlyPackage?->name }}</span> <br>
    <span>Status:  @if($user->status == 1) Active @elseif($user->status == 2) Inactive @elseif($user->status == 3) Baned @endif </span> <br>
    </div>
  </div>
  @if ($user->subscribers->isNotEmpty())
    <ul>
      @foreach ($user->subscribers as $referral)
        @include('_partials.tree_item', ['user' => $referral, 'displayedUsers' => $displayedUsers])
      @endforeach
    </ul>
  @endif
</li>
