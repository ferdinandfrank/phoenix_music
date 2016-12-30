<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use TalvBansal\MediaManager\Http\Requests\UploadFileRequest;
use TalvBansal\MediaManager\Http\Requests\UploadNewFolderRequest;
use TalvBansal\MediaManager\Http\UploadedFiles;
use TalvBansal\MediaManager\Services\MediaManager;

/**
 * MediaController
 * -----------------------
 * Controller to handle the logic of the 'media' routes.
 *
 * @author  Ferdinand Frank
 * @version 1.0
 * @package App\Http\Controllers
 */
class MediaController extends Controller {

    /**
     * Shows the media page.
     *
     * @return \Illuminate\View\View The media page.
     */
    public function index() {
        return view('backend.media.index');
    }

    /**
     * The media manager instance
     *
     * @var MediaManager
     */
    private $mediaManager;

    /**
     * MediaController constructor.
     *
     * @param MediaManager $mediaManager
     */
    public function __construct(MediaManager $mediaManager) {
        $this->mediaManager = $mediaManager;
    }

    /**
     * Lists the folders and files in the request's specified path.
     *
     * @return array
     */
    public function ls() {
        $path = request('path');

        return $this->mediaManager->folderInfo($path);
    }

    /**
     * Creates a new folder.
     *
     * @param UploadNewFolderRequest $request
     *
     * @return array|\Illuminate\Http\JsonResponse
     */
    public function createFolder(UploadNewFolderRequest $request) {
        $new_folder = $request->get('new_folder');
        $folder = $request->get('folder') . '/' . $new_folder;

        try {
            $result = $this->mediaManager->createDirectory($folder);

            if ($result !== true) {
                $error = $this->mediaManager->errors() ?: trans('alert.error.post.content');

                return $this->errorResponse($error);
            }

            return ['success' => trans('alert.media.create_folder', ['name' => $new_folder])];
        } catch (\Exception $e) {
            return $this->errorResponse($e->getMessage());
        }
    }

    /**
     * Deletes a folder.
     *
     * @param Request $request
     *
     * @return array|\Illuminate\Http\JsonResponse
     */
    public function deleteFolder(Request $request) {
        $del_folder = $request->get('del_folder');
        $folder = str_finish($request->get('folder'), DIRECTORY_SEPARATOR) . $del_folder;

        try {
            $result = $this->mediaManager->deleteDirectory($folder);
            if ($result !== true) {
                $error = $this->mediaManager->errors() ?: trans('alert.error.delete.content');

                return $this->errorResponse($error);
            }

            return ['success' => trans('alert.media.delete_folder', ['name' => $del_folder])];
        } catch (\Exception $e) {
            return $this->errorResponse($e->getMessage());
        }
    }

    /**
     * Deletes a file.
     *
     * @return array|\Illuminate\Http\JsonResponse
     */
    public function deleteFile() {
        $path = request('path');
        try {
            $result = $this->mediaManager->deleteFile($path);

            if ($result !== true) {
                $error = $this->mediaManager->errors() ?: trans('alert.error.delete.content');

                return $this->errorResponse($error);
            }

            return ['success' => trans('alert.media.delete_file', ['name' => $path])];
        } catch (\Exception $e) {
            return $this->errorResponse($e->getMessage());
        }
    }

    /**
     * Uploads a file.
     *
     * @param UploadFileRequest $request
     *
     * @return array|\Illuminate\Http\JsonResponse
     */
    public function uploadFiles(UploadFileRequest $request) {
        try {
            $files = $request->file('files');
            $folder = $request->get('folder', '/');
            $uploadedFiles = new UploadedFiles($files);

            $response = $this->mediaManager->saveUploadedFiles($uploadedFiles, $folder);
            if ($response != 0) {
                $response = trans('alert.default.post.content');
            }

            $errors = $this->mediaManager->errors();
            if (!empty($errors)) {
                return $this->errorResponse($errors, $response);
            }

            return ['success' => trans('alert.media.upload_file')];
        } catch (\Exception $e) {
            return $this->errorResponse([$e->getMessage()]);
        }
    }

    /**
     * Renames a file.
     *
     * @param Request $request
     *
     * @return array|\Illuminate\Http\JsonResponse
     */
    public function rename(Request $request) {
        $path = $request->get('path');
        $original = $request->get('original');
        $newName = $request->get('newName');
        $type = $request->get('type');

        try {
            $result = $this->mediaManager->rename($path, $original, $newName);

            if ($result !== true) {
                $error = $this->mediaManager->errors() ?: trans('alert.error.post.content');

                return $this->errorResponse($error);
            }

            return ['success' => trans('alert.media.rename_file', ['old' => $original, 'new' => $newName])];
        } catch (\Exception $e) {
            return $this->errorResponse($e->getMessage());
        }
    }

    /**
     * Moves a file.
     *
     * @param Request $request
     *
     * @return array|\Illuminate\Http\JsonResponse
     */
    public function move(Request $request) {
        $path = $request->get('path');
        $currentFileName = $request->get('currentItem');
        $newPath = $request->get('newPath');
        $type = $request->get('type');

        $currentFile = str_finish($path, DIRECTORY_SEPARATOR) . $currentFileName;
        $newFile = str_finish($newPath, DIRECTORY_SEPARATOR) . $currentFileName;

        try {
            if ($type == 'Folder') {
                $result = $this->mediaManager->moveFolder($currentFile, $newFile);
            } else {
                $result = $this->mediaManager->moveFile($currentFile, $newFile);
            }

            if ($result !== true) {
                $error = $this->mediaManager->errors() ?: trans('alert.error.post.content');

                return $this->errorResponse($error);
            }

            return ['success' => trans('alert.media.move_file', ['name' => $currentFileName, 'path' => $newPath])];
        } catch (\Exception $e) {
            return $this->errorResponse($e->getMessage());
        }
    }

    /**
     * Gets all directories in the storage root.
     *
     * @return array
     */
    public function allDirectories() {
        return $this->mediaManager->allDirectories();
    }

    /**
     * Upload multiple files.
     *
     * @param       $error
     * @param array $notices
     * @param int   $errorCode
     *
     * @return \Illuminate\Http\JsonResponse
     */
    private function errorResponse($error, $notices = [], $errorCode = 400) {
        if (is_array($error)) {
            json_encode($error);
        }
        $payload = ['msg' => $error];
        if (!empty($notices)) {
            $payload['notices'] = $notices;
        }

        return \Response::json($payload, $errorCode);
    }
}
