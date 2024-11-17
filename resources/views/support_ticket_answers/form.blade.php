
<div class="mb-3 row">
    <label for="support_ticket_id" class="col-form-label text-lg-end col-lg-2 col-xl-3">Support Ticket</label>
    <div class="col-lg-10 col-xl-9">
        <select class="form-select{{ $errors->has('support_ticket_id') ? ' is-invalid' : '' }}" id="support_ticket_id" name="support_ticket_id">
        	    <option value="" style="display: none;" {{ old('support_ticket_id', optional($supportTicketAnswer)->support_ticket_id ?: '') == '' ? 'selected' : '' }} disabled selected>Select support ticket</option>
        	@foreach ($supportTickets as $key => $supportTicket)
			    <option value="{{ $key }}" {{ old('support_ticket_id', optional($supportTicketAnswer)->support_ticket_id) == $key ? 'selected' : '' }}>
			    	{{ $supportTicket }}
			    </option>
			@endforeach
        </select>
        
        {!! $errors->first('support_ticket_id', '<div class="invalid-feedback">:message</div>') !!}
    </div>
</div>

<div class="mb-3 row">
    <label for="answer" class="col-form-label text-lg-end col-lg-2 col-xl-3">Answer</label>
    <div class="col-lg-10 col-xl-9">
        <input class="form-control{{ $errors->has('answer') ? ' is-invalid' : '' }}" name="answer" type="text" id="answer" value="{{ old('answer', optional($supportTicketAnswer)->answer) }}" minlength="1" placeholder="Enter answer here...">
        {!! $errors->first('answer', '<div class="invalid-feedback">:message</div>') !!}
    </div>
</div>

<div class="mb-3 row">
    <label for="user_id" class="col-form-label text-lg-end col-lg-2 col-xl-3">User</label>
    <div class="col-lg-10 col-xl-9">
        <select class="form-select{{ $errors->has('user_id') ? ' is-invalid' : '' }}" id="user_id" name="user_id">
        	    <option value="" style="display: none;" {{ old('user_id', optional($supportTicketAnswer)->user_id ?: '') == '' ? 'selected' : '' }} disabled selected>Select user</option>
        	@foreach ($users as $key => $user)
			    <option value="{{ $key }}" {{ old('user_id', optional($supportTicketAnswer)->user_id) == $key ? 'selected' : '' }}>
			    	{{ $user }}
			    </option>
			@endforeach
        </select>
        
        {!! $errors->first('user_id', '<div class="invalid-feedback">:message</div>') !!}
    </div>
</div>

