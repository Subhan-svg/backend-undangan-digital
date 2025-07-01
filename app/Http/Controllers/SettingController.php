<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Setting;

class SettingController extends Controller
{
    public function index()
    {
        $settings = [
            'site_name' => Setting::get('site_name', config('app.name')),
            'site_email' => Setting::get('site_email', 'admin@example.com'),
            'site_description' => Setting::get('site_description', ''),
            'site_phone' => Setting::get('site_phone', ''),
            'site_address' => Setting::get('site_address', ''),
            'site_maps' => Setting::get('site_maps', ''),
            'site_logo' => Setting::get('site_logo', ''),
            'site_favicon' => Setting::get('site_favicon', ''),
            'site_header' => Setting::get('site_header', ''),
            'site_background_1' => Setting::get('site_background_1', ''),
            'site_background_2' => Setting::get('site_background_2', ''),
            'site_facebook' => Setting::get('site_facebook', ''),
            'site_twitter' => Setting::get('site_twitter', ''),
            'site_tiktok' => Setting::get('site_tiktok', ''),
            'site_instagram' => Setting::get('site_instagram', ''),
            'site_youtube' => Setting::get('site_youtube', ''),
            'site_linkedin' => Setting::get('site_linkedin', ''),
            'site_title_1' => Setting::get('site_title_1', ''),
            'site_title_2' => Setting::get('site_title_2', ''),
            'site_title_3' => Setting::get('site_title_3', ''),
            'site_title_4' => Setting::get('site_title_4', ''),
            'site_title_5' => Setting::get('site_title_5', ''),
            'site_title_6' => Setting::get('site_title_6', ''),
            'site_title_7' => Setting::get('site_title_7', ''),
            'site_title_8' => Setting::get('site_title_8', ''),
            'site_title_9' => Setting::get('site_title_9', ''),
            'site_title_10' => Setting::get('site_title_10', ''),
            'site_title_11' => Setting::get('site_title_11', ''),
            'site_title_12' => Setting::get('site_title_12', ''),
            'site_title_13' => Setting::get('site_title_13', ''),
            'site_title_14' => Setting::get('site_title_14', ''),
            'site_title_15' => Setting::get('site_title_15', ''),
            'site_subtitle_1' => Setting::get('site_subtitle_1', ''),
            'site_subtitle_2' => Setting::get('site_subtitle_2', ''),
            'site_subtitle_3' => Setting::get('site_subtitle_3', ''),
            'site_subtitle_4' => Setting::get('site_subtitle_4', ''),
            'site_subtitle_5' => Setting::get('site_subtitle_5', ''),
            'site_subtitle_6' => Setting::get('site_subtitle_6', ''),
            'site_subtitle_7' => Setting::get('site_subtitle_7', ''),
            'site_subtitle_8' => Setting::get('site_subtitle_8', ''),
            'site_subtitle_9' => Setting::get('site_subtitle_9', ''),
            'site_subtitle_10' => Setting::get('site_subtitle_10', ''),
            'site_subtitle_11' => Setting::get('site_subtitle_11', ''),
            'site_subtitle_12' => Setting::get('site_subtitle_12', ''),
            'site_subtitle_13' => Setting::get('site_subtitle_13', ''),
            'site_subtitle_14' => Setting::get('site_subtitle_14', ''),
            'site_subtitle_15' => Setting::get('site_subtitle_15', ''),
            'site_button_text_1' => Setting::get('site_button_text_1', ''),
            'site_button_text_2' => Setting::get('site_button_text_2', ''),
            'site_button_text_3' => Setting::get('site_button_text_3', ''),
            'site_button_text_4' => Setting::get('site_button_text_4', ''),
            'site_button_text_5' => Setting::get('site_button_text_5', ''),
            'site_button_text_6' => Setting::get('site_button_text_6', ''),
            'site_button_text_7' => Setting::get('site_button_text_7', ''),
            'site_button_text_8' => Setting::get('site_button_text_8', ''),
            'site_button_text_9' => Setting::get('site_button_text_9', ''),
            'site_button_text_10' => Setting::get('site_button_text_10', ''),
            'site_button_text_11' => Setting::get('site_button_text_11', ''),
            'site_button_text_12' => Setting::get('site_button_text_12', ''),
            'site_button_text_13' => Setting::get('site_button_text_13', ''),
            'site_button_text_14' => Setting::get('site_button_text_14', ''),
            'site_button_text_15' => Setting::get('site_button_text_15', ''),
            'site_button_link_1' => Setting::get('site_button_link_1', ''),
            'site_button_link_2' => Setting::get('site_button_link_2', ''),
            'site_button_link_3' => Setting::get('site_button_link_3', ''),
            'site_button_link_4' => Setting::get('site_button_link_4', ''),
            'site_button_link_5' => Setting::get('site_button_link_5', ''),
            'site_button_link_6' => Setting::get('site_button_link_6', ''),
            'site_button_link_7' => Setting::get('site_button_link_7', ''),
            'site_button_link_8' => Setting::get('site_button_link_8', ''),
            'site_button_link_9' => Setting::get('site_button_link_9', ''),
            'site_button_link_10' => Setting::get('site_button_link_10', ''),
            'site_button_link_11' => Setting::get('site_button_link_11', ''),
            'site_button_link_12' => Setting::get('site_button_link_12', ''),
            'site_button_link_13' => Setting::get('site_button_link_13', ''),
            'site_button_link_14' => Setting::get('site_button_link_14', ''),
            'site_button_link_15' => Setting::get('site_button_link_15', ''),
        ];

        return view('setting.index', compact('settings'));
    }

    public function update(Request $request)
    {
        $request->validate([
            'site_name' => 'required|string|max:255',
            'site_email' => 'required|email',
            'site_description' => 'nullable|string|max:500',
            'site_phone' => 'nullable|string|max:20',
            'site_address' => 'nullable|string|max:500',
            'site_maps' => 'nullable|string',
            'site_logo' => 'nullable|image|mimes:jpeg,png,jpg|max:2048',
            'site_favicon' => 'nullable|mimes:ico,png|max:1024',
            'site_header' => 'nullable|image|mimes:jpeg,png,jpg|max:2048',
            'site_background_1' => 'nullable|image|mimes:jpeg,png,jpg|max:2048',
            'site_background_2' => 'nullable|image|mimes:jpeg,png,jpg|max:2048',
            'site_facebook' => 'nullable|url|max:255',
            'site_twitter' => 'nullable|url|max:255',
            'site_instagram' => 'nullable|url|max:255',
            'site_youtube' => 'nullable|url|max:255',
            'site_linkedin' => 'nullable|url|max:255',
            'site_tiktok' => 'nullable|url|max:255',
            'site_title_1' => 'nullable|string|max:255',
            'site_title_2' => 'nullable|string|max:255',
            'site_title_3' => 'nullable|string|max:255',
            'site_title_4' => 'nullable|string|max:255',
            'site_title_5' => 'nullable|string|max:255',
            'site_title_6' => 'nullable|string|max:255',
            'site_title_7' => 'nullable|string|max:255',
            'site_title_8' => 'nullable|string|max:255',
            'site_title_9' => 'nullable|string|max:255',
            'site_title_10' => 'nullable|string|max:255',
            'site_title_11' => 'nullable|string|max:255',
            'site_title_12' => 'nullable|string|max:255',
            'site_title_13' => 'nullable|string|max:255',
            'site_title_14' => 'nullable|string|max:255',
            'site_title_15' => 'nullable|string|max:255',
            'site_subtitle_1' => 'nullable|string|max:255',
            'site_subtitle_2' => 'nullable|string|max:255',
            'site_subtitle_3' => 'nullable|string|max:255',
            'site_subtitle_4' => 'nullable|string|max:255',
            'site_subtitle_5' => 'nullable|string|max:255',
            'site_subtitle_6' => 'nullable|string|max:255',
            'site_subtitle_7' => 'nullable|string|max:255',
            'site_subtitle_8' => 'nullable|string|max:255',
            'site_subtitle_9' => 'nullable|string|max:255',
            'site_subtitle_10' => 'nullable|string|max:255',
            'site_subtitle_11' => 'nullable|string|max:255',
            'site_subtitle_12' => 'nullable|string|max:255',
            'site_subtitle_13' => 'nullable|string|max:255',
            'site_subtitle_14' => 'nullable|string|max:255',
            'site_subtitle_15' => 'nullable|string|max:255',
            'site_button_text_1' => 'nullable|string|max:255',
            'site_button_text_2' => 'nullable|string|max:255',
            'site_button_text_3' => 'nullable|string|max:255',
            'site_button_text_4' => 'nullable|string|max:255',
            'site_button_text_5' => 'nullable|string|max:255',
            'site_button_text_6' => 'nullable|string|max:255',
            'site_button_text_7' => 'nullable|string|max:255',
            'site_button_text_8' => 'nullable|string|max:255',
            'site_button_text_9' => 'nullable|string|max:255',
            'site_button_text_10' => 'nullable|string|max:255',
            'site_button_text_11' => 'nullable|string|max:255',
            'site_button_text_12' => 'nullable|string|max:255',
            'site_button_text_13' => 'nullable|string|max:255',
            'site_button_text_14' => 'nullable|string|max:255',
            'site_button_text_15' => 'nullable|string|max:255',
            'site_button_link_1' => 'nullable|url|max:255',
            'site_button_link_2' => 'nullable|url|max:255',
            'site_button_link_3' => 'nullable|url|max:255',
            'site_button_link_4' => 'nullable|url|max:255',
            'site_button_link_5' => 'nullable|url|max:255',
            'site_button_link_6' => 'nullable|url|max:255',
            'site_button_link_7' => 'nullable|url|max:255',
            'site_button_link_8' => 'nullable|url|max:255',
            'site_button_link_9' => 'nullable|url|max:255',
            'site_button_link_10' => 'nullable|url|max:255',
            'site_button_link_11' => 'nullable|url|max:255',
            'site_button_link_12' => 'nullable|url|max:255',
            'site_button_link_13' => 'nullable|url|max:255',
            'site_button_link_14' => 'nullable|url|max:255',
            'site_button_link_15' => 'nullable|url|max:255',
        ]);

        Setting::set('site_name', $request->site_name);
        Setting::set('site_email', $request->site_email);
        Setting::set('site_description', $request->site_description);
        Setting::set('site_phone', $request->site_phone);
        Setting::set('site_address', $request->site_address);
        Setting::set('site_maps', $request->site_maps);

        if ($request->hasFile('site_logo')) {
            $oldLogo = Setting::get('site_logo');
            if ($oldLogo && file_exists(public_path($oldLogo))) {
                unlink(public_path($oldLogo));
            }
            
            $logo = $request->file('site_logo');
            $logoName = 'logo_' . time() . '.' . $logo->getClientOriginalExtension();
            $logo->move(public_path('settings'), $logoName);
            Setting::set('site_logo', 'settings/' . $logoName);
        }

        if ($request->hasFile('site_favicon')) {
            $oldFavicon = Setting::get('site_favicon');
            if ($oldFavicon && file_exists(public_path($oldFavicon))) {
                unlink(public_path($oldFavicon));
            }
            
            $favicon = $request->file('site_favicon');
            $faviconName = 'favicon_' . time() . '.' . $favicon->getClientOriginalExtension();
            $favicon->move(public_path('settings'), $faviconName);
            Setting::set('site_favicon', 'settings/' . $faviconName);
        }

        if ($request->hasFile('site_header')) {
            $oldHeader = Setting::get('site_header');
            if ($oldHeader && file_exists(public_path($oldHeader))) {
                unlink(public_path($oldHeader));
            }
            
            $header = $request->file('site_header');
            $headerName = 'header_' . time() . '.' . $header->getClientOriginalExtension();
            $header->move(public_path('settings'), $headerName);
            Setting::set('site_header', 'settings/' . $headerName);
        }

        if ($request->hasFile('site_background_1')) {
            $oldBg1 = Setting::get('site_background_1');
            if ($oldBg1 && file_exists(public_path($oldBg1))) {
                unlink(public_path($oldBg1));
            }
            
            $bg1 = $request->file('site_background_1');
            $bg1Name = 'background1_' . time() . '.' . $bg1->getClientOriginalExtension();
            $bg1->move(public_path('settings'), $bg1Name);
            Setting::set('site_background_1', 'settings/' . $bg1Name);
        }

        if ($request->hasFile('site_background_2')) {
            $oldBg2 = Setting::get('site_background_2');
            if ($oldBg2 && file_exists(public_path($oldBg2))) {
                unlink(public_path($oldBg2));
            }
            
            $bg2 = $request->file('site_background_2');
            $bg2Name = 'background2_' . time() . '.' . $bg2->getClientOriginalExtension();
            $bg2->move(public_path('settings'), $bg2Name);
            Setting::set('site_background_2', 'settings/' . $bg2Name);
        }

        Setting::set('site_facebook', $request->site_facebook);
        Setting::set('site_twitter', $request->site_twitter);
        Setting::set('site_instagram', $request->site_instagram);
        Setting::set('site_youtube', $request->site_youtube);
        Setting::set('site_linkedin', $request->site_linkedin);
        Setting::set('site_tiktok', $request->site_tiktok);

        for ($i = 1; $i <= 15; $i++) {
            Setting::set('site_title_' . $i, $request->{'site_title_' . $i});
        }

        for ($i = 1; $i <= 15; $i++) {
            Setting::set('site_subtitle_' . $i, $request->{'site_subtitle_' . $i});
        }

        for ($i = 1; $i <= 15; $i++) {
            Setting::set('site_button_text_' . $i, $request->{'site_button_text_' . $i});
            Setting::set('site_button_link_' . $i, $request->{'site_button_link_' . $i});
        }

        return redirect()->back()->with('success', 'Pengaturan berhasil diperbarui');
    }
}
