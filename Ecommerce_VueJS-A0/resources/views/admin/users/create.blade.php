
<form id="createUserForm" enctype="multipart/form-data">
    @csrf
    <div class="form-group">
        <label for="name">Name</label>
        <input type="text" name="name" id="name" class="form-control" required>
    </div>
    <div class="form-group">
        <label for="email">Email</label>
        <!-- Use input type="email" for email addresses -->
        <input type="email" name="email" id="email" class="form-control" required>
    </div>
    <div class="form-group">
        <label for="role">Role</label>
        <!-- Assuming role is a text field; adjust if needed -->
        <input type="text" name="role" id="role" class="form-control" required>
    </div>
    <button type="submit" class="btn btn-primary">Save</button>
</form>
