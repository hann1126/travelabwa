<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Edit Tour') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-3xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden p-10 shadow-sm sm:rounded-lg">
                <form method="POST" action="{{ route('admin.package_tours.update', $packageTour) }}" enctype="multipart/form-data">
                    @csrf
                    @method('PUT')

                    {{-- Name --}}
                    <div>
                        <x-input-label for="name" :value="__('Name')" />
                        <x-text-input id="name" class="block mt-1 w-full" type="text" name="name" value="{{ old('name', $packageTour->name) }}" required />
                        <x-input-error :messages="$errors->get('name')" class="mt-2" />
                    </div>

                    {{-- Thumbnail --}}
                    <div class="mt-4">
                        <x-input-label for="thumbnail" :value="__('Thumbnail')" />
                        <img src="{{ Storage::url($packageTour->thumbnail) }}" alt="" class="rounded-2xl object-cover w-[120px] h-[90px] mb-2">
                        <x-text-input id="thumbnail" class="block mt-1 w-full" type="file" name="thumbnail" />
                        <x-input-error :messages="$errors->get('thumbnail')" class="mt-2" />
                    </div>

                    {{-- Category --}}
                    <div class="mt-4">
                        <x-input-label for="category_id" :value="__('Category')" />
                        <select name="category_id" id="category_id" class="py-3 rounded-lg pl-3 w-full border border-slate-300">
                            <option value="">Choose category</option>
                            @foreach ($categories as $category)
                                <option value="{{ $category->id }}" {{ $packageTour->category_id == $category->id ? 'selected' : '' }}>
                                    {{ $category->name }}
                                </option>
                            @endforeach
                        </select>
                        <x-input-error :messages="$errors->get('category_id')" class="mt-2" />
                    </div>

                    {{-- About --}}
                    <div class="mt-4">
                        <x-input-label for="about" :value="__('About')" />
                        <textarea name="about" id="about" cols="30" rows="5" class="border border-slate-300 rounded-xl w-full">{{ old('about', $packageTour->about) }}</textarea>
                        <x-input-error :messages="$errors->get('about')" class="mt-2" />
                    </div>

                    {{-- Location --}}
                    <div class="mt-4">
                        <x-input-label for="location" :value="__('Location')" />
                        <x-text-input id="location" class="block mt-1 w-full" type="text" name="location" value="{{ old('location', $packageTour->location) }}" required />
                        <x-input-error :messages="$errors->get('location')" class="mt-2" />
                    </div>

                    {{-- Price --}}
                    <div class="mt-4">
                        <x-input-label for="price" :value="__('Price')" />
                        <x-text-input id="price" class="block mt-1 w-full" type="number" name="price" value="{{ old('price', $packageTour->price) }}" required />
                        <x-input-error :messages="$errors->get('price')" class="mt-2" />
                    </div>

                    {{-- Days --}}
                    <div class="mt-4">
                        <x-input-label for="day" :value="__('Days')" />
                        <x-text-input id="day" class="block mt-1 w-full" type="number" name="day" value="{{ old('day', $packageTour->day) }}" required />
                        <x-input-error :messages="$errors->get('day')" class="mt-2" />
                    </div>

                    <hr class="my-5">

                   {{-- Existing Photos with Upload Inputs --}}
<div class="mt-6">
    <x-input-label :value="__('Existing Photos - Replace if needed')" />
    @forelse ($latestPhotos as $photo)
        <div class="mt-4">
            <img src="{{ Storage::url($photo->photo) }}" alt="Photo" class="rounded-2xl object-cover w-[120px] h-[90px] mb-2">
            <x-text-input class="block w-full" type="file" name="package_photos[]" />
        </div>
    @empty
        <p class="text-gray-500">Belum ada foto terbaru.</p>
    @endforelse
</div>

{{-- Upload Additional New Photos --}}
<div class="mt-6">
    <x-input-label :value="__('Add New Photos (Optional)')" />
    @for ($i = 0; $i < max(0, 3 - count($latestPhotos)); $i++)
        <x-text-input class="block mt-2 w-full" type="file" name="package_photos[]" />
    @endfor
    <x-input-error :messages="$errors->get('package_photos.*')" class="mt-2" />
</div>


                    {{-- Submit --}}
                    <div class="mt-6">
                        <button type="submit" class="font-bold py-4 px-6 bg-indigo-700 text-white rounded-full">
                            Update Tour
                        </button>
                    </div>

                </form>
            </div>
        </div>
    </div>
</x-app-layout>
