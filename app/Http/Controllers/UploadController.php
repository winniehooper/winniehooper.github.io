<?php

namespace App\Http\Controllers;

use Alaouy\Youtube\Facades\Youtube;
use App\Models\Project;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;
use Illuminate\Http\Response;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Input;
use Illuminate\Support\Facades\Storage;
use Intervention\Image\Facades\Image;
use Ramsey\Uuid\Uuid;
use Sseffa\VideoApi\Facades\VideoApi;

class UploadController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        //$this->middleware('auth');
    }

    /**
     * Returns corresponding template object from given template name
     *
     * @param  string $template
     * @return mixed
     */
    private function getTemplate($template)
    {
        $template = config("imagecache.templates.{$template}");

        switch (true) {
            // closure template found
            case is_callable($template):
                return $template;

            // filter template found
            case class_exists($template):
                return new $template;

            default:
                // template not found
                abort(404);
                break;
        }
    }

    function image($type, $template, $file) {
        $dest = trim($_SERVER['REQUEST_URI'], '/');
        $original = str_replace($template . '/', '', $dest);
        $filter = $this->getTemplate($template);
        $template =  new $filter;
        @mkdir(dirname($dest), 0777, true);

        $img = Image::make($original)->filter($template)->save($dest);

        return $this->buildResponse($img->encoded);
    }

    /**
     * Builds HTTP response from given image data
     *
     * @param  string $content
     * @return \Illuminate\Http\Response
     */
    private function buildResponse($content)
    {
        // define mime type
        $mime = finfo_buffer(finfo_open(FILEINFO_MIME_TYPE), $content);

        // return http response
        return new Response($content, 200, array(
          'Content-Type' => $mime,
          'Cache-Control' => 'max-age='.(config('imagecache.lifetime')*60).', public',
          'Etag' => md5($content)
        ));
    }

    /**
     */
    public function uploadImage()
    {
        $name = Uuid::uuid4();
        $type = request('type');
        $types = [
          'avatar'        => [
            'dir' => 'avatars',
            'paths' => [
                'file_path_small' => 'images/avatars/avatar_small/',
                'file_path_medium' => 'images/avatars/avatar_medium/',
                'file_path_big' => 'images/avatars/avatar_big/',
                'file_path_promo' => 'images/avatars/avatar_promo/',
            ]
          ],
          'project' => [
            'dir' => 'project_images',
              'paths' => [
                'file_path_small' => 'images/project_images/project_small/',
                'file_path_medium' => 'images/project_images/project_medium/',
                'file_path_big' => 'images/project_images/project_big/',
                'file_path_promo' => 'images/project_images/project_promo/',
              ]
          ]
        ];
        if (empty($types[$type])) {
            abort(404, 'Type is not found');
        }

        $file = Image::make(Input::file('uploadfile'))->encode('jpg')->save('images/'.$types[$type]['dir'].'/'.$name.'.jpg');

        if ($type == 'avatar') {
            $user = Auth::user();
            $user->avatar = $file->basename;
            $user->save();
        }

        return [
          'status_message' => 'success',
            'file_name' => $file->basename
        ] + $types[$type]['paths'];
    }

    public function uploadProjectImage() {
        $path = request()->file('file')->storePublicly('public/project_about');

        return ['filelink' => url(Storage::url($path))];
    }


    public function uploadVideo() {

        $url = request('videoLink');
        $name = Uuid::uuid4();
        if (strpos($url, 'youtu')) {
            $videoId = Youtube::parseVidFromURL($url);
            $video = Youtube::getVideoInfo($videoId, ['snippet']);

            $all = (array)$video->snippet->thumbnails;
            $best = array_pop($all);
            $image = $best->url;
            $embed = 'http://www.youtube.com/embed/'.$videoId;
        } else {
            $v = VideoApi::setType('vimeo');
            $id = $v->parseVIdFromURL($url);

            $data = $v->getVideoDetail($id);
            $image = $data['thumbnail_large'];
            $embed = 'http://player.vimeo.com/video/'.$id;
        }

        $file = Image::make($image)->encode('jpg')->save('images/project_images/'.$name.'.jpg');

        return [
          'image'      => [
            'full' => 'images/project_images/'.$file->basename,
            'name' => $file->basename,
          ],
          'image_path' => 'images/project_images/',
          'video'      => $embed,
        ];
    }
}
