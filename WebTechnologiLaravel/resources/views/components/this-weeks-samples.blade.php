
<div class="today-picks-images-container">
    @foreach($todaySamples as $todaySample)
        <div class="today-picks-image-container">
            <img class="sample-image" src="{{ $todaySample->image_url }}" alt="{{ $todaySample->title }}">
            <p class="today-picks-image-caption">{{ $todaySample->title }}</p>
        </div>
    @endforeach
</div>
