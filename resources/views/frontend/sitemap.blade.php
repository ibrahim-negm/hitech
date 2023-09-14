<?php echo '<?xml version="1.0" encoding="UTF-8"?>'; ?>
<urlset xmlns="http://www.sitemaps.org/schemas/sitemap/0.9">
    @foreach ($posts as $post)

        <url>
            <loc>{{ $post->post_title }}</loc>
            <br>
            <lastmod>{{ $post->created_at }}</lastmod>
        </url>
        <br>
    @endforeach
</urlset>
