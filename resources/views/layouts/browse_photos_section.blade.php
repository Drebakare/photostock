<div class="browse-photos-section" id="browse-photos-section">
    <div class="row">
        @php $i=0; @endphp
        @foreach($approved_pictures_array as $key => $photos)
            <div class="col-12 col-md-4">
                <div class="browse-photos-section-column browse-photos-section-column-{{ $i }}">
                    @foreach($photos as $value)
                        @include("layouts.browse_photos_each_layout", ["photo" => $value])
                    @endforeach
                </div>
            </div>
            @php $i++; @endphp
        @endforeach
    </div>
</div>

<div id="browse-photos-section-loader" class="text-center">
    <img src="{{ asset("assets/images/loader.gif") }}" class="img-fluid">
</div>
