@extends('layouts/layoutMaster')

@section('title', 'Faqs')

@section('content')

  <div class="row mt-6">
    <!-- FAQ's -->
    <div class="col-lg-12 col-md-12 col-12">
      <div class="tab-content p-0">

          <div class="d-flex mb-4 gap-4">
            <div class="avatar avatar-md">
              <div class="avatar-initial bg-label-primary rounded">
                <i class="ti ti-credit-card ti-30px"></i>
              </div>
            </div>
            <div>
              <h5 class="mb-0">
                <span class="align-middle">FAQs</span>
              </h5>
              <span>Get help with faq</span>
            </div>
          </div>
          <div id="accordionPayment" class="accordion">
            @foreach($faqs as $i => $faq)
              <div class="card accordion-item @if($i == 0) active @endif">
              <h2 class="accordion-header">
                <button
                  class="accordion-button @if($i != 0) collapsed @endif"
                  type="button"
                  data-bs-toggle="collapse"
                  aria-expanded="true"
                  data-bs-target="#accordionPayment-{{ $faq->id }}"
                  aria-controls="accordionPayment-{{ $faq->id }}">
                  {{ $faq->title }}
                </button>
              </h2>
              <div id="accordionPayment-{{ $faq->id }}" class="accordion-collapse collapse @if($i == 0) show @endif">
                <div class="accordion-body">
                  {{ $faq->description }}
                </div>
              </div>
            </div>
            @endforeach
          </div>

      </div>
    </div>
    <!-- /FAQ's -->
  </div>

  <!-- Contact -->
  <div class="row my-6">
    <div class="col-12 text-center my-6">
      <div class="badge bg-label-primary">Question?</div>
      <h4 class="my-2">You still have a question?</h4>
      <p class="mb-0">
        If you can't find question in our FAQ, you can contact us. We'll answer you shortly!
      </p>
    </div>
  </div>
  <div class="row justify-content-center gap-sm-0 gap-6">
    <div class="col-sm-6">
      <div class="py-6 rounded bg-faq-section d-flex align-items-center flex-column">
        <div class="avatar avatar-md">
                      <span class="avatar-initial bg-label-primary rounded">
                        <i class="ti ti-phone ti-26px"></i>
                      </span>
        </div>
        <h5 class="mt-4 mb-1"><a class="text-heading" href="tel:+(1)25482568">+(1) 2548 2568</a></h5>
        <p class="mb-0">We are always happy to help</p>
      </div>
    </div>
    <div class="col-sm-6">
      <div class="py-6 rounded bg-faq-section d-flex align-items-center flex-column">
        <div class="avatar avatar-md">
                      <span class="avatar-initial bg-label-primary rounded">
                        <i class="ti ti-mail ti-26px"></i>
                      </span>
        </div>
        <h5 class="mt-4 mb-1"><a class="text-heading" href="mailto:help@help.com">help@help.com</a></h5>
        <p class="mb-0">Best way to get a quick answer</p>
      </div>
    </div>
  </div>
  <!-- /Contact -->

@endsection
