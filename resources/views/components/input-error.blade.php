@props(['name'])
<div class="form-group mb-2">
    {{ $slot }}
    @error($name)
        <div class="form-text text-danger">{{ $message }}</div>
    @enderror
</div>