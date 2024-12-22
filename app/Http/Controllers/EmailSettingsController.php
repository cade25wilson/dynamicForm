<?php

namespace App\Http\Controllers;

use App\Models\EmailSettings;
use Exception;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Log;

class EmailSettingsController extends Controller
{
    public function update(Request $request, string $id)
    {
        try {
            $data = $request->validate([
                'input' => 'required',
                'value' => 'required'
            ]);

            EmailSettings::findOrFail($id)->update([$data['input'] => $data['value']]);
            return response()->noContent();
        } catch(Exception $e) {
            Log::error($e);
            return response('an Error occurred updating email settings', 500);
        }
    }
}
