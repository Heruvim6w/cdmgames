<?php

namespace App\Http\Controllers;

use App\Http\Requests\RandomEmail\RandomEmailRequest;
use Illuminate\Support\Str;
use Symfony\Component\HttpFoundation\BinaryFileResponse;

class RandomEmailController extends Controller
{
    public function create(RandomEmailRequest $request): BinaryFileResponse
    {
        $data = $request->validated();
        $filePath = $this->createEmailsFile($data['emails_count']);

        return response()->download($filePath);
    }

    private function createEmailsFile(int $emailsCount): string
    {
        $csvData = [];
        for ($i = 0; $i < $emailsCount; $i++) {
            $email = Str::random(10) . '@forgames.com';
            $password = Str::random(12);
            $csvData[] = [$email, $password];
        }

        $fileName = now() . 'random_emails.csv';
        $filePath = storage_path('app/' . $fileName);

        $file = fopen($filePath, 'wb');
        foreach ($csvData as $row) {
            fputcsv($file, $row);
        }
        fclose($file);

        return $filePath;
    }
}
