<?php

namespace App\Http\Controllers\Seller;

use App\Helper\Media;
use App\Http\Controllers\Controller;
use App\Models\Seller;
use Exception;
use Illuminate\Http\Request;
use Illuminate\Http\UploadedFile;
use Illuminate\Support\Facades\Storage;

class ProfileController extends Controller
{
    use Media;

    public function __construct()
    {
        $this->middleware('auth:seller');
    }

    public function index()
    {
        return view('seller.pages.profile');
    }

    public function update(Seller $seller, Request $request)
    {
        $this->validate($request, [
            'name' => ['required', 'string','max:255'],
            'avatar' => ['nullable', 'mimetypes:image/bmp,image/gif,image/png,image/jpeg,image/jpg,image/JPG,image/webp', 'max:5048'],
            'desc' => ['nullable']
        ]);

        $response = [
            'key' => 'fail',
            'message' => 'Your profile could not be updated'
        ];


        try {

            $seller->name = $request->name;
            $seller->desc = $request->desc;
            if ($request->hasFile('avatar') && ($request->file('avatar') instanceof UploadedFile)) {

                $fileData = $this->uploads($request->file('avatar'), 'seller/avatar/');
                if (!empty($fileData['filePath'])) {
                    if ((!empty($seller->avatar)) && Storage::exists($seller->avatar)) {
                        Storage::delete($seller->avatar);
                    }
                    $seller->avatar = $fileData['filePath'] ?? null;
                }
            }

            $isUpdated = $seller->save();

            if ($isUpdated) {
                $response = [
                    'key' => 'success',
                    'message' => 'Your profile has been updated successfully!!'
                ];
            } else {
                $response = [
                    'key' => 'fail',
                    'message' => 'Your profile could not be updated'
                ];
            }
        } catch (Exception $e) {

            $response = [
                'key' => 'fail',
                'message' => 'Your profile could not be updated'
            ];
        }

        return back()->with($response['key'], $response['message']);
    }
}
