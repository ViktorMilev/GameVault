@php
   //dd($gameData);
   $gameReviews = [1, 2, 3, 4, 5, 6, 7, 8, 9, 10];
@endphp

<div class=" text-white m-4 game-article-container">
    <div class="row align-items-start mb-4">
        <div class="col-md-4">
            <img src="{{ asset('/images/game_covers/' . $gameData[0]['cover_image']) }}" alt="{{ $gameData[0]['name'] }}" class="game-article-img w-100">
        </div>
        <div class="col-md-8 px-4">
            <!-- insert a long mini-list row-col of game parameters here -->
             <div class="row">
                <div class="col-6 fw-bold">Developer:</div>
                <div class="col-6">{{ $gameData[0]['developer'] }}</div>
             </div>
             <div class="row mt-4">
                <div class="col-6 fw-bold">Publisher:</div>
                <div class="col-6">{{ $gameData[0]['publisher'] }}</div>
             </div>
             <div class="row mt-4">
                <div class="col-6 fw-bold">Description:</div>
                <div class="col-6">{{ $gameData[0]['description'] }}</div>
             </div>
        </div>
    </div>
    <div class="row align-items-center">
        <div class="col-md-4">    
            <div class="row align-items-center">
                <div class="col-8 text-left">
                    <h5 class="m-0">{{ $gameData[0]['name'] }}</h5>
                </div>
                <div class="col-4 text-end">
                    <span>{{ \Carbon\Carbon::parse($gameData[0]['release_date'])->format('d.m.Y') }}</span>
                </div>
            </div>
        </div>
        <div class="col-md-8"></div>
    </div>
    <div class="row align-items-start game-article-box mt-5">
        <div class="col">
            <div class="row mb-3">
                <h4 class="header">Game Reviews:</h4>
            </div>
            @foreach($gameReviews as $review)
                <div class="row game-review mb-4 align-items-start">
              
                            <div class="col-1 d-flex justify-content-center">
                                <img src="https://backloggd-avatars.b-cdn.net/t7x1j833it14jk5wputupipnxf83?optimizer=image&quality=25" alt="" class="user-profile-img">
                            </div>
                            <div class="col-7">
                                <div class="row">
                                    <div class="col">
                                        <span class="username">User_0904994255434</span>
                                    </div>
                                </div>
                                <div class="row">
                                    <div class="col">
                                        <span class="star"></span>
                                        <span class="star"></span>
                                        <span class="star"></span>
                                        <span class="star"></span>
                                        <span class="star"></span>
                                    </div>
                                </div>
                                <div class="row">
                                    <div class="col">
                                        This game sucks ass, it's horrible.
                                    </div>
                                </div>
                                <div class="row">
                                    <div class="col">
                                        Test
                                    </div>
                                </div>
                            </div>
                            <div class="col-4 text-end">Feb 02, 2025</div>
         
                </div>
                <hr class="my-4"/>
            @endforeach
        </div>
    </div>
    <div class="row mt-4">
    <div class="col-12" id="gameArticleReviewForm">
        <div class="bg-dark card p-3">
            <h5 class="card-title text-light mb-3">Write a New Review</h5>
            <form action="#" method="POST">
                @csrf

                <div class="mb-3">
                    <label for="username" class="form-label text-light">Your Username</label>
                    <input type="text" class="form-control" id="username" name="username" placeholder="Enter your username" required>
                </div>

                <div class="mb-3">
                    <label for="rating" class="form-label text-light">Rate this game</label>
                    <select class="form-select" id="rating" name="rating" required>
                        <option value="" selected disabled>Choose a rating for this game</option>
                        <option value="1">1 ★</option>
                        <option value="2">2 ★★</option>
                        <option value="3">3 ★★★</option>
                        <option value="4">4 ★★★★</option>
                        <option value="5">5 ★★★★★</option>
                    </select>
                </div>

                <div class="mb-3">
                    <label for="review-text" class="form-label text-light">Your Review</label>
                    <textarea class="form-control" id="review-text" name="text" rows="7" placeholder="Write your review here..." required></textarea>
                </div>

                <button type="submit" class="btn btn-primary">Submit Review</button>
            </form>
        </div>
    </div>
</div>

</div>