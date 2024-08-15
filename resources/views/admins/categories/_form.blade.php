

<div class="row">
    <div class="col-6">
        <div class="mb-3">
            <label >English Name</label>
            <input type="text" name="name_en" placeholder="English Name" class="form-control @error('name_en')
            is-invalid @enderror" value="{{ old('name_en', @$item->name_en) }}">
            @error('name_en')
                <small class="text-danger">{{ $message }}</small>
            @enderror
        </div>
    </div>
    <div class="col-6">
        <div class="mb-3">
            <label >Arabic Name</label>
            <input type="text" name="name_ar" placeholder="Arabic Name" class="form-control @error('name_ar')
            is-invalid @enderror" value="{{ old('name_ar', @$item->name_ar) }}">
            @error('name_ar')
                <small class="text-danger">{{ $message }}</small>
            @enderror
        </div>
    </div>
</div>
<div class="row">
    <div class="col-6">
        <div class="mb-3">
            <label >English Description</label>
            <textarea name="description_en" placeholder="English Description" class="form-control @error('description_en')
            is-invalid @enderror" rows="5">{{ old('description_en', @$item->description_en) }}</textarea>

            @error('description_en')
                <small class="text-danger">{{ $message }}</small>
            @enderror
        </div>
    </div>
    <div class="col-6">
        <div class="mb-3">
            <label >Arabic Description</label>
            <textarea name="description_ar" placeholder="Arabic Description" class="form-control @error('description_ar')
            is-invalid @enderror" rows="5">{{ old('description_ar', @$item->description_ar) }}</textarea>

            @error('description_ar')
                <small class="text-danger">{{ $message }}</small>
            @enderror
        </div>
    </div>
</div>
<div class="mb-3">
    <label >Image</label>
    <input type="file" name="image" class="form-control @error('image')
    is-invalid @enderror" onchange="showImg(event)">
    @error('image')
        <small class="text-danger">{{ $message }}</small>
    @enderror
    <div class="mt-3">
        <img id="previwe" src="{{ @$item->img_path }}" width="350px">
    </div>
</div>
<button class="btn btn-success"><i class="fas fa-save"> Update</i></button>
