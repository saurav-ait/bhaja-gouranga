
<div style="display:grid;grid-template-columns:repeat(auto-fit,minmax(230px,1fr));gap:18px;margin-bottom:22px;">

    <div style="margin-bottom:22px;">

        <label>Member Photo</label>

        @if(isset($member) && $member->photo_path)
            <div style="margin:12px 0;">
                <img src="{{ asset('storage/'.$member->photo_path) }}"
                    alt="Member Photo"
                    style="width:120px;height:120px;object-fit:cover;border-radius:10px;border:1px solid #ddd;">
            </div>
        @endif

        <input type="file"
            name="photo"
            accept="image/jpeg,image/png,image/webp"
            style="display:block;width:100%;padding:12px;border:1px solid #ddd;border-radius:7px;margin-top:7px;">

        <small style="color:#777;">
            Allowed formats: JPG, JPEG, PNG, WEBP. Maximum size: 2 MB.
        </small>

    </div>
    
    <div>
        <label>Member Code *</label>
        <input type="text" name="member_code"
               value="{{ old('member_code', $member->member_code ?? '') }}"
               required placeholder="Example: BGS-001"
               style="width:100%;padding:12px;border:1px solid #ddd;border-radius:7px;margin-top:7px;">
    </div>

    <div>
        <label>Full Name *</label>
        <input type="text" name="full_name"
               value="{{ old('full_name', $member->full_name ?? '') }}"
               required
               style="width:100%;padding:12px;border:1px solid #ddd;border-radius:7px;margin-top:7px;">
    </div>

    <div>
        <label>Phone *</label>
        <input type="text" name="phone"
               value="{{ old('phone', $member->phone ?? '') }}"
               required placeholder="01XXXXXXXXX"
               style="width:100%;padding:12px;border:1px solid #ddd;border-radius:7px;margin-top:7px;">
    </div>

    <div>
        <label>Email</label>
        <input type="email" name="email"
               value="{{ old('email', $member->email ?? '') }}"
               style="width:100%;padding:12px;border:1px solid #ddd;border-radius:7px;margin-top:7px;">
    </div>

    <div>
        <label>Joining Date</label>
        <input type="date" name="joining_date"
               value="{{ old('joining_date', isset($member) ? $member->joining_date?->format('Y-m-d') : '') }}"
               style="width:100%;padding:12px;border:1px solid #ddd;border-radius:7px;margin-top:7px;">
    </div>

    <div>
        <label>Status *</label>
        <select name="status" required
                style="width:100%;padding:12px;border:1px solid #ddd;border-radius:7px;margin-top:7px;">
            <option value="active" @selected(old('status', $member->status ?? 'active') === 'active')>Active</option>
            <option value="inactive" @selected(old('status', $member->status ?? 'active') === 'inactive')>Inactive</option>
        </select>
    </div>

</div>

<div style="margin-bottom:22px;">
    <label>Address</label>
    <textarea name="address" rows="3"
              style="width:100%;padding:12px;border:1px solid #ddd;border-radius:7px;margin-top:7px;">{{ old('address', $member->address ?? '') }}</textarea>
</div>

<div style="margin-bottom:22px;">
    <label>Notes</label>
    <textarea name="notes" rows="3"
              style="width:100%;padding:12px;border:1px solid #ddd;border-radius:7px;margin-top:7px;">{{ old('notes', $member->notes ?? '') }}</textarea>
</div>
