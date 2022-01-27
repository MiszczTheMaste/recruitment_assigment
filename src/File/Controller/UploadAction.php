<?php

namespace App\File\Controller;

use App\Exception\InvalidFileExtension;
use App\Exception\InvalidFileStructure;
use App\Exception\NoFileFound;
use App\File\CommandHandler\UploadHandler;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\HttpFoundation\File\Exception\FileException;
use Symfony\Component\HttpFoundation\JsonResponse;

class UploadAction
{
    private UploadHandler $handler;

    public function __construct(UploadHandler $handler)
    {
        $this->handler = $handler;
    }

    public function __invoke(Request $request): Response
    {
        try {
            $file = $request->files->get('uploadedFile');
            $this->handler->upload($file);
        } catch (NoFileFound $e) {
            return new JsonResponse(["message" => "No file found"],  Response::HTTP_BAD_REQUEST);
        } catch (InvalidFileExtension $e) {
            return new JsonResponse(["message" => "Invalid file extension"],  Response::HTTP_BAD_REQUEST);
        } catch (InvalidFileStructure $e) {
            return new JsonResponse(["message" => "Invalid file structure"],  Response::HTTP_BAD_REQUEST);
        } catch (FileException $e) {
            return new JsonResponse(["message" => "Failed to upload the file"],  Response::HTTP_INTERNAL_SERVER_ERROR);
        } catch (\Throwable $th) {
            return new JsonResponse(["message" => "Could not upload the file"],  Response::HTTP_INTERNAL_SERVER_ERROR);
        }
        return new JsonResponse(["message" => "File uploaded"],  Response::HTTP_OK);
    }
}
