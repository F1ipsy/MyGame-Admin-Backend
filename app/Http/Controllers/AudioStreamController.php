<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Response;

class AudioStreamController extends Controller
{
    public function index(Request $request, $filename)
    {
        $path = storage_path("app/public/file/{$filename}");

        if (!file_exists($path)) {
            abort(404, "Файл не найден: $path");
        }

        $size = filesize($path);
        $file = fopen($path, 'rb');

        $start = 0;
        $end = $size - 1;

        $status = 200;
        $headers = [
            'Content-Type' => 'audio/mpeg',
            'Content-Length' => $size,
            'Accept-Ranges' => 'bytes',
        ];

        if ($request->headers->has('Range')) {
            $status = 206;

            preg_match('/bytes=(\d+)-(\d*)/', $request->header('Range'), $matches);

            $start = intval($matches[1]);
            $end = isset($matches[2]) && is_numeric($matches[2]) ? intval($matches[2]) : $end;

            fseek($file, $start);
            $length = $end - $start + 1;

            $headers['Content-Length'] = $length;
            $headers['Content-Range'] = "bytes $start-$end/$size";
        }

        return response()->stream(function () use ($file, $start, $end) {
            $buffer = 8192;
            $position = $start;
            while (!feof($file) && $position <= $end) {
                $readSize = min($buffer, $end - $position + 1);
                echo fread($file, $readSize);
                flush();
                $position += $readSize;
            }
            fclose($file);
        }, $status, $headers);
    }
}
