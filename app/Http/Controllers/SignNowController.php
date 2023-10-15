<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use SignNow\Api\Entity\Invite\Recipient;

use App\Lib\SignNow;


class SignNowController extends Controller
{
    public function __construct(Request $request) {
        $this->signNow = new SignNow($request);
    }

    public function authenticate(Request $request) {
        return response()->redirectTo($this->signNow->requestAccessUrl());
    }

    public function handleAuthCode(Request $request) {
        $response = $this->signNow->requestToken($request->query('code'));

        if ($response) {
            $this->signNow->setAuthTokens($response["access_token"], $response["refresh_token"]);
        }

        return response()->json([ "status" => $response ]);
    }

    public function createDocument(Request $request) {
        $file = $request->file('file');

        $document = $this->signNow->uploadDocument($file);

        if ($document->ok()) {
            return response()->json($document->json());
        }

        return response()->json([ "status" => $document->ok(), "data" => $document->json() ]);
    }

    public function getDocument($documentId, Request $request) {
        $document = $this->signNow->getDocument($documentId);

        if ($document->ok()) {
            return response()->json($document->json());
        }

        return response()->json([ "status" => $document->ok(), "data" => $document->json() ]);
    }

    public function getFolders(Request $request) {
        $document = $this->signNow->getFolders();

        return response()->json([
            "status" => $document->ok(),
            "data" => $document->json()
        ]);
    }

    public function getDocuments(Request $request) {
        $folderId = $request->query('folderId');

        if (empty($folderId)) {
            $response = $this->signNow->getFolders();
            if (!$response->ok()) {
                return response()->json([ "status" => $document->ok() ]);
            }

            $folders = $response->json()['folders'] ?? [];
            $folder_ids = array_column($folders, 'id');

            $folderId = $folder_ids[0] ?? null;
        }

        $response = $this->signNow->getDocuments($folderId);

        return response()->json([
            "status" => $response->ok(),
            "data" => $response->json()
        ]);
    }

    public function updateDocument($documentId, Request $request) {
        $fields = $request->input('fields', []);
        $elements = $request->input('elements', []);

        $document = $this->signNow->updateDocument($documentId, $fields, $elements, time());

        return response()->json([ "status" => $document->ok() ]);
    }

    public function deleteDocument($documentId, Request $request) {
        $document = $this->signNow->deleteDocument($documentId);

        return response()->json([ "status" => $document->ok() ]);
    }

    public function signLink($documentId, Request $request) {
        $response = $this->signNow->createSigningLink($documentId);

        return response()->json([ "status" => $response->ok(), "data" => $response->json() ]);
    }

    public function getSigningLinks(Request $request) {
        return $this->signNow->getSigningLinks();
    }

    public function createInvite($documentId, Request $request) {
        $recipients = $request->input('recipients', []);
        $from_email = $request->input('from_email');

        return $this->signNow->createInvite($documentId, $recipients, $from_email);
    }
}
