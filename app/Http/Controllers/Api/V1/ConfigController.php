<?php

namespace App\Http\Controllers\Api\V1;

use App\Http\Controllers\Controller;
use Config;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;
use Illuminate\Http\Response;

class ConfigController extends Controller
{
    public function getData(string $configName = 'vk')
    {
        return config($configName);
    }

    /**
     * @param Request $request
     * @return JsonResponse
     */
    public function setData(Request $request): JsonResponse
    {
        $data = $request->input();

        foreach ($data as $key => $value) {
            Config::set('vk.' . $key, $value);
        }

        $configPath = config_path('vk.php');

        $result = '<?php' . "\n\n" . 'return [' . "\n\n    " . '/*
    |--------------------------------------------------------------------------
    | Данные для ВК
    |--------------------------------------------------------------------------
    */' . "\n\n    ";

        $dataKeys = array_keys($data);
        $lastLine = end($dataKeys);

        foreach ($data as $key => $value) {
            if (is_string($value)) {
                $value = "'" . $value . "'";
            }

            if ($key !== $lastLine) {
                $result .= "'$key' => $value," . "\n    ";
            } else {
                $result .= "'$key' => $value," . "\n";
            }
        }
        $result = rtrim($result, ', ') . "];\n";

        file_put_contents($configPath, $result);

        return response()->jsonSuccess('Config updated successfully.', Response::HTTP_OK);
    }
}
