<?php

namespace App\Http\Controllers;

use App\Models\DraftDocument;
use Illuminate\Http\Request;

class DraftDocumentController extends Controller
{
    public function index(Request $request)
    {
        $query = DraftDocument::query();

        if ($request->filled('search')) {
            $query->where('name', 'like', '%' . $request->search . '%');
        }

        $doc = $query->latest()->paginate(10)->withQueryString();

        return view('pages.document.document-page', compact('doc'));
    }

    public function create()
    {
        return view('pages.document.create-document');
    }

    public function store(Request $request)
    {
        $request->validate([
            'name' => 'required|string',
            'date' => 'nullable|date',
            'file' => 'required|file|mimes:pdf,jpg,jpeg,png|max:10240',
        ]);

        $file = $request->file('file');
        
        $uploadResult = $this->uploadToCloudinary($file);

        if (!$uploadResult || !isset($uploadResult['secure_url'])) {
            return back()->withErrors(['file' => 'Gagal mengunggah file ke Cloudinary.']);
        }

        DraftDocument::create([
            'name' => $request->name,
            'date' => $request->date,
            'file_original_name' => $file->getClientOriginalName(),
            'mime_type' => $file->getMimeType(),
            'size' => $file->getSize(),
            'file_url' => $uploadResult['secure_url'],
            'file_public_id' => $uploadResult['public_id'],
        ]);

        return redirect()->route('draft-documents.index')->with('success', 'Draft dokumen berhasil disimpan');
    }

    public function show(DraftDocument $draftDocument)
    {
        return view('pages.document.view-document', [
            'doc' => $draftDocument
        ]);
    }

    public function edit(DraftDocument $draftDocument)
    {
        return view('pages.document.edit-document', [
            'doc' => $draftDocument
        ]);
    }

    public function update(Request $request, DraftDocument $draftDocument)
    {
        $request->validate([
            'name' => 'required|string',
            'date' => 'nullable|date',
            'file' => 'nullable|file|mimes:pdf,jpg,jpeg,png|max:10240',
        ]);

        $updateData = [
            'name' => $request->name,
            'date' => $request->date,
        ];

        if ($request->hasFile('file')) {
            if ($draftDocument->file_public_id) {
                $this->destroyFromCloudinary($draftDocument->file_public_id, $draftDocument->mime_type);
            }

            $file = $request->file('file');
            $uploadResult = $this->uploadToCloudinary($file);

            if ($uploadResult && isset($uploadResult['secure_url'])) {
                $updateData['file_url'] = $uploadResult['secure_url'];
                $updateData['file_public_id'] = $uploadResult['public_id'];
                $updateData['file_original_name'] = $file->getClientOriginalName();
                $updateData['mime_type'] = $file->getMimeType();
                $updateData['size'] = $file->getSize();
            }
        }

        $draftDocument->update($updateData);

        return redirect()->route('draft-documents.index')->with('success', 'Draft dokumen berhasil diperbarui');
    }

    public function destroy(DraftDocument $draftDocument)
    {
        if ($draftDocument->file_public_id) {
            $this->destroyFromCloudinary($draftDocument->file_public_id, $draftDocument->mime_type);
        }

        $draftDocument->delete();

        return redirect()->route('draft-documents.index')->with('success', 'Draft dokumen berhasil dihapus');
    }

    protected function uploadToCloudinary($file)
    {
        $cloud = env('CLOUDINARY_CLOUD_NAME');
        $apiKey = env('CLOUDINARY_API_KEY');
        $apiSecret = env('CLOUDINARY_API_SECRET');

        if (!$cloud || !$apiKey || !$apiSecret) return null;

        $mimeType = $file->getMimeType();
        $resourceType = (strpos($mimeType, 'image') !== false || strpos($mimeType, 'pdf') !== false) ? 'image' : 'raw';

        $timestamp = time();
        $params = [
            'timestamp' => $timestamp,
        ];

        ksort($params);
        $signString = "timestamp={$timestamp}{$apiSecret}";
        $signature = sha1($signString);

        $post = [
            'file' => new \CURLFile($file->getPathname(), $mimeType, $file->getClientOriginalName()),
            'api_key' => $apiKey,
            'timestamp' => $timestamp,
            'signature' => $signature,
        ];

        $endpoint = "https://api.cloudinary.com/v1_1/{$cloud}/{$resourceType}/upload";

        $ch = curl_init($endpoint);
        curl_setopt($ch, CURLOPT_POST, true);
        curl_setopt($ch, CURLOPT_POSTFIELDS, $post);
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
        curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, false);
        $res = curl_exec($ch);
        curl_close($ch);

        return $res ? json_decode($res, true) : null;
    }

    protected function destroyFromCloudinary($publicId, $mimeType = null)
    {
        $cloud = env('CLOUDINARY_CLOUD_NAME');
        $apiKey = env('CLOUDINARY_API_KEY');
        $apiSecret = env('CLOUDINARY_API_SECRET');

        if (!($cloud && $apiKey && $apiSecret)) return false;

        $resourceType = (strpos($mimeType, 'image') !== false || strpos($mimeType, 'pdf') !== false) ? 'image' : 'raw';
        $timestamp = time();

        $signString = "public_id={$publicId}&timestamp={$timestamp}{$apiSecret}";
        $signature = sha1($signString);

        $post = [
            'public_id' => $publicId,
            'api_key' => $apiKey,
            'timestamp' => $timestamp,
            'signature' => $signature,
        ];

        $endpoint = "https://api.cloudinary.com/v1_1/{$cloud}/{$resourceType}/destroy";

        $ch = curl_init($endpoint);
        curl_setopt($ch, CURLOPT_POST, true);
        curl_setopt($ch, CURLOPT_POSTFIELDS, $post);
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
        curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, false);
        $res = curl_exec($ch);
        curl_close($ch);

        return $res !== false;
    }
}