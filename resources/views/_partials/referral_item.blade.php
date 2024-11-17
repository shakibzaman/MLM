@php
  if ($displayedUsers->contains($user->id)) {
      return; // Skip if this user has already been displayed
  }
  $displayedUsers->push($user->id); // Add user ID to the displayed collection
@endphp

<li class="list-unstyled">
  <a href="#" class="targaryen menu-item text-reset text-decoration-none" data-bs-toggle="collapse" data-bs-target="#subscribers-{{ $user->id }}" aria-expanded="false" aria-controls="subscribers-{{ $user->id }}">
    @if ($user->subscribers->isNotEmpty()) + @endif {{ $user->name }}
  </a>
  @if ($user->subscribers->isNotEmpty())
    <ul class="collapse" id="subscribers-{{ $user->id }}">
      @foreach ($user->subscribers as $referral)
        @include('_partials.referral_item', ['user' => $referral, 'displayedUsers' => $displayedUsers])
      @endforeach
    </ul>
  @endif
</li>

