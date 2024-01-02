<?php
// Header section
loadPartial('head');
// Navbar section
loadPartial('navbar');
// Top banner section
loadPartial('top-banner');
?>

<!-- Job Listings -->
<section>
    <div class="container mx-auto p-4 mt-4">
        <div class="text-center text-3xl mb-4 font-bold border border-gray-300 p-3">Recent Jobs</div>
        <div class="grid grid-cols-1 md:grid-cols-3 gap-4 mb-6">
            <?php if (!empty($listings)) : ?>
                <?php foreach ($listings as $listing) : ?>
                    <div class="rounded-lg shadow-md bg-white">
                        <div class="p-4">
                            <h2 class="text-xl font-semibold"><?= $listing->title ?></h2>
                            <p class="text-gray-700 text-lg mt-2">
                                <?= $listing->description ?>
                            </p>
                            <ul class="my-4 bg-gray-100 p-4 rounded">
                                <li class="mb-2"><strong>Salary:</strong> <?= formatSalary($listing->salary) ?></li>
                                <li class="mb-2">
                                    <strong>Location:</strong> <?= $listing->city, ', ', $listing->state ?>
                                </li>
                                <?php if (!empty($listing->tags)) : ?>
                                    <li class="mb-2">
                                        <strong>Tags:</strong> <span><?= ucwords($listing->tags) ?></span>
                                    </li>
                                <?php endif; ?>
                            </ul>
                            <a href="/listing/<?= $listing->id ?>"
                               class="block w-full text-center px-5 py-2.5 shadow-sm rounded border text-base font-medium text-indigo-700 bg-indigo-100 hover:bg-indigo-200"
                            >
                                Details
                            </a>
                        </div>
                    </div>
                <?php endforeach; ?>
            <?php else : ?>
                <div class="rounded-lg shadow-md bg-white">
                    <div class="p-4">
                        <p class="text-gray-700 text-lg mt-2">
                            No listings to show yet
                        </p>
                    </div>
                </div>
            <?php endif; ?>
        </div>
</section>

<?php
// Bottom banner section
loadPartial('bottom-banner');
// Footer section
loadPartial('footer');
?>
