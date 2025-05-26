<?php
require_once '../A_Model/user_model.php';
$discography = loadDiscography();
?>

<main>
    <!-- Modals for Singles -->
    <?php foreach ($discography->singles->single as $single): ?>
    <dialog class="modal" id="modal-single-<?= $single->id ?>">
        <div class="modal-content">
            <img class="modals-picture" src="<?= $single->cover ?>" alt="">
            <div class="modal-text">
                <h1><?= $single->title ?></h1>
                <p><?= $single->description ?></p>
            </div>
            <div class="streaming-platform">
                <p>listen to it on:</p>
                <a href="<?= $single->spotify ?>"><img src="../images/spotify-icon.png"></a>
                <a href="<?= $single->applemusic ?>"><img src="../images/apple-music-icon.png" alt=""></a>
            </div>
        </div>
    </dialog>
    <?php endforeach; ?>

    <!-- Modals for EPs -->
    <?php foreach ($discography->eps->ep as $ep): ?>
    <dialog class="modal" id="modal-ep-<?= $ep->id ?>">
        <div class="modal-content">
            <img class="modals-picture" src="<?= $ep->cover ?>" alt="">
            <div class="modal-text">
                <h1><?= $ep->title ?></h1>
                <p><?= $ep->description ?></p>
            </div>
            <div class="streaming-platform">
                <p>listen to it on:</p>
                <a href="<?= $ep->spotify ?>"><img src="../images/spotify-icon.png"></a>
                <a href="<?= $ep->applemusic ?>"><img src="../images/apple-music-icon.png" alt=""></a>
            </div>
        </div>
    </dialog>
    <?php endforeach; ?>

    <!-- Modals for Albums -->
    <?php foreach ($discography->albums->album as $album): ?>
    <dialog class="modal" id="modal-album-<?= $album->id ?>">
        <div class="modal-content">
            <img class="modals-picture" src="<?= $album->cover ?>" alt="">
            <div class="modal-text">
                <h1><?= $album->title ?></h1>
                <p><?= $album->description ?></p>
            </div>
            <div class="streaming-platform">
                <p>listen to it on:</p>
                <a href="<?= $album->spotify ?>"><img src="../images/spotify-icon.png"></a>
                <a href="<?= $album->applemusic ?>"><img src="../images/apple-music-icon.png" alt=""></a>
            </div>
        </div>
    </dialog>
    <?php endforeach; ?>

    <div id="cards">
        <!-- Singles Section -->
        <div class="card singles" id="card_1">
            <div class="card_content">
                <h1>Singles</h1>
                <div class="seperator"></div>
                <br>
                <div id="singles">
                    <?php foreach ($discography->singles->single as $single): ?>
                    <div class="single" id="single-<?= $single->id ?>">
                        <img src="<?= $single->cover ?>">
                        <p class="releaseTitle"><?= $single->title ?></p>
                        <p class="releaseDate"><?= $single->year ?> &bull; Single</p>
                    </div>
                    <?php endforeach; ?>
                </div>
            </div>
        </div>

        <!-- EPs Section -->
        <div class="card eps" id="card_2">
            <div class="card_content">
                <h1>EPs</h1>
                <div class="seperator"></div>
                <br>
                <div id="eps">
                    <?php foreach ($discography->eps->ep as $ep): ?>
                    <div class="ep" id="ep-<?= $ep->id ?>">
                        <img src="<?= $ep->cover ?>">
                        <p class="releaseTitle"><?= $ep->title ?></p>
                        <p class="releaseDate"><?= $ep->year ?> &bull; EP</p>
                    </div>
                    <?php endforeach; ?>
                </div>
            </div>
        </div>

        <!-- Albums Section -->
        <div class="card albums" id="card_3">
            <div class="card_content">
                <h1>Albums</h1>
                <div class="seperator"></div>
                <br>
                <div id="albums">
                    <?php foreach ($discography->albums->album as $album): ?>
                    <div class="album" id="album-<?= $album->id ?>">
                        <img src="<?= $album->cover ?>">
                        <div class="release-desc">
                            <p class="releaseTitle"><?= $album->title ?></p>
                            <p class="releaseDate"><?= $album->year ?> &bull; Album</p>
                        </div>
                    </div>
                    <?php endforeach; ?>
                </div>
            </div>
        </div>
    </div>
</main>
<script src="../script/discography.js"></script>