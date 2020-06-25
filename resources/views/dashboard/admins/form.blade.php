<div class="form-group">
    <label for="name">Name</label>
    <input type="text" name="name" placeholder="name" value="{{ old('name') ?? $admin->name}}" class="form-control">
</div>
<div><span class="text-muted">{{$errors->first('name') }}</span></div>

<div class="form-group">
    <label for="name">Email</label>
    <input type="text" name="email" placeholder="email" value="{{ old('email') ?? $admin->email}}" class="form-control">
</div>
<div><span class="text-muted">{{$errors->first('email') }}</span></div>

<div class="form-group">
    <label for="name">Password</label>
    <input type="text" name="password" placeholder="password" value="{{ old('password') ?? $admin->password}}" class="form-control">
</div>
<div><span class="text-muted">{{$errors->first('password') }}</span></div>
  
@csrf