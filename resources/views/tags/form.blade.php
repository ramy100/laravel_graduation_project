<div class="form-group">
    <label for="name">Name</label>
    <input type="text" name="name" placeholder="name" value="{{ old('name') ?? $tag->name}}" class="form-control">
</div>
<div><span class="text-muted">{{$errors->first('name') }}</span></div>

@csrf