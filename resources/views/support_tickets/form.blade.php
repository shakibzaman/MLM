<div class="mb-3 row">
    <label for="title" class="col-form-label text-lg-end col-lg-2 col-xl-3">Name</label>
    <div class="col-lg-10 col-xl-9">
        <input class="form-control{{ $errors->has('name') ? ' is-invalid' : '' }}" name="name" type="text" id="title" value="" minlength="1" maxlength="255" placeholder="Enter name here...">
        {!! $errors->first('title', '<div class="invalid-feedback">:message</div>') !!}
    </div>
</div>
<div class="mb-3 row">
    <label for="email" class="col-form-label text-lg-end col-lg-2 col-xl-3">Email</label>
    <div class="col-lg-10 col-xl-9">
        <input pattern="[a-z0-9._%+-]+@[a-z0-9.-]+\.[a-z]{2,}$"  class="form-control{{ $errors->has('email') ? ' is-invalid' : '' }}" name="email" type="email" id="email" placeholder="Enter email here..." required>
        {!! $errors->first('email', '<div class="invalid-feedback">:message</div>') !!}
    </div>
</div>
<div class="mb-3 row">
    <label for="department" class="col-form-label text-lg-end col-lg-2 col-xl-3">Department</label>
    <div class="col-lg-10 col-xl-9">
        <select class="form-control form-select {{ $errors->has('department') ? ' is-invalid' : '' }}" id="department" name="department">
            <option value="General information" >General information</option>
            <option value="Payment issue" >Payment issue</option>
            <option value="Membership support" >Membership support</option>
            <option value="Payment confirmation" >Payment confirmation</option>
        </select>

        {!! $errors->first('department', '<div class="invalid-feedback">:message</div>') !!}
    </div>
</div>
<div class="mb-3 row">
    <label for="title" class="col-form-label text-lg-end col-lg-2 col-xl-3">Title</label>
    <div class="col-lg-10 col-xl-9">
        <input class="form-control{{ $errors->has('title') ? ' is-invalid' : '' }}" name="title" type="text" id="title" value="{{ old('title', optional($supportTicket)->title) }}" minlength="1" maxlength="255" placeholder="Enter title here...">
        {!! $errors->first('title', '<div class="invalid-feedback">:message</div>') !!}
    </div>
</div>

<div class="mb-3 row">
    <label for="description" class="col-form-label text-lg-end col-lg-2 col-xl-3">Description</label>
    <div class="col-lg-10 col-xl-9">
        <textarea class="form-control{{ $errors->has('description') ? ' is-invalid' : '' }}" name="description" id="description" minlength="1" maxlength="1000">{{ old('description', optional($supportTicket)->description) }}</textarea>
        {!! $errors->first('description', '<div class="invalid-feedback">:message</div>') !!}
    </div>
</div>

<div class="mb-3 row">
    <label for="status" class="col-form-label text-lg-end col-lg-2 col-xl-3">Status</label>
    <div class="col-lg-10 col-xl-9">
        <select class="form-control form-select {{ $errors->has('status') ? ' is-invalid' : '' }}" id="status" name="status">
            <option value="open" >Open</option>
            <option value="closed" >Closed</option>
        </select>
        {!! $errors->first('status', '<div class="invalid-feedback">:message</div>') !!}
    </div>
</div>

<div class="mb-3 row">
    <label for="is_active" class="col-form-label text-lg-end col-lg-2 col-xl-3">Is Active</label>
    <div class="col-lg-10 col-xl-9">
        <div class="form-check checkbox">
            <input id="is_active_1" class="form-check-input" name="is_active" type="checkbox" value="1" {{ old('is_active', optional($supportTicket)->is_active) == '1' ? 'checked' : '' }}>
            <label class="form-check-label" for="is_active_1">
                Yes
            </label>
        </div>


        {!! $errors->first('is_active', '<div class="invalid-feedback">:message</div>') !!}
    </div>
</div>

