<div class="form-group">
    <input class="form-control" type="text" name="title" placeholder="Название" value="{{ (isset($post)) ? $post->title : old('title') }}">
    @error('title') <span class="invalid-feedback" role="alert"><strong>{{ $message }}</strong></span> @enderror
</div>
<div class="form-group">
    <textarea class="form-control" name="content" id="" cols="30" rows="5" placeholder="Текст">{{ (isset($post)) ? $post->content : old('content') }}</textarea>
    @error('content') <span class="invalid-feedback" role="alert"><strong>{{ $message }}</strong></span> @enderror
</div>

@if(isset($post) && !empty($post->image))
    <div class="image-block my-3 w-25">
        <img src="{{ url('images/'. $post->image) }}" class="rounded mw-100" alt="{{ $post->title }}">
    </div>
@endif

<input type="hidden" name="type" value="{{ $type }}">

<div class="form-group">
    <input class="form-control" type="file" name="image" accept="image/*">
    @error('image') <span class="invalid-feedback" role="alert"><strong>{{ $message }}</strong></span> @enderror
</div>
<div class="form-group">
    <button type="submit" class="btn btn-primary">{{ ($type == 'create') ? 'Создать' : 'Обновить' }}</button>
</div>
