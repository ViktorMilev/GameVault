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
use Illuminate\Support\Str;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\Validator;
use Carbon\Carbon;


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


    


    public function addGame(Request $request) {
        $validator = Validator::make($request->all(), [
            'title' => 'required|string|max:255',
            'slug' => 'nullable|string|max:255',
            'short_description' => 'nullable|string',
            'description' => 'required|string|max:255',
            'category_id' => 'nullable|integer',
            'subcategory_id' => 'nullable|integer',
            'platforms' => 'nullable|array',
            'trailer_url' => 'nullable|url',
            'meta_title' => 'nullable|string|max:255',
            'meta_description' => 'nullable|string',
        ]);

        if ($validator->fails()) {
            return redirect()->back()->withErrors($validator)->withInput();
        }

        $validated = $validator->validated();

        $newData = [
            'name' => $validated['title'],
            'slug' => $validated['slug'] ?? Str::slug($validated['title']),
            //'short_description' => 'short_description',
            'description' => $validated['description'] ?? '',
            'category_id' => $validated['category_id'] ?? 0,
            'subcategory_id' => $validated['subcategory_id'] ?? 0,
            //'trailer_url' => 'trailer_url',
            'cover_image' => '',
            'developer' => '',
            'publisher' => '',
            'release_date' => Carbon::now(),
            //'meta_title' => 'meta_title',
            //'meta_description' => 'meta_description',
        ];

        if ($request->hasFile('thumbnail')) {
            $file = $request->file('thumbnail');
            $filename = uniqid() . '_' . $file->getClientOriginalName();
            $destinationPath = public_path('images/game_covers');
            $file->move($destinationPath, $filename);
            $newData['cover_image'] = $filename;
        }

        if ($request->hasFile('gallery')) {
            $galleryFiles = [];

            foreach ($request->file('gallery') as $file) {
                $filename = uniqid() . '_' . $file->getClientOriginalName();
                $file->storeAs('public/images/game_galleries/game' . '___' . $newData['slug'], $filename);
                $galleryFiles[] = $filename;
            }

            //$newData['gallery'] = $galleryFiles;
        }

        DB::transaction(function() use ($newData, $validated, &$game) {
            $game = Game::create($newData);

            if (!empty($validated['platforms'])) {
                $game->platforms()->sync($validated['platforms']);
            }
        });


        return redirect('/admin/games/new-game')->with('success', __('admin.success_messages.game_added'));
    }

    public function addGamePlatform(Request $request) {
        $validator = Validator::make($request->all(), [
            'name' => 'required|string|max:255',
            'slug' => 'nullable|string|max:255',
        ]);

        if ($validator->fails()) {
            return redirect()->back()->withErrors($validator)->withInput();
        }

        $validated = $validator->validated();

        $filename = '';
        if ($request->hasFile('thumbnail')) {
            $file = $request->file('thumbnail');
            $filename = uniqid() . '_' . $file->getClientOriginalName();
            $destinationPath = public_path('images/platform_icons');
            $file->move($destinationPath, $filename);
        }

        $newData = [
            'name' => $validated['name'],
            'slug' => $validated['slug'] ?? Str::slug($validated['name']),
            'icon_filepath' => $filename,
        ];

        $gamePlatform = Platform::create($newData);


        return redirect('/admin/platforms/new-platform')->with('success', __('admin.success_messages.platform_added'));
    }

    public function addGameCategory(Request $request) {
        $validator = Validator::make($request->all(), [
            'name' => 'required|string|max:255',
        ]);

        if ($validator->fails()) {
            return redirect()->back()->withErrors($validator)->withInput();
        }

        $validated = $validator->validated();

        $newData = [
            'name' => $validated['name'],
        ];

        $gameCategory = Category::create($newData);


        return redirect('/admin/categories/new-category')->with('success', __('admin.success_messages.category_added'));
    }

    public function addGameSubcategory(Request $request) {
        $validator = Validator::make($request->all(), [
            'name' => 'required|string|max:255',
            'parent_category_id' => 'required|integer|exists:categories,id',
        ]);

        if ($validator->fails()) {
            return redirect()->back()->withErrors($validator)->withInput();
        }

        $validated = $validator->validated();

        $newData = [
            'name' => $validated['name'],
            'category_id' => $validated['parent_category_id'],
            'slug' => Str::slug($validated['name']),
        ];

        $gameSubcategory = Subcategory::create($newData);
        

        return redirect('/admin/subcategories/new-subcategory')->with('success', __('admin.success_messages.subcategory_added'));
    }

    public function addUser(Request $request) {
        $validator = Validator::make($request->all(), [
            'username' => 'required|string|max:255|unique:users,username',
            'email' => 'required|string|email|max:255|unique:users,email',
            'avatar' => 'nullable|image|max:2048',
        ]);

        if ($validator->fails()) {
            return redirect()->back()->withErrors($validator)->withInput();
        }

        $validated = $validator->validated();

        $newData = [
            'username' => $validated['username'],
            'email' => $validated['email'],
            'password' => bcrypt('defaultpassword'),
            'avatar' => '',
        ];

        if ($request->hasFile('avatar')) {
            $file = $request->file('avatar');
            $filename = time() . '_' . $file->getClientOriginalName();
            $file->storeAs('public/uploads', $filename);
            $newData['avatar'] = $filename;
        }

        $user = User::create($newData);

        return redirect('/admin/users/new-user')->with('success', __('admin.success_messages.user_added'));
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

        if ($request->hasFile('thumbnail')) {
            $file = $request->file('thumbnail');
            $filename = uniqid() . '_' . $file->getClientOriginalName();
            $destinationPath = public_path('images/game_covers');
            $file->move($destinationPath, $filename);
            $updateData['cover_image'] = $filename;
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

        return redirect('/admin/games/edit/' . $game->slug)->with('success', __('admin.success_messages.game_updated'));
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

        if ($request->hasFile('thumbnail')) {
            $file = $request->file('thumbnail');
            $filename = uniqid() . '_' . $file->getClientOriginalName();
            $destinationPath = public_path('images/platform_icons');
            $file->move($destinationPath, $filename);
            $updateData['icon_filepath'] = $filename;
        }

        if (empty($updateData)) {
            return redirect()->back()->with('error', 'Nothing to update.');
        }

        $gamePlatform = Platform::where('slug', $slug)->first();

        $gamePlatform->update($updateData);

        return redirect('/admin/game_platforms/edit/' . $gamePlatform->slug)->with('success', __('admin.success_messages.platform_updated'));
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

        return redirect('/admin/categories/edit/' . $gameCategory->id)->with('success', __('admin.success_messages.category_updated'));
    }

    public function updateGameSubcategory(Request $request, $slug) {
        $request->validate([
            'name' => 'required|string|max:255',
        ]);

        $exists = DB::table('subcategories')->where('id', $slug)->first();

        if (!$exists) {
            return redirect()->back()->with('error', "Game Subcategory with slug '{$slug}' not found.");
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

        $gameCategory = Subcategory::where('id', $slug)->first();

        $gameCategory->update($updateData);

        return redirect('/admin/subcategories/edit/' . $gameCategory->id)->with('success', __('admin.success_messages.subcategory_updated'));
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

        return redirect('/admin/users/edit/' . $user->username)->with('success', __('admin.success_messages.user_updated'));
    }
}