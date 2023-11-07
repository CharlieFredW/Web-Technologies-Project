
<div class="new-samples-images-container">
    @foreach($newSamples as $newSample)
        <div class="new-samples-image-container">
            <img class="sample-image" src="{{ $newSample->image_url }}" alt="{{ $newSample->title }}">
            <p class="new-samples-image-caption">{{ $newSample->title }}</p>
        </div>
    @endforeach
</div>
