<div class="mb-3">
    <label for="{{$name}}" class="form-label">{{$title}}</label>
    <input class="form-control" id="{{$name}}" name="{{$name}}" value="{{old($name, $value)}}">
</div>

@error($name)
<div class="alert alert-danger mt-3">{{$message}}</div>
@enderror
