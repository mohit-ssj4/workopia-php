<?php
// Header section
loadPartial('head');
// Navbar section
loadPartial('navbar');
?>

<div class="flex justify-center items-center mt-20">
    <div class="bg-white p-8 rounded-lg shadow-md w-full md:w-500 mx-6">
        <h2 class="text-4xl text-center font-bold mb-4">Register</h2>
        <!-- Flash Message Start -->
        <?php loadPartial('message'); ?>
        <!-- Flash Message End -->
        <form>
            <div class="mb-2">
                <label for="name">Name</label>
                <input
                        id="name"
                        type="text"
                        name="name"
                        placeholder="Full Name"
                        class="w-full px-4 py-2 my-3 border rounded focus:outline-none"
                />
            </div>
            <div class="mb-2">
                <label for="email">Email</label>
                <input
                        id="email"
                        type="email"
                        name="email"
                        placeholder="Email Address"
                        class="w-full px-4 py-2 my-3 border rounded focus:outline-none"
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
            <div class="mb-2">
                <label for="password_confirmation">Confirm password</label>
                <input
                        id="password_confirmation"
                        type="password"
                        name="password_confirmation"
                        placeholder="Confirm Password"
                        class="w-full px-4 py-2 my-3 border rounded focus:outline-none"
                />
            </div>
            <button
                    type="submit"
                    class="w-full bg-blue-500 hover:bg-blue-600 text-white px-4 py-2 rounded focus:outline-none"
            >
                Register
            </button>

            <p class="mt-4 text-gray-500">
                Already have an account?
                <a class="text-blue-900" href="/auth/login">Login</a>
            </p>
        </form>
    </div>
</div>

<?php
// Footer section
loadPartial('footer');
?>
