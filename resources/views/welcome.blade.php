@extends('adminlte::page')

@section('title', 'Student Management')

@section('content_header')
    <h1>Student Management</h1>
@stop

@section('content')
    <div class="container">
        <button class="btn btn-primary" data-toggle="modal" data-target="#studentModal">Add Student</button>
        <table id="studentsTable" class="table table-bordered">
            <thead>
                <tr>
                    <th>ID</th>
                    <th>Name</th>
                    <th>Class</th>
                    <th>status</th>
                </tr>
            </thead>
        </table>
    </div>

    <!-- Modal -->
    <div class="modal fade" id="studentModal" tabindex="-1" aria-labelledby="studentModalLabel" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="studentModalLabel">Add Student</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    <form id="studentForm">
                        @csrf
                        <div class="form-group">
                            <label for="name">Name</label>
                            <input type="text" class="form-control" id="name" name="name">
                        </div>
                        <div class="form-group">
                            <label for="email">Class</label>
                            <input type="class" class="form-control" id="class" name="class">
                        </div>
                    </form>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                    <button type="button" class="btn btn-primary" id="saveStudent">Save changes</button>
                </div>
            </div>
        </div>
    </div>
@stop

@section('js')
    <script>
        $(document).ready(function() {
            var table = $('#studentsTable').DataTable({
                ajax: '/students/data',
                columns: [
                    { data: 'id' },
                    { data: 'name' },
                    { data: 'class' },
                    { data: 'status' },
                    {
                        data: 'id',
                        render: function(data) {
                            return `<button class="btn btn-danger delete-student" data-id="${data}">Delete</button>`;
                        }
                    }
                ]
            });

            $('#saveStudent').click(function() {
                $.ajax({
                    url: '/students',
                    method: 'POST',
                    data: $('#studentForm').serialize(),
                    success: function(response) {
                        $('#studentModal').modal('hide');
                        $('#studentForm')[0].reset();
                        table.ajax.reload();
                    }
                });
            });

            $('#studentsTable').on('click', '.delete-student', function() {
                var id = $(this).data('id');
                if (confirm('Are you sure?')) {
                    $.ajax({
                        url: '/students/' + id,
                        method: 'DELETE',
                        data: { _token: '{{ csrf_token() }}' },
                        success: function(response) {
                            table.ajax.reload();
                        }
                    });
                }
            });
        });
    </script>
@stop
