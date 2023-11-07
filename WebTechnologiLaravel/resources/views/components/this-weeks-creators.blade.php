
<div class="this-weeks-creators-box">
    <div class="this-weeks-creators-images-container">
        @for ($i = 0; $i < count($thisWeeksTopCreators); $i++)
            @if ($i <= 3)
                <div class="this-weeks-creators-image-container">
                    <img src="{{ $thisWeeksTopCreators[$i]->image_url }}" alt="{{ $thisWeeksTopCreators[$i]->title }}">
                    <p class="this-weeks-creators-image-caption">{{ $thisWeeksTopCreators[$i]->title }}</p>
                </div>
            @endif
        @endfor
    </div>
</div>
<div class="this-weeks-creators-box2">
    <div class="this-weeks-creators-images-container">
        @for ($i = 4; $i < min(8, count($thisWeeksTopCreators)); $i++)
            <div class="this-weeks-creators-image-container">
                <img src="{{ $thisWeeksTopCreators[$i]->image_url }}" alt="{{ $thisWeeksTopCreators[$i]->title }}">
                <p class="this-weeks-creators-image-caption">{{ $thisWeeksTopCreators[$i]->title }}</p>
            </div>
        @endfor
    </div>
</div>
