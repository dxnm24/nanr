<urlset xmlns="http://www.sitemaps.org/schemas/sitemap/0.9">
    <url>
        <loc>{{ url('/') }}</loc>
        <lastmod>{{ date('Y-m-d') }}</lastmod>
        <changefreq>always</changefreq>
        <priority>1</priority>
    </url>
    <?php 
        $postTypes = CommonQuery::getAllWithStatus('post_types');
        $postTags = CommonQuery::getAllWithStatus('post_tags');
        $posts = CommonQuery::getAllWithStatus('posts');
    ?>
    @if($postTypes)
        @foreach($postTypes as $value)
        <?php 
            if($value->parent_id > 0) {
                $parentSlug = CommonQuery::getFieldById('post_types', $value->parent_id, 'slug');
                $postTypeUrl = url($parentSlug.'/'.$value->slug);
            } else {
                $postTypeUrl = url($value->slug);
            }
        ?>
        <url>
        	<loc>{{ $postTypeUrl }}</loc>
    		<changefreq>weekly</changefreq>
    		<priority>0.8</priority>
        </url>
        @endforeach
    @endif
    @if($postTags)
        @foreach($postTags as $value)
        <url>
        	<loc>{{ url('tag/'.$value->slug) }}</loc>
    		<changefreq>weekly</changefreq>
    		<priority>0.8</priority>
        </url>
        @endforeach
    @endif
    @if($posts)
        @foreach($posts as $value)
    	    <url>
    	    	<loc>{{ url($value->slug) }}</loc>
    	    	<lastmod>{{ date('Y-m-d', strtotime($value->start_date)) }}</lastmod>
    			<changefreq>weekly</changefreq>
    			<priority>0.8</priority>
    	    </url>
    	@endforeach
    @endif
</urlset>