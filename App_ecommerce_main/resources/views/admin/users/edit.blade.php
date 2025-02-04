<form id="editUserForm" enctype="multipart/form-data">
    @csrf
    <!-- Hidden field to hold the user's ID -->
    <input type="hidden" name="id" value="{{ $user->id }}">
    
    <div class="form-group">
        <label for="name">Name</label>
        <input type="text" name="name" id="name" class="form-control" value="{{ $user->name }}" required>
    </div>
    <div class="form-group">
        <label for="email">Email</label>
        <input type="email" name="email" id="email" class="form-control" value="{{ $user->email }}" required>
    </div> 
    <div class="form-group">
        <label for="role">Role</label>
        <input type="text" name="role" id="role" class="form-control" value="{{ $user->role }}" required>
    </div>
    <button type="submit" class="btn btn-primary">Update</button>
</form>
