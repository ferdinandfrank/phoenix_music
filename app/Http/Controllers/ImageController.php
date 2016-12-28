<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Intervention\Image\Facades\Image;

/**
 * ImageController
 * -----------------------
 * Controller to handle the logic of image uploads and actions on uploaded images.
 *
 * @author  Ferdinand Frank
 * @version 1.0
 * @package App\Http\Controllers
 */
class ImageController extends Controller {

    /**
     * Uploads the new image specified in the request to the 'images' folder in the storage.
     *
     * @param Request $request
     * @param-request file The image to upload
     *
     * @return \Illuminate\Http\JsonResponse Contains the url of the uploaded image, the size as an array of the width
     *     and height, as well as the filename of the uploaded image as alt.
     */
    public function store(Request $request) {
        $this->validate($request, [
            'file' => 'required|image'
        ]);

        $file = $request->file('file');
        $fileName = time() . '_' . $file->getClientOriginalName();

        $url = $file->storeAs('/images', $fileName, 'public');
        if (!$url) {
            return response()->json($file, 500);
        }

        $image = Image::make(public_storage_path($url));
        $url = "/storage/" . $url;

        return response()->json([
            'url'  => removeQueryString($url),
            'size' => [$image->width(), $image->height()],
            'alt'  => $image->filename
        ]);
    }

    /**
     * Rotates the image under the specified url.
     *
     * @param Request $request
     * @param-request url The url of the image to rotate.
     * @param-request degrees The degrees to rotate the image.
     *
     * @return \Illuminate\Http\JsonResponse Contains the url of the rotated image, the size as an array of the width
     *     and height, as well as the filename of the rotated image as alt.
     */
    public function rotate(Request $request) {
        $this->validate($request, [
            'url'     => 'required',
            'degrees' => 'required|integer'
        ]);

        $imagePath = $request->get('url');
        $image = Image::make(public_storage_path($request->get('url')));
        $image->rotate(intval($request->get('degrees')));
        $image->save();

        return response()->json([
            'url'  => removeQueryString($imagePath),
            'size' => [$image->width(), $image->height()],
            'alt'  => $image->filename
        ]);
    }

    /**
     * Allows to resize or crop the image under the specified url.
     *
     * @param Request $request
     * @param-request url The url of the image to modify.
     * @param-request width The width to resize the image. Can be {@code null} if the width of the image shall not be
     *     modified.
     * @param-request height The height to resize the image. Can be {@code null} if the height of the image shall not
     *     be modified.
     * @param-request crop An array of floats with the cropping information of the top, left, bottom, right reduction
     *     of the width. [0,0,1,1] means no cropping. Can be {@code null} if no crop shall be executed.
     *
     * @return \Illuminate\Http\JsonResponse Contains the url of the modified image, the size as an array of the width
     *     and height, as well as the filename of the modified image as alt.
     */
    public function modify(Request $request) {
        $this->validate($request, [
            'url' => 'required'
        ]);

        $imagePath = $request->get('url');
        $image = Image::make(public_storage_path($request->get('url')));
        $image = $this->resize($image, $request->get('width'), $request->get('height'));

        $crop = $request->get('crop');
        if (!empty($crop)) {
            $crop = json_decode($crop);
            if (is_array($crop)) {
                $image = $this->crop($image, floatval($crop[0]), floatval($crop[1]), floatval($crop[2]),
                    floatval($crop[3]));
            }
        }


        $image->save();

        return response()->json([
            'url'  => url(removeQueryString($imagePath)),
            'size' => [$image->width(), $image->height()],
            'alt'  => $image->filename
        ]);
    }

    private function resize(\Intervention\Image\Image $image, $width, $height = null) {
        if (empty($width) && empty($height)) {
            return $image;
        }

        $width = $width == null ? null : intval($width);
        $height = $height == null ? null : intval($height);

        // resize image to fixed size
        if (empty($width) || empty($height)) {
            return $image->resize($width, $height, function ($constraint) {
                $constraint->aspectRatio();
            });
        } else {
            return $image->resize($width, $height);
        }
    }

    private function crop(\Intervention\Image\Image $image, float $top, float $left, float $bottom, float $right) {
        $croppedWidth = intval($image->width() * ($left + $right));
        $croppedHeight = intval($image->height() * ($top + $bottom));

        return $image->crop($croppedWidth, $croppedHeight, intval($image->width() * $left),
            intval($image->height() * $top));
    }
}
