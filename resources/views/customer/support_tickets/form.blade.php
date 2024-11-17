
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


