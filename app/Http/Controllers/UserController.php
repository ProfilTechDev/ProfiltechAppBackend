<?php

namespace App\Http\Controllers;

use App\Models\AppNotificationSettings;
use App\Models\EmailNotificationSettings;
use Illuminate\Http\Request;
use Log;

class UserController extends Controller
{
    public function getAuthenticatedUser(Request $request)
    {
        return $request->user();
    }

    public function update(Request $request)
    {
        try {
            $user = $request->user();
            $user->update($request->all());
            return $user;
        } catch (\Throwable $th) {
            Log::error('User update failed!', ['error' => $th->getMessage()]);
            return response()->json(['error' => 'User update failed!'], 500);
        }
    }

    public function updateEmailNotificationSettings(Request $request)
    {
        try {
            $request->validate(['type' => 'required|string', 'value' => 'required|boolean']);
            
            EmailNotificationSettings::updateOrCreate([
                'user_id' => $request->user()->id, 
                'type' => $request->input('type')
            ], [
                'value' => $request->input('value')
            ]);

            return response()->json(['message' => 'Email notification settings updated successfully!']);
        } catch (\Throwable $th) {
            Log::error('Email notification settings update failed!', ['error' => $th->getMessage()]);
            return response()->json(['error' => 'Email notification settings update failed!'], 500);
        }
    }

    public function updateAppNotificationSettings(Request $request)
    {
        try {
            $request->validate(['type' => 'required|string', 'value' => 'required|boolean']);
            
            AppNotificationSettings::updateOrCreate([
                'user_id' => $request->user()->id, 
                'type' => $request->input('type')
            ], [
                'value' => $request->input('value')
            ]);

            return response()->json(['message' => 'App notification settings updated successfully!']);
        } catch (\Throwable $th) {
            Log::error('App notification settings update failed!', ['error' => $th->getMessage()]);
            return response()->json(['error' => 'App notification settings update failed!'], 500);
        }
    }

    public function getEmailNotificationSettings(Request $request)
    {
        return EmailNotificationSettings::where('user_id', $request->user()->id)->get()->keyBy('type');
    }

    public function getAppNotificationSettings(Request $request)
    {
        return AppNotificationSettings::where('user_id', $request->user()->id)->get()->keyBy('type');
    }
}
