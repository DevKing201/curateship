<?php

namespace App\View\Components\Posts\Lists;

use Illuminate\Support\Facades\DB;
use Illuminate\View\Component;

use Modules\Post\Entities\Post;

class DraggableGallerySimpleItag extends Component
{
    public $posts;

    /**
     * Create a new component instance.
     *
     * @return void
     */
    public function __construct($tags = [], $limit = 5)
    {
        $posts = [];

        if ($tags) {
            $posts = Post::getByTagNames($tags, $limit);
        }else{
            // Else if not set, then just get latest posts
            $posts = Post::leftJoin('posts_metas', 'posts.id', '=', 'posts_metas.post_id')
            ->select(DB::raw(
                'posts.*,
                IF(posts_metas.meta_key = "video", posts_metas.meta_value, "") as video'
            ))->where(
                [
                    'status' => 'published'
                ]
            )
            ->orderBy('created_at', 'desc')
            ->limit($limit)
            ->offset(0);

            $posts = $posts->get();

            foreach($posts as &$post) {
                $video_file          = $post['video'];
                $video_extension     = empty( $video_file ) ? '' : substr($video_file, strrpos($video_file,".") + 1);
                $post['video']       = !empty( $video_file ) ? asset("storage/posts/original/{$video_file}") : '';
                $post['video_type']  = $video_extension == 'mp4' ? 'video/mp4' : ( $video_extension == 'webm' ? 'video/webm' : '' );
            }
        }

        $this->posts = $posts;
    }

    /**
     * Get the view / contents that represent the component.
     *
     * @return \Illuminate\View\View|string
     */
    public function render()
    {
        return view('components.posts.lists.draggable-gallery-simple-itag');
    }
}
