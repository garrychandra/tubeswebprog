<?php
$authors = loadAuthors();
?>

<main class="padding-y-xl">
    <div class="container">
        <div class="text-component text-center">
            <h1 class="text-xxxl">Hello!</h1>
            <p class="text-md">We made this website</p>
        </div>
    </div>

    <div class="container max-width-adaptive-md margin-bottom-lg">
        <ul class="stack-cards js-stack-cards">
            <?php foreach ($authors->author as $author): ?>
                <li data-theme="default" class="stack-cards__item bg radius-lg shadow-md js-stack-cards__item">
                    <div class="grid">
                        <div class="col-6 flex items-center height-100%">
                            <div class="text-component padding-md">
                                <h2><?= htmlspecialchars($author->name) ?></h2>
                                <?php foreach ($author->pages->page as $page): ?>
                                    <p><a href="<?= htmlspecialchars($page->url) ?>" class="btn btn--subtle"><?= htmlspecialchars($page->title) ?></a></p>
                                <?php endforeach; ?>
                            </div>
                        </div>

                        <div class="col-6 height-100%">
                            <img class="block width-100% height-100% object-cover" 
                                 src="<?= htmlspecialchars($author->image) ?>" 
                                 alt="<?= htmlspecialchars($author->name) ?>">
                        </div>
                    </div>
                </li>
            <?php endforeach; ?>
        </ul>
    </div>
</main>
