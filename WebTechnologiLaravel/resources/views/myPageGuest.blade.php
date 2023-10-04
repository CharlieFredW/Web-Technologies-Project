<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="{{asset('css/myPageGuestStyle.css')}}">
    <title>HomePage</title>
</head>
<body>
<div class="music-player">
    <div class="player-header">
        <div class="player-logo"></div>
        <h1>Music Player</h1>
    </div>
    <div class="music-info">
        <div class="song-cover"></div>
        <div class="song-details">
            <h2>Song Title</h2>
            <p>Artist Name</p>
        </div>
    </div>
    <div class="music-controls">
        <button class="control-btn">Previous</button>
        <button class="control-btn">Play</button>
        <button class="control-btn">Next</button>
    </div>

    <div class="input-field">
        <button type="submit" class="submit" onclick="window.location.href = 'MyPageCreator.html';">Your Page</button>

    </div>
</div>
</body>
</html>
