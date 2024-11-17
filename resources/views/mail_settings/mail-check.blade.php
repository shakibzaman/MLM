<h5>SMTP Connection</h5>
<form action="" method="POSt">
    @csrf
    <div class="form-group">
        <label for="">Your Email</label>
        <input type="email" name="email" class="form-control">
    </div>

    <button type="submit" class="form-control btn btn-info">Check Now</button>
</form>