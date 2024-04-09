@extends('students/layout/master')

@section('title_in_header')
    AJAX - Students
@endsection

@section('content')
    <div class="container-xl">
        <div class="table-responsive">
            <div class="table-wrapper">
                <div class="table-title">
                    <div class="row">
                        <div class="col-sm-6">
                            <h2><b> Manage Students</b></h2>
                        </div>
                        <div class="col-sm-6">

                            <a  class="btn btn-danger" onclick="event.preventDefault(); document.getElementById('logout-form').submit();"><i
                                class="material-icons">&#xe9ba;</i> <span>logout</span></a>

                                <form id="logout-form" action="{{ route('logout') }}" method="GET" style="display: none;">
                                    @csrf
                                </form>

                            <a onclick="postData()" href="#model" class="btn btn-success" data-toggle="modal"><i
                                    class="material-icons">&#xE147;</i> <span>Add New Studnet</span></a>
                        </div>

                    </div>
                </div>
                <table class="table table-striped table-hover">
                    <thead>
                        <tr>
                            <th>#</th>
                            <th>Name</th>
                            <th>Email</th>
                            <th>City</th>
                            <th>Phone</th>
                            <th>Actions</th>
                        </tr>
                    </thead>
                    <tbody id="student-table-body">
                        <!-- Student records will be inserted here -->
                    </tbody>
                </table>


                {{-- <div class="clearfix">
                    <div class="hint-text">Showing <b>5</b> out of <b>25</b> entries</div>
                    <ul class="pagination">
                        <li class="page-item disabled"><a href="#">Previous</a></li>
                        <li class="page-item"><a href="#" class="page-link">1</a></li>
                        <li class="page-item"><a href="#" class="page-link">2</a></li>
                        <li class="page-item active"><a href="#" class="page-link">3</a></li>
                        <li class="page-item"><a href="#" class="page-link">4</a></li>
                        <li class="page-item"><a href="#" class="page-link">5</a></li>
                        <li class="page-item"><a href="#" class="page-link">Next</a></li>
                    </ul>
                </div> --}}

            </div>
        </div>
    </div>



    <!-- Add Modal HTML -->
    <div id="model" class="modal fade">
        <div class="modal-dialog">
            <div class="modal-content">
                <form id="model-form">
                    <div class="modal-header">
                        <h4 class="modal-title" id="model-title">
                            <!-- Dynamic title for add/edit -->
                        </h4>
                        <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
                    </div>
                    <div class="modal-body">
                        <div class="form-group">
                            <label for="name">Name</label>
                            <input type="text" class="form-control" required name="name" id="name">
                            <!-- Error container for name -->
                            <div class="text-danger" id="name-error"></div>
                        </div>
                        <div class="form-group">
                            <label for="email">Email</label>
                            <input type="email" class="form-control" required name="email" id="email">
                            <!-- Error container for email -->
                            <div class="text-danger" id="email-error"></div>
                        </div>
                        <div class="form-group">
                            <label for="city">City</label>
                            <input type="text" class="form-control" required name="city" id="city">
                            <!-- Error container for city -->
                            <div class="text-danger" id="city-error"></div>
                        </div>
                        <div class="form-group">
                            <label for="phone">Phone</label>
                            <input type="text" class="form-control" required name="phone" id="phone">
                            <!-- Error container for phone -->
                            <div class="text-danger" id="phone-error"></div>
                        </div>
                        <!-- Hidden field for student ID -->
                        <input type="hidden" name="student_id" id="student_id">
                    </div>
                    <div class="modal-footer">
                        <input type="button" class="btn btn-default" data-dismiss="modal" value="Cancel">
                        <input type="submit" class="btn btn-success" id="footer-btn" value="">
                    </div>
                </form>
            </div>
        </div>
    </div>




    <!-- Edit Modal HTML -->
    <div id="editEmployeeModal" class="modal fade">
        <div class="modal-dialog">
            <div class="modal-content">
                <form>
                    <div class="modal-header">
                        <h4 class="modal-title">Edit Employee</h4>
                        <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
                    </div>
                    <div class="modal-body">
                        <div class="form-group">
                            <label>Name</label>
                            <input type="text" class="form-control" required>
                        </div>
                        <div class="form-group">
                            <label>Email</label>
                            <input type="email" class="form-control" required>
                        </div>
                        <div class="form-group">
                            <label>Address</label>
                            <textarea class="form-control" required></textarea>
                        </div>
                        <div class="form-group">
                            <label>Phone</label>
                            <input type="text" class="form-control" required>
                        </div>
                    </div>
                    <div class="modal-footer">
                        <input type="button" class="btn btn-default" data-dismiss="modal" value="Cancel">
                        <input type="submit" class="btn btn-info" value="Save">
                    </div>
                </form>
            </div>
        </div>
    </div>
    <!-- Delete Modal HTML -->
    <div id="delete-model" class="modal fade">
        <div class="modal-dialog">
            <div class="modal-content">
                <form id="deleteStudentForm">
                    <input type="hidden" name="student_id" id="deleteStudentId">

                    <div class="modal-header">
                        <h4 class="modal-title">Delete Record</h4>
                        <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
                    </div>
                    <div class="modal-body">
                        <input type="hidden" name="student_id" id="deleteStudentId">
                        <!-- Hidden input to store student ID -->
                        <p>Are you sure you want to delete this record?</p>
                        <p class="text-warning"><small>This action cannot be undone.</small></p>
                    </div>
                    <div class="modal-footer">
                        <input type="button" class="btn btn-default" data-dismiss="modal" value="Cancel">
                        <input type="button" class="btn btn-danger" id="confirmDelete" value="Delete"
                            onclick="deleteStudentRecord()">
                    </div>
                </form>
            </div>
        </div>
    </div>


    <!-- Your existing JavaScript code -->
    <script>
        $.ajaxSetup({
            headers: {
                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
            }
        });

        function postData() {
            // Dynamically change the modal title and button label
            $('#model-title').html('Add Student Record');
            $('#footer-btn').val('Add');

            // Clear the form fields
            $('#model-form')[0].reset();

            // Handle form submission via AJAX
            $('#model-form').off('submit').on('submit', function(event) {
                event.preventDefault(); // Prevent the default form submission

                // Get form data
                var formData = {
                    name: $('#name').val(),
                    email: $('#email').val(),
                    city: $('#city').val(),
                    phone: $('#phone').val()
                };

                var studentId = $('#student_id').val(); // Get the student ID if it exists

                var url = '{{ route('students.store') }}';


                // Send an AJAX request to the server
                $.ajax({
                    type: 'POST',
                    url: url,
                    data: formData,
                    dataType: 'json',
                    success: function(response) {
                        // Handle the success response, e.g., show a success message
                        $('#model').modal('hide');
                        loadStudentData();
                        Swal.fire({
                            position: 'bottom-end',
                            icon: 'success',
                            title: 'Student record added successfully',
                            showConfirmButton: false,
                            timer: 1500
                        });
                        // Clear the form fields
                        $('#model-form')[0].reset();
                    },
                    error: function(response) {
                        // Handle the error response, e.g., display validation errors
                        if (response.status === 422) {
                            var errors = response.responseJSON.errors;
                            $.each(errors, function(field, messages) {
                                // Append each error message to the corresponding error container
                                $('#' + field + '-error').html(messages[0]);
                            });
                        } else {
                            alert('Error: ' + response.responseText);
                        }
                    }
                });
            });
        }

        // Function to open the edit form with student data
        function editStudentRecord(studentId) {
            // Dynamically change the modal title and button label
            $('#model-title').html('Edit Student Record');
            $('#footer-btn').val('Save Changes');

            // Fetch student data by ID using a GET request
            $.ajax({
                type: 'GET', // Use GET method
                url: 'students/edit/' + studentId, // Replace with your route
                success: function(response) {
                    // Populate the form fields with student data
                    $('#student_id').val(response.student.id);
                    $('#name').val(response.student.name);
                    $('#email').val(response.student.email);
                    $('#city').val(response.student.city);
                    $('#phone').val(response.student.phone);

                    // Show the modal
                    $('#model').modal('show');
                },
                error: function(error) {
                    // Handle error, show an error message or log it
                    alert('Error fetching student data: ' + error.responseText);
                    console.log('Error fetching student data: ' + error.responseText);
                }
            });

            $('#model-form').off('submit').on('submit', function(event) {
                event.preventDefault(); // Prevent the default form submission
                updateStudentRecord();
            });
        }


        // Function to submit the edited student data
        function updateStudentRecord() {
            // Get the form data
            var formData = {
                id: $('#student_id').val(),
                name: $('#name').val(),
                email: $('#email').val(),
                city: $('#city').val(),
                phone: $('#phone').val()
            };

            // Send an AJAX POST request to update the student data
            $.ajax({
                type: 'PUT', // Use PUT method for updating
                url: 'students/update/' + formData.id, // Replace with your update route
                data: formData,
                dataType: 'json',
                success: function(response) {
                    // Handle the success response, e.g., show a success message
                    $('#model').modal('hide');
                    loadStudentData(); // Reload the student data
                    Swal.fire({
                        position: 'bottom-end',
                        icon: 'success',
                        title: 'Student record updated successfully',
                        showConfirmButton: false,
                        timer: 1500
                    });
                    // Clear the form fields
                    $('#model-form')[0].reset();
                },
                error: function(error) {
                    // Handle the error response, e.g., display validation errors
                    if (error.status === 422) {
                        var errors = error.responseJSON.errors;
                        $.each(errors, function(field, messages) {
                            // Append each error message to the corresponding error container
                            $('#' + field + '-error').html(messages[0]);
                        });
                    } else {
                        alert('Error: ' + error.responseText);
                    }
                }
            });
        }








        // Function to load student data
        function loadStudentData() {
            // alert('sda');
            $.ajax({
                type: 'GET',
                url: '{{ route('students.getData') }}',
                // dataType: 'json',
                success: function(response) {
                    // alert('success');

                    // Clear the table body
                    $('#student-table-body').empty();

                    var students = response.students; // Access the 'students' property

                    // Accumulate the rows
                    var rows = '';

                    // Loop through the student data and append rows to the table
                    $.each(students, function(index, student) {
                        var row = '<tr>' +
                            '<td>' + (index + 1) + '</td>' +
                            '<td>' + student.name + '</td>' +
                            '<td>' + student.email + '</td>' +
                            '<td>' + student.city + '</td>' +
                            '<td>' + student.phone + '</td>' +
                            '<td>' +
                            '<a href="#model" class="edit" data-toggle="modal" data-student-id="' +
                            student.id + '"  onclick="editStudentRecord(' + student.id +
                            ')"><i class="material-icons" data-toggle="tooltip" title="Edit">&#xE254;</i></a>' +
                            '<a href="#delete-model" class="delete" data-toggle="modal" data-student-id="' +
                            student.id + '" onclick="setDeleteStudentId(' + student.id +
                            ')"><i class="material-icons" data-toggle="tooltip" title="Delete">&#xE872;</i></a>' +
                            '</td>' +
                            '</tr>';
                        rows += row;
                    });

                    // Append all rows to the table at once
                    $('#student-table-body').html(rows);
                },

                error: function(error) {
                    alert('error from loadingdata funciton');
                    alert('Error: ' + error.responseText);
                    console.log(error.responseText);
                }
            });
        }


        // Call the loadStudentData function to load data when the page loads
        loadStudentData();

        // Function to delete the student record


        function setDeleteStudentId(studentId) {
            $('#deleteStudentId').val(studentId); // Set the value of the hidden input field
        }

        function deleteStudentRecord() {
            // Function to handle the "Delete" button click

            // Get the student ID to be deleted
            var studentId = $('#deleteStudentId').val();
            alert(studentId);
            // console.log(studentId);


            // Perform an AJAX request to delete the student's data
            $.ajax({
                type: 'DELETE',

                url: 'http://127.0.0.1:8000/students/delete/' + studentId, //delete route
                success: function(response) {
                    // Handle success, for example, you can close the modal
                    // alert('')
                    $('#delete-model').modal('hide');
                    //  update the student list here
                    loadStudentData();
                    $('#model').modal('hide');
                    Swal.fire({
                        position: 'bottom-end',
                        icon: 'success',
                        title: 'Student record Deleted successfully',
                        showConfirmButton: false,
                        timer: 1500
                    });
                },
                error: function(error) {
                    // Handle error, show an error message or log it
                    alert('Error deleting student: ' + error.responseText);
                }
            });
        }
    </script>
@endsection
