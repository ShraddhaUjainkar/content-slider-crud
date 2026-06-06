<?php
declare(strict_types=1);
$activeTabId = isset($tabs[0]) ? (int) $tabs[0]['id'] : 0;
?>
<!doctype html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title><?= e(APP_NAME) ?></title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
    <link href="https://cdn.jsdelivr.net/npm/swiper@11/swiper-bundle.min.css" rel="stylesheet">
    <link href="assets/css/style.css" rel="stylesheet">
</head>
<body>
<main class="experience-shell">
    <section class="tabs-showcase">
        <div class="container">
            <header class="showcase-header">
                <h1>DelphianLogic in Action</h1>
                <p>Lorem ipsum dolor sit amet, consectetuer adipiscing elit. Aenean commodo</p>
            </header>
            <div class="showcase-frame d-none d-lg-grid">
                <div class="tab-panel">
                    <div class="nav flex-column nav-pills vertical-tabs" id="desktopTabs" role="tablist" aria-orientation="vertical">
                        <?php foreach ($tabs as $index => $tab): ?>
                            <button
                                class="nav-link <?= $index === 0 ? 'active' : '' ?>"
                                id="tab-<?= (int) $tab['id'] ?>"
                                data-bs-toggle="pill"
                                data-bs-target="#pane-<?= (int) $tab['id'] ?>"
                                type="button"
                                role="tab"
                                aria-controls="pane-<?= (int) $tab['id'] ?>"
                                aria-selected="<?= $index === 0 ? 'true' : 'false' ?>">
                                <?php if (!empty($tab['icon'])): ?>
                                    <img src="<?= e($tab['icon']) ?>" alt="">
                                <?php endif; ?>
                                <span><?= e($tab['title']) ?></span>
                            </button>
                        <?php endforeach; ?>
                    </div>
                </div>

                <div class="tab-content content-panel">
                    <?php foreach ($tabs as $index => $tab): ?>
                        <?php
                        $tabId = (int) $tab['id'];
                        $slides = $slidesByTab[$tabId] ?? [];
                        ?>
                        <div class="tab-pane fade <?= $index === 0 ? 'show active' : '' ?>" id="pane-<?= $tabId ?>" role="tabpanel" aria-labelledby="tab-<?= $tabId ?>" tabindex="0">
                            <div class="swiper js-slide-swiper" data-tab-id="<?= $tabId ?>">
                                <div class="swiper-wrapper">
                                    <?php foreach ($slides as $slide): ?>
                                        <article class="swiper-slide showcase-slide" data-image="<?= e($slide['image']) ?>">
                                            <span class="tag-label"><?= e($slide['tag']) ?></span>
                                            <h1><?= e($slide['title']) ?></h1>
                                            <a href="<?= e($slide['learn_more_link']) ?>">Learn More</a>
                                        </article>
                                    <?php endforeach; ?>
                                </div>
                                <div class="slider-controls">
                                    <button class="swiper-button-prev" type="button" aria-label="Previous slide"></button>
                                    <div class="swiper-pagination"></div>
                                    <div class="design-dots" aria-hidden="true">
                                        <?php foreach ($tabs as $dotIndex => $dotTab): ?>
                                            <span class="<?= $dotIndex === $index ? 'is-active' : '' ?>"></span>
                                        <?php endforeach; ?>
                                    </div>
                                    <button class="swiper-button-next" type="button" aria-label="Next slide"></button>
                                </div>
                            </div>
                        </div>
                    <?php endforeach; ?>
                </div>

                <div class="image-panel">
                            <div class="image-square">
                        <?php
                        $firstSlides = $slidesByTab[$activeTabId] ?? [];
                        $firstImage = $firstSlides[0]['image'] ?? '';
                        ?>
                        <img id="desktopSlideImage" src="<?= e($firstImage) ?>" alt="">
                    </div>
                </div>
            </div>

            <div class="accordion mobile-accordion d-lg-none" id="mobileTabs">
                <?php foreach ($tabs as $index => $tab): ?>
                    <?php
                    $tabId = (int) $tab['id'];
                    $slides = $slidesByTab[$tabId] ?? [];
                    ?>
                    <div class="accordion-item">
                        <h2 class="accordion-header">
                            <button class="accordion-button <?= $index === 0 ? '' : 'collapsed' ?>" type="button" data-bs-toggle="collapse" data-bs-target="#mobile-pane-<?= $tabId ?>" aria-expanded="<?= $index === 0 ? 'true' : 'false' ?>" aria-controls="mobile-pane-<?= $tabId ?>">
                                <?php if (!empty($tab['icon'])): ?>
                                    <img src="<?= e($tab['icon']) ?>" alt="">
                                <?php endif; ?>
                                <span><?= e($tab['title']) ?></span>
                            </button>
                        </h2>
                        <div id="mobile-pane-<?= $tabId ?>" class="accordion-collapse collapse <?= $index === 0 ? 'show' : '' ?>" data-bs-parent="#mobileTabs">
                            <div class="accordion-body">
                                <div class="swiper js-slide-swiper mobile-swiper" data-tab-id="<?= $tabId ?>">
                                    <div class="swiper-wrapper">
                                        <?php foreach ($slides as $slide): ?>
                                            <article class="swiper-slide mobile-slide" style="background-image: url('<?= e($slide['image']) ?>')">
                                                <div class="mobile-slide-content">
                                                    <span class="tag-label"><?= e($slide['tag']) ?></span>
                                                    <h3><?= e($slide['title']) ?></h3>
                                                    <a href="<?= e($slide['learn_more_link']) ?>">Learn More</a>
                                                </div>
                                            </article>
                                        <?php endforeach; ?>
                                    </div>
                                    <div class="slider-controls">
                                        <button class="swiper-button-prev" type="button" aria-label="Previous slide"></button>
                                        <div class="swiper-pagination"></div>
                                        <button class="swiper-button-next" type="button" aria-label="Next slide"></button>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                <?php endforeach; ?>
            </div>
        </div>
    </section>
</main>

<script src="https://code.jquery.com/jquery-3.7.1.min.js"></script>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>
<script src="https://cdn.jsdelivr.net/npm/swiper@11/swiper-bundle.min.js"></script>
<script src="assets/js/app.js"></script>
</body>
</html>
