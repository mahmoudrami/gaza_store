

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
<div class="row">
    <div class="col-6">
        <div class="mb-3">
            <label >Image</label>
            <input type="file" name="image" id="main-image" class="form-control @error('image')
            is-invalid @enderror" onchange="showImg(event)">
            @error('image')
                <small class="text-danger">{{ $message }}</small>
            @enderror
            <div class="mt-3">
                <label for="main-image"><img id="previwe" src="{{ @$item->img_path }}"
                    style="object-fit: cover" width="150px" height="150px"></label>
            </div>
        </div>
    </div>
    <div class="col-6">
        <div class="mb-3">
            <label >Gallery</label>
            <input type="file" name="gallery[]" multiple class="form-control @error('gallery')
            is-invalid @enderror">
            @error('gallery')
                <small class="text-danger">{{ $message }}</small>
            @enderror
            @if (@isset($item))
            <div class="row">
                @foreach (@$item->gallery as $one)
                    <div class="col-3 mt-3 wrapper-delete">
                        <img id="" src="{{ asset('images/products/'. @$one->path) }}"
                        width="150px" height="150px" style="object-fit: cover">
                        <span onclick="delimg(event,Idimg = {{ @$one->id }})">X</span>

                    </div>
                @endforeach
            </div>
            @endif


        </div>
    </div>
</div>
<div class="row">
    <div class="col-4">
        <div class="mb-3">
            <label >Price</label>
            <input type="number" name="price" class="form-control @error('price')
            is-invalid @enderror" value="{{ old('price', @$item->price) }}">
            @error('price')
                <small class="text-danger">{{ $message }}</small>
            @enderror
        </div>
    </div>
    <div class="col-4">
        <div class="mb-3">
            <label >Quantity</label>
            <input type="number" name="quantity" class="form-control @error('quantity')
            is-invalid @enderror" value="{{ old('quantity', @$item->quantity) }}">
            @error('quantity')
                <small class="text-danger">{{ $message }}</small>
            @enderror
        </div>
    </div>
    <div class="col-4">
        <div class="mb-3">
            <label>Category</label><br>
            <select name="category_id" class="form-control @error('category_id') is-invalid @enderror">
                    <option value="">Chosse</option>
                @foreach ($categories as $category)
                    <option value="{{ $category->id }}" @selected(@$category->id == @$item->category->id)>{{ $category->trans_name }}</option>
                @endforeach
                @error('quantity')
                <small class="text-danger">{{ $message }}</small>
            @enderror
            </select>
        </div>
    </div>
</div>
<button class="btn btn-success"><i class="fas fa-save"> Save</i></button>
