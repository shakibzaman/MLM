@extends('layouts/layoutMaster')

@section('title',  __('genealogy_tree'))
@section('page-style')
  <!-- Page -->
  <style>
    /*Now the CSS*/
    .tree ul {
      padding-top: 20px;
      position: relative;
      transition: all 0.5s;
      -webkit-transition: all 0.5s;
      -moz-transition: all 0.5s;
    }
    .tree ul::before {
      content: '';
      position: absolute;
      top: 0;
      left: 50%;
      border-left: 1px solid #ccc;
      width: 0;
      height: 20px;
    }
    .tree li {
      float: left;
      text-align: center;
      list-style-type: none;
      position: relative;
      padding: 20px 5px 0 5px;
      transition: all 0.5s;
      -webkit-transition: all 0.5s;
      -moz-transition: all 0.5s;
    }
    .tree li::before, .tree li::after {
      content: '';
      position: absolute;
      top: 0;
      right: 50%;
      border-top: 1px solid #ccc;
      width: 50%;
      height: 20px;
    }
    .tree li::after {
      right: auto;
      left: 50%;
      border-left: 1px solid #ccc;
    }
    .tree li:only-child::after, .tree li:only-child::before {
      display: none;
    }
    .tree li:only-child {
      padding-top: 0;
    }
    .tree li:first-child::before, .tree li:last-child::after {
      border: 0 none;
    }
    .tree li:last-child::before {
      border-right: 1px solid #ccc;
      border-radius: 0 5px 0 0;
      -webkit-border-radius: 0 5px 0 0;
      -moz-border-radius: 0 5px 0 0;
    }
    .tree li:first-child::after {
      border-radius: 5px 0 0 0;
      -webkit-border-radius: 5px 0 0 0;
      -moz-border-radius: 5px 0 0 0;
    }
    .tree li:first-child::after {
      border-radius: 5px 0 0 0;
      -webkit-border-radius: 5px 0 0 0;
      -moz-border-radius: 5px 0 0 0;
    }
    .tree li a {
      border: 1px solid #ccc;
      padding: 5px 10px;
      text-decoration: none;
      color: #666;
      font-family: arial, verdana, tahoma;
      font-size: 12px;
      display: inline-block;
      border-radius: 5px;
      -webkit-border-radius: 5px;
      -moz-border-radius: 5px;
      transition: all 0.5s;
      -webkit-transition: all 0.5s;
      -moz-transition: all 0.5s;
    }
    .tree li a:hover, .tree li a:hover + ul li a {
      background: #c8e4f8;
      color: #000;
      border: 1px solid #94a0b4;
    }
    .tree li a:hover + ul li::after, .tree li a:hover + ul li::before, .tree li a:hover + ul::before, .tree li a:hover + ul ul::before {
      border-color: #94a0b4;
    }
    .tree li a.targaryen {
      background: black;
      color: white;
    }
    .tree li a.stark {
      background: #aea79f;
      color: black;
    }
    .tree li a.lannister {
      background: #c5000b;
      color: white;
    }
    .tree li a.baratheon {
      background: #fc0;
      color: black;
    }
    .parents {
      border: solid 1px #ccc;
      padding: 5px;
      border-radius: 5px;
    }
    .spacer {
      display: inline;
    }

    .tree{
      width: max-content;
    }
    .card{
      overflow: hidden;
    }

    .card-body{
      overflow-x: scroll;
    }


    /* Hide the card by default */
    .udetails {
      display: none;
      position: fixed;

      padding: 10px;
      width: auto;
      background: white;
      border: 1px solid #ddd;
      box-shadow: 0px 4px 8px rgba(0, 0, 0, 0.2);
      border-radius: 5px;
      z-index: 10;
      overflow: hidden;
    }

    /* Display the card when the link is hovered */
    .targaryen:hover + .udetails {
      display: block;
    }

    /* Spike pointing upwards */
    .udetails::before {
      content: "";
      position: absolute;
      bottom: 100%; /* Place spike above the box */
      left: 10px;   /* Position it towards the start */
      border-width: 10px 10px 0 10px;
      border-style: solid;
      border-color: #ddd transparent transparent transparent;
      z-index: 10;
    }
  </style>
@endsection

@section('content')
  <script>
    document.addEventListener("DOMContentLoaded", function() {
      const links = document.querySelectorAll('.targaryen');

      links.forEach(link => {
        link.addEventListener("mouseover", function() {
          const details = link.nextElementSibling;
          const rect = link.getBoundingClientRect();

          // Position .udetails below the link
          details.style.display = 'block';
          details.style.top = `${rect.bottom + window.scrollY + 10}px`; // Place 10px below the link
          details.style.left = `${rect.left + window.scrollX}px`; // Align left with the link
        });

        link.addEventListener("mouseout", function() {
          const details = link.nextElementSibling;
          details.style.display = 'none';
        });
      });
    });

  </script>
  <div class="raw">
    <div class="col-md-12">
      <div class="card">
        <h5 class="card-header">{{ __('genealogy_tree') }}</h5>
        <hr class="m-0" />
        <div class="card-body">
          <div class="tree">
            <ul>
              <li>
                <a href="#" class=''>{{ auth()->guard('customer')->user()? auth()->guard('customer')->user()->name : 'Admin' }}</a>
                @php
                  $displayedUsers = collect(); // Initialize an empty collection to track displayed users
                @endphp

                <ul>
                  @foreach ($customers as $customer)
                    @include('_partials.tree_item', ['user' => $customer, 'displayedUsers' => $displayedUsers])
                  @endforeach
                </ul>
              </li>
            </ul>
          </div>
        </div>
        <hr class="m-0" />
      </div>
    </div>
  </div>
@endsection
@section('vendor-script')
    <script>

      window.onload = function() {
        const card = document.querySelector('.card-body');
        const scrollWidth = card.scrollWidth;
        const clientWidth = card.clientWidth;

        // Calculate the position to scroll to
        const scrollPosition = (scrollWidth - clientWidth) / 2;

        // Scroll to the calculated position
        card.scrollLeft = scrollPosition;
      };
    </script>
@endsection

