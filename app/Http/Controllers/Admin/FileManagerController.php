<?php

namespace App\Http\Controllers\Admin;

use App\Http\Requests;
use App\Http\Controllers\Controller;
use App\Blog\Helpers\FileManager\ExceptionCatcherJSON;
use App\Blog\Helpers\FileManager\FileManager;
use App\Blog\Helpers\FileManager\Response;
use App\Blog\Helpers\FileManager\Request;

class FileManagerController extends Controller
{

    private $oResponse;
    private $oFtp;

    public function __construct()
    {
        $this->middleware('auth');
        ExceptionCatcherJSON::register();
        $this->oResponse = new Response();
        $this->oFtp = new FileManager(array(
            'hostname' => env('FTP_SERVER', 'localhost'),
            'port' => env('FTP_PORT', '21'),
            'username' => env('FTP_USERNAME', 'root'),
            'password' => env('FTP_PASSWORD', '')
        ));

        if (! $this->oFtp->connect()) {
            throw new \Exception("Cannot connect to the FTP server");
        }
    }

    public function index()
    {
        return view('admin.file_manager');
    }

    public function listFiles()
    {
        $list = $this->oFtp->listFilesRaw(Request::getApiParam('path'));
        $list = is_array($list) ? $list : array();
        $list = array_map(function($item) {
            $date = new \DateTime('now');
            $item['date'] = $date->format('Y-m-d H:i:s');
            return $item;
        }, $list);
        $this->oResponse->setData($list);
        $this->oResponse->flushJson();
    }

    public function upload()
    {
        if (Request::getFile() && $dest = Request::getPost('destination')) {
            $errors = array();
            foreach (Request::getFile() as $file) {
                $filePath = $file['tmp_name'];
                $destPath = $dest .'/'. $file['name'];
                $result = $this->oFtp->upload($filePath, $destPath);
                if (! $result)  {
                    $errors[] = $file['name'];
                }
            }

            if ($errors) {
                throw new \Exception("Unknown error uploading: \n\n" . implode(", \n", $errors));
            }

            $this->oResponse->setData($result);
            $this->oResponse->flushJson();
        }
    }

    public function rename()
    {
        //
    }

    public function copy()
    {
        //
    }

    public function remove()
    {
        //
    }

    public function edit()
    {
        $this->oResponse->setData($this->oFtp->getContent(Request::getApiParam('path')));
        $this->oResponse->flushJson();
    }

    public function getContent()
    {
        //
    }

    public function createFolder()
    {
        $path = Request::getApiParam('path');
        $name = Request::getApiParam('name');
        $result = $this->oFtp->mkdir($path .'/'. $name);
        if (! $result) {
            throw new \Exception("Unknown error creating this folder");
        }
        $this->oResponse->setData($result);
        $this->oResponse->flushJson();
    }

    public function download()
    {
        $download  = Request::getQuery('preview') === 'true' ? '' : 'attachment;';
        $filePath = Request::getQuery('path');
        $fileName = explode('/', $filePath);
        $fileName = end($fileName);
        $tmpFilePath = $this->oFtp->downloadTemp($filePath);
        if ($fileContent = @file_get_contents($tmpFilePath)) {
            // $this->oResponse->setData($fileContent);
            // $this->oResponse->setHeaders(array(
            //     'Content-Type' => @mime_content_type($tmpFilePath),
            //     'Content-disposition' => sprintf('%s filename="%s"', $download, $fileName)
            // ));
            return response($fileContent)
                ->header('Content-Type', @mime_content_type($tmpFilePath))
                ->header('Content-disposition', sprintf('%s filename="%s"', $download, $fileName));
        }
        $this->oResponse->flush();
    }

    public function compress()
    {
        $this->oResponse->setData(true);
        $this->oResponse->flushJson();
    }

    public function extract()
    {
        $this->oResponse->setData(true);
        $this->oResponse->flushJson();
    }

    public function permissions()
    {
        //
    }
}
