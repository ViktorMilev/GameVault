<?php

namespace App\Services;

use App\Models\Category;
use App\Models\Subcategory;
use App\Models\Game;
use App\Models\Platform;
use App\Models\GamePlatform;
use App\Models\User;
use Illuminate\Support\Facades\DB;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class AdminService
{
    public function fetchCategoryEntitiesCountMap() {     
        return [
            'game_categories' => Category::count(),
            'game_platforms' => Platform::count(),
            'games' => Game::count(),
            'users' => User::count(),
        ];
    }

    public function fetchLatestGames() {
        return Game::with(['category'])->with(['platforms'])->orderBy('release_date', 'desc')->take(5)->get();
    }


    

    public function updateGame(Request $request, $slug) {
        $request->validate([
            'title' => 'required|string|max:255',
            'slug' => 'nullable|string|max:255',
            'short_description' => 'nullable|string',
            'description' => 'nullable|string',
            'category_id' => 'nullable|integer',
            'subcategory_id' => 'nullable|integer',
            'platforms' => 'nullable|array',
            'trailer_url' => 'nullable|url',
            'meta_title' => 'nullable|string|max:255',
            'meta_description' => 'nullable|string',
        ]);

        $exists = DB::table('games')->where('slug', $slug)->first();

        if (!$exists) {
            return redirect()->back()->with('error', "Game with slug '{$slug}' not found.");
        }

        $updateData = [];
        $fields = [
            'title' => 'name',
            'slug' => 'slug',
            //'short_description' => 'short_description',
            'description' => 'description',
            'category_id' => 'category_id',
            'subcategory_id' => 'subcategory_id',
            //'trailer_url' => 'trailer_url',
            //'meta_title' => 'meta_title',
            //'meta_description' => 'meta_description',
        ];

        foreach($fields as $requestKey => $dbColumn) {
            if ($request->has($requestKey)) {
                $updateData[$dbColumn] = $request->input($requestKey);
            }
        }

        if ($request->hasFile('gallery')) {
            $galleryFiles = [];
            foreach ($request->file('gallery') as $file) {
                $filename = time() . '_' . $file->getClientOriginalName();
                $file->storeAs('public/uploads', $filename);
                $galleryFiles[] = $filename;
            }
            $updateData['gallery'] = json_encode($galleryFiles);
        }

        if (empty($updateData)) {
            return redirect()->back()->with('error', 'Nothing to update.');
        }

        $game = Game::where('slug', $slug)->first();

        $game->update($updateData);

        if ($request->has('platforms')) {
            $game->platforms()->sync($request->input('platforms'));
        }

        return redirect('/admin/games/edit/' . $game->slug)->with('success', 'Game updated successfully.');
    }

    public function updateGamePlatform(Request $request, $slug) {
        $request->validate([
            'name' => 'required|string|max:255',
            'slug' => 'nullable|string|max:255',
        ]);

        $exists = DB::table('platforms')->where('slug', $slug)->first();

        if (!$exists) {
            return redirect()->back()->with('error', "Game Platform with slug '{$slug}' not found.");
        }

        $updateData = [];
        $fields = [
            'name' => 'name',
            'slug' => 'slug',
        ];

        foreach($fields as $requestKey => $dbColumn) {
            if ($request->has($requestKey)) {
                $updateData[$dbColumn] = $request->input($requestKey);
            }
        }

        if (empty($updateData)) {
            return redirect()->back()->with('error', 'Nothing to update.');
        }

        $gamePlatform = Platform::where('slug', $slug)->first();

        $gamePlatform->update($updateData);

        return redirect('/admin/game_platforms/edit/' . $gamePlatform->slug)->with('success', 'Game Platform updated successfully.');
    }

    public function updateGameCategory(Request $request, $slug) {
        $request->validate([
            'name' => 'required|string|max:255',
        ]);

        $exists = DB::table('categories')->where('id', $slug)->first();

        if (!$exists) {
            return redirect()->back()->with('error', "Game Category with slug '{$slug}' not found.");
        }

        $updateData = [];
        $fields = [
            'name' => 'name',
        ];

        foreach($fields as $requestKey => $dbColumn) {
            if ($request->has($requestKey)) {
                $updateData[$dbColumn] = $request->input($requestKey);
            }
        }

        if (empty($updateData)) {
            return redirect()->back()->with('error', 'Nothing to update.');
        }

        $gameCategory = Category::where('id', $slug)->first();

        $gameCategory->update($updateData);

        return redirect('/admin/categories/edit/' . $gameCategory->id)->with('success', 'Game Category updated successfully.');
    }

    public function updateUser(Request $request, $username)
    {
        $user = User::where('username', $username)->firstOrFail();

        $updateData = [];

        if ($request->has('username')) {
            $updateData['username'] = $request->input('username');
        }

        if ($request->has('email')) {
            $updateData['email'] = $request->input('email');
        }

        if ($request->hasFile('avatar')) {
            $file = $request->file('avatar');
            $filename = time() . '_' . $file->getClientOriginalName();
            $file->storeAs('public/uploads', $filename);
            $updateData['avatar'] = $filename;
        }

        if (!empty($updateData)) {
            $user->update($updateData);
        }

        return redirect('/admin/users/edit/' . $user->username)->with('success', 'User updated successfully.');
    }
}