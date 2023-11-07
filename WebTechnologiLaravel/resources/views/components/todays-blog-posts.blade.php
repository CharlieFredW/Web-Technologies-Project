
<div class="blog-images-container">
    @foreach($todayBlogPosts as $todayBlogPost)
        <div class="blog-image-container">
            <img src="placeholder1.jpg" alt="Placeholder Image 1">
            <p class="blog-image-caption">{{ $todayBlogPost->title }}</p>
        </div>
    @endforeach
</div>
