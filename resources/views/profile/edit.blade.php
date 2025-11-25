<x-app-layout>
    <div class="py-6 sm:py-12 bg-cyan-50 min-h-screen">
        <div class="max-w-4xl mx-auto px-4 sm:px-6 lg:px-8">

            <!-- Title -->
            <div class="mb-6 sm:mb-8">
                <h1 class="text-2xl sm:text-3xl font-bold text-gray-900 mb-2">
                    👤 Edit Profil
                </h1>
                <p class="text-sm sm:text-base text-gray-600">
                    Update informasi pribadi Anda
                </p>
            </div>

            <!-- Update Profile Information -->
            <div class="bg-white border border-black rounded-lg shadow-[6px_6px_0px_rgba(0,0,0,1)] p-6 sm:p-8 mb-6">
                @include('profile.partials.update-profile-information-form')
            </div>

            <!-- Update Password -->
            <div class="bg-white border border-black rounded-lg shadow-[6px_6px_0px_rgba(0,0,0,1)] p-6 sm:p-8 mb-6">
                @include('profile.partials.update-password-form')
            </div>

            <!-- Delete Account -->
            <div class="bg-white border border-black rounded-lg shadow-[6px_6px_0px_rgba(0,0,0,1)] p-6 sm:p-8">
                @include('profile.partials.delete-user-form')
            </div>

        </div>
    </div>
</x-app-layout>
