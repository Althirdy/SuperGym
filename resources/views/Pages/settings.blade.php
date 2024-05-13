@extends('DefaultLayout')
@section('content')
    <div class="p-4  lg:w-[70%] md:mx-auto rounded-lg dark:border-gray-700">
        <div class="mb-5">
            <h1 class="text-[1.3rem] font-medium">Settings</h1>
            <p class="text-[1rem] mt-[-3px] text-gray-600 ">Meet Our Expert Team of SuperGym Coaches!</p>
        </div>
        <div class="lg:grid grid-cols-1 border-b  p-5 grid-cols-2 mt-10 ">
            <div class="w-[55%]">
                <h1 class="font-medium text-[1.2rem]">Add Account</h1>
                <p>Use a permanent address where you can receive mail.</p>
            </div>
            <form>
                <div class="grid gap-6 mb-6 md:grid-cols-2 my-3">
                    <div class="mb-2">
                        <label for="name"
                            class="block mb-1 text-sm font-medium text-gray-900 dark:text-white">Name</label>
                        <input type="text" name="name" id="password"
                            class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-primary-600 focus:border-primary-600 block w-full p-2.5 dark:bg-gray-600 dark:border-gray-500 dark:placeholder-gray-400 dark:text-white dark:focus:ring-primary-500 dark:focus:border-primary-500"
                            required="">
                    </div>
                    <div class="mb-2">
                        <label for="email"
                            class="block mb-1 text-sm font-medium text-gray-900 dark:text-white">Email</label>
                        <input type="email" name="email" id="email"
                            class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-primary-600 focus:border-primary-600 block w-full p-2.5 dark:bg-gray-600 dark:border-gray-500 dark:placeholder-gray-400 dark:text-white dark:focus:ring-primary-500 dark:focus:border-primary-500"
                            required="">
                    </div>
                    <div class="mb-2">
                        <label for="password"
                            class="block mb-1 text-sm font-medium text-gray-900 dark:text-white">Password</label>
                        <input type="password" name="password" id="password"
                            class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-primary-600 focus:border-primary-600 block w-full p-2.5 dark:bg-gray-600 dark:border-gray-500 dark:placeholder-gray-400 dark:text-white dark:focus:ring-primary-500 dark:focus:border-primary-500"
                            required="">
                    </div>
                </div>
                <button type="submit"
                    class="text-white bg-blue-700 hover:bg-blue-800 focus:ring-4 focus:outline-none focus:ring-blue-300 font-medium rounded-lg text-sm sm:w-auto px-5 py-2.5 text-center dark:bg-blue-600 dark:hover:bg-blue-700 dark:focus:ring-blue-800">Submit</button>
            </form>
        </div>
        <div class="lg:grid grid-cols-1 border-b  p-5 grid-cols-2 mt-10 ">
            <div class="w-[55%]">
                <h1 class="font-medium text-[1.2rem]">Update Category</h1>
                <p>Use a permanent address where you can receive mail.</p>
            </div>
            <form>
                <div class="grid gap-3 mb-6 grid-cols-2 my-3">
                    @foreach ($category as $cat)
                        <div class="mb-2 col-span-1">
                            <label for="name"
                                class="block mb-1 text-sm font-medium text-gray-900 dark:text-white">Category</label>
                            <input type="text" name="category" id="category" value="{{ $cat->category }}"
                                class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-primary-600 focus:border-primary-600 block w-full p-2.5 dark:bg-gray-600 dark:border-gray-500 dark:placeholder-gray-400 dark:text-white dark:focus:ring-primary-500 dark:focus:border-primary-500"
                                disabled>
                        </div>
                        <div class="mb-2">
                            <label for="price"
                                class="block mb-1 text-sm font-medium text-gray-900 dark:text-white">Price</label>
                            <input type="price" name="price" id="{{ $cat->id }}" value="Php {{ $cat->price }}"
                                class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-primary-600 focus:border-primary-600 block w-full p-2.5 dark:bg-gray-600 dark:border-gray-500 dark:placeholder-gray-400 dark:text-white dark:focus:ring-primary-500 dark:focus:border-primary-500">
                        </div>
                    @endforeach

                </div>
                <button type="submit"
                    class="text-white bg-blue-700 hover:bg-blue-800 focus:ring-4 focus:outline-none focus:ring-blue-300 font-medium rounded-lg text-sm  sm:w-auto px-5 py-2.5 text-center dark:bg-blue-600 dark:hover:bg-blue-700 dark:focus:ring-blue-800">Save</button>
            </form>
        </div>
        <div class="lg:grid grid-cols-1 border-b  p-5 grid-cols-2 mt-10 ">
            <div class="w-[55%]">
                <h1 class="font-medium text-[1.2rem]">Manage Goal / Coach Expertise</h1>
                <p>Use a permanent address where you can receive mail.</p>
            </div>
            <form>
                <div class="grid gap-3 mb-6 grid-cols-2 my-3">
                    @foreach ($goal as $goal)
                        <div class="mb-2 col-span-1">
                            <label for="name"
                                class="block mb-1 text-sm font-medium text-gray-900 dark:text-white">Goal/Expertise of
                                Coach</label>
                            <input type="text" name="category" id="category" value="{{ $goal->goal }}"
                                class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-primary-600 focus:border-primary-600 block w-full p-2.5 dark:bg-gray-600 dark:border-gray-500 dark:placeholder-gray-400 dark:text-white dark:focus:ring-primary-500 dark:focus:border-primary-500"
                                disabled>
                        </div>
                    @endforeach
                    <div class="mb-2 col-span-1">
                        <label for="name"
                            class="block mb-1 text-sm font-medium text-gray-900 dark:text-white">Goal/Expertise of
                            Coach</label>
                        <input type="text" name="category" id="add_goal" value="" placeholder="Add Goal"
                            class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-primary-600 focus:border-primary-600 block w-full p-2.5 dark:bg-gray-600 dark:border-gray-500 dark:placeholder-gray-400 dark:text-white dark:focus:ring-primary-500 dark:focus:border-primary-500">
                    </div>
                </div>
                <button type="submit"
                    class="text-white bg-blue-700 hover:bg-blue-800 focus:ring-4 focus:outline-none focus:ring-blue-300 font-medium rounded-lg text-sm  sm:w-auto px-5 py-2.5 text-center dark:bg-blue-600 dark:hover:bg-blue-700 dark:focus:ring-blue-800">Save</button>
            </form>
        </div>
    </div>
@endSection
