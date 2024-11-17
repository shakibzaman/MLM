$(document).ready(function() {

  $.ajaxSetup({
    headers: {
      'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
    }
  });
    $(document).on('change','.annual.switch-success .switch-input',function (){
      const isChecked = $(this).is(':checked');
      const customerId = $(this).data('customer-id');
      const data = {
        customer_id: customerId,
        lifetime_package: isChecked, // Send whether it's checked or not
        status: 'inactive'
      };
      lifetimeajax(data);

    });

  $(document).on('change','.annual.switch-danger .switch-input',function (){
    const isChecked = $(this).is(':checked');
    const customerId = $(this).data('customer-id');
    const data = {
      customer_id: customerId,
      lifetime_package: isChecked, // Send whether it's checked or not
      status: 'active'
    };
    lifetimeajax(data);

  });

  function lifetimeajax(data)
  {
    $.ajax({
      url: '/lifetime-activation', // Replace with your actual endpoint
      type: 'POST', // Use 'GET' or 'POST' as required
      data: data,
      success: function(response) {
        console.log('Success:', response);
        alert('Activation Successful')
        setTimeout(function() {
          location.reload();
        }, 1000);
        // Optionally handle successful response (e.g., show a message)
      },
      error: function(xhr, status, error) {
        console.error('Error:', error);
        // Optionally handle error response
      }
    });
  }



  $(document).on('change','.monthly.switch-success .switch-input',function (){
    const isChecked = $(this).is(':checked');
    const customerId = $(this).data('customer-id');
    const data = {
      customer_id: customerId,
      lifetime_package: isChecked, // Send whether it's checked or not
      status: 'inactive'
    };
    monthlyajax(data);

  });

  $(document).on('change','.monthly.switch-danger .switch-input',function (){
    const isChecked = $(this).is(':checked');
    const customerId = $(this).data('customer-id');
    const data = {
      customer_id: customerId,
      lifetime_package: isChecked, // Send whether it's checked or not
      status: 'active'
    };
    monthlyajax(data);

  });

  function monthlyajax(data)
  {
    $.ajax({
      url: '/monthly-activation', // Replace with your actual endpoint
      type: 'POST', // Use 'GET' or 'POST' as required
      data: data,
      success: function(response) {
        console.log('Success:', response);
        if (response.status == 'success') {
          alert(response.message);
        } else if (response.status == 'error') {
          alert(response.message);
        }
        setTimeout(function() {
          location.reload();
        }, 1000);
        // Optionally handle successful response (e.g., show a message)
      },
      error: function(xhr, status, error) {
        console.error('Error:', error);
        // Optionally handle error response
      }
    });
  }
})
