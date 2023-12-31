<?php
// Header section
loadPartial('head');
// Navbar section
loadPartial('navbar');
// Top banner section
loadPartial('top-banner');
?>

<section class="flex justify-center items-center mt-20">
    <div class="bg-white p-8 rounded-lg shadow-md w-full md:w-600 mx-6">
        <h2 class="text-4xl text-center font-bold mb-4">Edit Job Listing</h2>
        <!-- Flash Message Start -->
        <?php loadPartial('message'); ?>
        <!-- Flash Message End -->
        <form method="POST" action="/listings/<?= $listing->id ?>">
            <input type="hidden" name="_method" value="PUT">
            <h2 class="text-2xl font-bold mb-6 text-center text-gray-500">
                Job Info
            </h2>
            <?php loadPartial('errors', [
                'errors' => $errors ?? []
            ]); ?>
            <div class="mb-2">
                <label for="title">Title</label>
                <input
                        id="title"
                        type="text"
                        name="title"
                        placeholder="Job Title"
                        class="w-full px-4 py-2 my-3 border rounded focus:outline-none"
                        value="<?= $listing->title ?? '' ?>"
                />
            </div>
            <div class="mb-2">
                <label for="description">Description</label>
                <textarea
                        id="description"
                        name="description"
                        placeholder="Job Description"
                        class="w-full py-2 px-4 my-3 border rounded focus:outline-none"
                ><?= $listing->description ?? '' ?></textarea>
            </div>
            <div class="mb-2">
                <label for="salary">Salary</label>
                <input
                        id="salary"
                        type="text"
                        name="salary"
                        placeholder="Annual Salary"
                        class="w-full px-4 py-2 my-3 border rounded focus:outline-none"
                        value="<?= $listing->salary ?? '' ?>"
                />
            </div>
            <div class="mb-2">
                <label for="requirements">Requirements</label>
                <input
                        id="requirements"
                        type="text"
                        name="requirements"
                        placeholder="Requirements"
                        class="w-full px-4 py-2 my-3 border rounded focus:outline-none"
                        value="<?= $listing->requirements ?? '' ?>"
                />
            </div>
            <div class="mb-2">
                <label for="benefits">Benefits</label>
                <input
                        id="benefits"
                        type="text"
                        name="benefits"
                        placeholder="Benefits"
                        class="w-full px-4 py-2 my-3 border rounded focus:outline-none"
                        value="<?= $listing->benefits ?? '' ?>"
                />
            </div>
            <div class="mb-2">
                <label for="tags">Tags</label>
                <input
                        id="tags"
                        type="text"
                        name="tags"
                        placeholder="Tags"
                        class="w-full px-4 py-2 my-3 border rounded focus:outline-none"
                        value="<?= $listing->tags ?? '' ?>"
                />
            </div>
            <h2 class="text-2xl font-bold mb-6 text-center text-gray-500">
                Company Info & Location
            </h2>
            <div class="mb-2">
                <label for="company">Company</label>
                <input
                        id="company"
                        type="text"
                        name="company"
                        placeholder="Company Name"
                        class="w-full px-4 py-2 my-3 border rounded focus:outline-none"
                        value="<?= $listing->company ?? '' ?>"
                />
            </div>
            <div class="mb-2">
                <label for="address">Address</label>
                <input
                        id="address"
                        type="text"
                        name="address"
                        placeholder="Address"
                        class="w-full px-4 py-2 my-3 border rounded focus:outline-none"
                        value="<?= $listing->address ?? '' ?>"
                />
            </div>
            <div class="mb-2">
                <label for="city">City</label>
                <input
                        id="city"
                        type="text"
                        name="city"
                        placeholder="City"
                        class="w-full px-4 py-2 my-3 border rounded focus:outline-none"
                        value="<?= $listing->city ?? '' ?>"
                />
            </div>
            <div class="mb-2">
                <label for="state">State</label>
                <input
                        id="state"
                        type="text"
                        name="state"
                        placeholder="State"
                        class="w-full px-4 py-2 my-3 border rounded focus:outline-none"
                        value="<?= $listing->state ?? '' ?>"
                />
            </div>
            <div class="mb-2">
                <label for="phone">Phone</label>
                <input
                        id="phone"
                        type="text"
                        name="phone"
                        placeholder="Phone"
                        class="w-full px-4 py-2 my-3 border rounded focus:outline-none"
                        value="<?= $listing->phone ?? '' ?>"
                />
            </div>
            <div class="mb-2">
                <label for="email">Email</label>
                <input
                        id="email"
                        type="email"
                        name="email"
                        placeholder="Email Address For Applications"
                        class="w-full px-4 py-2 my-3 border rounded focus:outline-none"
                        value="<?= $listing->email ?? '' ?>"
                />
            </div>
            <button
                    class="w-full bg-green-500 hover:bg-green-600 text-white px-4 py-2 my-3 rounded focus:outline-none"
            >
                Save
            </button>
            <a
                    href="/listings/<?= $listing->id ?>"
                    class="block text-center w-full bg-red-500 hover:bg-red-600 text-white px-4 py-2 rounded focus:outline-none"
            >
                Cancel
            </a>
        </form>
    </div>
</section>

<?php
loadPartial('bottom-banner');
// Footer section
loadPartial('footer');
?>
