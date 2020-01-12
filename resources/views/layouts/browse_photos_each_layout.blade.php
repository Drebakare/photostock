<a href="{{route('all.picture',['image_name' => $photo['slug'],'id' => $photo['id']])}}">
    <div class="browse-photos-section-each">
        <div class="browse-photos-each-photo">
            <img src="{{ asset("uploads/original/".$photo["image"]) }}" class="img-responsive">
        </div>
        <div class="browse-photos-each-info">
            <div>
                <div class="browse-photos-each-title">
                    {{ ucfirst($photo->title) }}
                </div>
            </div>
        </div>
    </div>
</a>
