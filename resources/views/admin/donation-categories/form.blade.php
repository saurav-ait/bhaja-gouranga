
<div style="margin-bottom:18px;">
    <label>Category Name *</label>
    <input type="text"
           name="name"
           value="{{ old('name', $category->name ?? '') }}"
           required
           style="width:100%;padding:10px;margin-top:6px;">
    @error('name')
        <small style="color:red;">{{ $message }}</small>
    @enderror
</div>

<div style="margin-bottom:18px;">
    <label>Description</label>
    <textarea name="description"
              rows="3"
              style="width:100%;padding:10px;margin-top:6px;">{{ old('description', $category->description ?? '') }}</textarea>
</div>

<div style="margin-bottom:20px;">
    <label>Status *</label>
    <select name="is_active"
            required
            style="width:100%;padding:10px;margin-top:6px;">
        <option value="1" {{ (string) old('is_active', isset($category) ? (int) $category->is_active : 1) === '1' ? 'selected' : '' }}>
            Active
        </option>
        <option value="0" {{ (string) old('is_active', isset($category) ? (int) $category->is_active : 1) === '0' ? 'selected' : '' }}>
            Inactive
        </option>
    </select>
</div>
