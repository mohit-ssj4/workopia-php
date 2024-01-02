<?php
// Header section
loadPartial('head');
// Navbar section
loadPartial('navbar');
?>

<div class="flex justify-center items-center mt-20">
    <div class="bg-white p-8 rounded-lg shadow-md w-full md:w-500 mx-6">
        <h2 class="text-4xl text-center font-bold mb-2">Login</h2>
        <!-- Flash Message Start -->
        <?php loadPartial('message'); ?>
        <!-- Flash Message End -->
        <form method="POST" action="/auth/login">
            <?php loadPartial('errors', [
                'errors' => $errors ?? []
            ]); ?>
            <div class="mb-2">
                <label for="email">Email</label>
                <input
                        id="email"
                        type="email"
                        name="email"
                        placeholder="Email Address"
                        class="w-full px-4 py-2 my-3 border rounded focus:outline-none"
                        value="<?= $email ?? '' ?>"
                />
            </div>
            <div class="mb-2">
                <label for="password">Password</label>
                <input
                        id="password"
                        type="password"
                        name="password"
                        placeholder="Password"
                        class="w-full px-4 py-2 my-3 border rounded focus:outline-none"
                />
            </div>
            <button
                    type="submit"
                    class="w-full bg-blue-500 hover:bg-blue-600 text-white px-4 py-2 rounded focus:outline-none"
            >
                Login
            </button>

            <p class="mt-4 text-gray-500">
                Don't have an account?
                <a class="text-blue-900" href="/auth/register">Register</a>
            </p>
        </form>
    </div>
</div>

<?php
// Footer section
loadPartial('footer');
?>
