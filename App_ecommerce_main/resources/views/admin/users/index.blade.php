@extends('layouts.app')

@section('title', 'Users')

@section('content')
<div class="container">
    <h1 class="mb-4">User List</h1>

    <!-- Button to load the Create form -->
    <a href="javascript:void(0)" id="createUserBtn" class="btn btn-primary mb-3">Add New User</a>

    <!-- Users Table -->
    <table class="table table-bordered table-striped" id="userTable">
        <thead>
            <tr>
                <th>ID</th>
                <th>Name</th>
                <th>Email</th>
                <th>Role</th>
                <th>Actions</th>
            </tr>
        </thead>
        <tbody>
            @forelse($users as $user)
                <tr id="user-{{ $user->id }}">
                    <td>{{ $user->id }}</td>
                    <td>{{ $user->name }}</td>
                    <td>{{ $user->email }}</td>
                    <td>{{ $user->role }}</td>
                    <td>
                        <a href="javascript:void(0)" class="btn btn-info btn-sm showUserBtn" data-id="{{ $user->id }}">View</a>
                        <a href="javascript:void(0)" class="btn btn-warning btn-sm editUserBtn" data-id="{{ $user->id }}">Edit</a>
                        <form action="{{ route('admin.users.destroy', $user->id) }}" method="POST" class="d-inline" id="deleteForm-{{ $user->id }}">
                            @csrf
                            @method('DELETE')
                            <button class="btn btn-danger btn-sm delete-btn" data-id="{{ $user->id }}">Delete</button>
                        </form>
                    </td>
                </tr>
            @empty
                <tr>
                    <td colspan="5" class="text-center">No users available</td>
                </tr>
            @endforelse
        </tbody>
    </table>

    <!-- Pagination -->
    <div class="d-flex justify-content-center mt-4">
        {{ $paginate->links('pagination::bootstrap-4') }}
    </div>
</div>

<!-- Bootstrap Modal -->
<div class="modal fade" id="userModal" tabindex="-1" role="dialog" aria-labelledby="userModalName" aria-hidden="true">
    <div class="modal-dialog modal-lg" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="userModalName"></h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body" id="userModalBody">
                <!-- Content loaded dynamically will appear here -->
            </div>
        </div>
    </div>
</div>

<!-- Include jQuery and Bootstrap JS if not already included -->
<script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
<script src="https://stackpath.bootstrapcdn.com/bootstrap/4.6.0/js/bootstrap.bundle.min.js"></script>

<script>
$(document).ready(function() {

    // Helper function to load content into the modal and show it
    function showModal(title, htmlContent) {
        $('#userModalName').text(title);
        $('#userModalBody').html(htmlContent);
        $('#userModal').modal('show');
    }

    // 1. Load the Create User form into the modal when "Add New User" is clicked
    $('#createUserBtn').on('click', function() {
        $.ajax({
            url: "{{ route('admin.users.create') }}",
            method: 'GET',
            success: function(html) {
                showModal('Add New User', html);
            },
            error: function() {
                alert('Error loading create form.');
            }
        });
    });

    // 2. Handle Create User form submission via AJAX
    $(document).on('submit', '#createUserForm', function(e) {
        e.preventDefault();
        var formData = new FormData(this);
        $.ajax({
            url: "{{ route('admin.users.store') }}",
            method: 'POST',
            data: formData,
            processData: false,
            contentType: false,
            success: function(response) {
                alert(response.message);
                var user = response.user;
                var newRow = '<tr id="user-' + user.id + '">' +
                    '<td>' + user.id + '</td>' +
                    '<td>' + user.name + '</td>' +
                    '<td>' + user.email + '</td>' +
                    '<td>' + user.role + '</td>' +
                    '<td>' +
                        '<a href="javascript:void(0)" class="btn btn-info btn-sm showUserBtn" data-id="' + user.id + '">View</a> ' +
                        '<a href="javascript:void(0)" class="btn btn-warning btn-sm editUserBtn" data-id="' + user.id + '">Edit</a> ' +
                        '<form action="/admin/users/' + user.id + '" method="POST" class="d-inline" id="deleteForm-' + user.id + '">' +
                            '@csrf' +
                            '@method("DELETE")' +
                            '<button class="btn btn-danger btn-sm delete-btn" data-id="' + user.id + '">Delete</button>' +
                        '</form>' +
                    '</td>' +
                '</tr>';
                $('#userTable tbody').append(newRow);
                $('#userModal').modal('hide');
            },
            error: function() {
                alert('Error saving user.');
            }
        });
    });

    // 3. Load the Edit User form into the modal when "Edit" is clicked
    $(document).on('click', '.editUserBtn', function() {
        var userId = $(this).data('id');
        $.ajax({
            url: "/admin/users/" + userId + "/edit",
            method: "GET",
            success: function(html) {
                showModal('Edit User', html);
            },
            error: function() {
                alert('Error loading edit form.');
            }
        });
    });

    // 4. Handle Edit User form submission via AJAX
    $(document).on('submit', '#editUserForm', function(e) {
        e.preventDefault();
        var userId = $(this).find('input[name="id"]').val();
        var formData = new FormData(this);
        if (!formData.has('_method')) {
            formData.append('_method', 'PUT');
        }
        $.ajax({
            url: "/admin/users/" + userId,
            method: 'POST',
            data: formData,
            processData: false,
            contentType: false,
            success: function(response) {
                alert(response.message);
                var user = response.user;
                var updatedRow = '<td>' + user.id + '</td>' +
                    '<td>' + user.name + '</td>' +
                    '<td>' + user.email + '</td>' +
                    '<td>' + user.role + '</td>' +
                    '<td>' +
                        '<a href="javascript:void(0)" class="btn btn-info btn-sm showUserBtn" data-id="' + user.id + '">View</a> ' +
                        '<a href="javascript:void(0)" class="btn btn-warning btn-sm editUserBtn" data-id="' + user.id + '">Edit</a> ' +
                        '<form action="/admin/users/' + user.id + '" method="POST" class="d-inline" id="deleteForm-' + user.id + '">' +
                            '@csrf' +
                            '@method("DELETE")' +
                            '<button class="btn btn-danger btn-sm delete-btn" data-id="' + user.id + '">Delete</button>' +
                        '</form>' +
                    '</td>';
                $('#user-' + user.id).html(updatedRow);
                $('#userModal').modal('hide');
            },
            error: function() {
                alert('Error updating user.');
            }
        });
    });

    // 5. Handle Delete User action via AJAX
    $(document).on('click', '.delete-btn', function(e) {
        e.preventDefault();
        var userId = $(this).data('id');
        var form = $('#deleteForm-' + userId);
        if (confirm("Are you sure you want to delete this user?")) {
            $.ajax({
                url: form.attr('action'),
                method: 'POST',
                data: new FormData(form[0]),
                processData: false,
                contentType: false,
                success: function(response) {
                    alert(response.message);
                    $('#user-' + userId).remove();
                },
                error: function() {
                    alert('Error deleting user.');
                }
            });
        }
    });

    // 6. Load the Show User details into the modal when "View" is clicked
    $(document).on('click', '.showUserBtn', function() {
        var userId = $(this).data('id');
        $.ajax({
            url: "/admin/users/" + userId,
            method: "GET",
            success: function(html) {
                showModal('User Details', html);
            },
            error: function() {
                alert('Error loading user details.');
            }
        });
    });
});
</script>
@endsection
