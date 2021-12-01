<!doctype html>
<html lang="en">
  <head>
    <!-- Required meta tags -->
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <!-- Bootstrap CSS -->
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.1/dist/css/bootstrap.min.css" integrity="sha384-F3w7mX95PdgyTmZZMECAngseQB83DfGTowi0iMjiWaeVhAn4FJkqJByhZMI3AhiU" crossorigin="anonymous">
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.1/dist/js/bootstrap.min.js" integrity="sha384-skAcpIdS7UcVUC05LJ9Dxay8AXcDYfBJqt1CJ85S/CFujBsIzCIv+l9liuYLaMQ/" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.1/dist/js/bootstrap.bundle.min.js" integrity="sha384-/bQdsTh/da6pkI1MST/rWKFNjaCP5gBSY4sEBT38Q/9RBh9AH40zEOg7Hlq2THRZ" crossorigin="anonymous"></script>
    <script src="https://code.jquery.com/jquery-3.6.0.min.js" integrity="sha256-/xUj+3OJU5yExlq6GSYGSHk7tPXikynS7ogEvDej/m4=" crossorigin="anonymous"></script>
    <title>Hello, world!</title>
  </head>
  <body>
    <section style="padding-top: 60px">
        <div class="container">
            <div class="row">
                <div class="col-md-12">
                    <div class="card">
                        <div class="card-header" style="display: flex; justify-content: space-between">
                            Students <button type="button" class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#studentModal">
                                Add a new student
                              </button>
                        </div>
                        <div class="card-body">
                            <table id="studentTable" class="table">
                                <thead>
                                    <tr>
                                        <th>First name</th>
                                        <th>Last name</th>
                                        <th>Email</th>
                                        <th>Phone</th>
                                        <th>Action</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach ($students as $student)
                                        <tr id="sid{{ $student->id }}">
                                            <td>{{ $student->firstname }}</td>
                                            <td>{{ $student->lastname }}</td>
                                            <td>{{ $student->email }}</td>
                                            <td>{{ $student->phone }}</td>
                                            <td>
                                                <a href="javascript:void(0)" onclick="editStudents({{ $student->id }})" class="btn btn-info">Edit</a>
                                                <a href="javascript:void(0)" onclick="deleteStudent({{ $student->id }})" class="btn btn-danger">Delete</a>
                                            </td>
                                        </tr>
                                    @endforeach
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>

  <!-- Add Student Modal -->
  <div class="modal fade" id="studentModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog" role="document">
      <div class="modal-content">
        <div class="modal-header">
          <h5 class="modal-title" id="exampleModalLabel">Add a new student</h5>
          <button type="button" class="close" data-bs-dismiss="modal" aria-label="Close">
            <span aria-hidden="true">&times;</span>
          </button>
        </div>
        <div class="modal-body">
          <form id="studentForm" action="">
              @csrf
              <div class="form-group">
                  <label for="firstname">First Name</label>
                  <input type="text" class="form-control" id="firstname">
              </div>
              <div class="form-group">
                  <label for="lastname">Last Name</label>
                  <input type="text" class="form-control" id="lastname">
              </div>
              <div class="form-group">
                  <label for="email">Email</label>
                  <input type="text" class="form-control" id="email">
              </div>
              <div class="form-group">
                  <label for="phone">Phone</label>
                  <input type="text" class="form-control" id="phone">
              </div><br>
              <button type="submit" class="btn btn-primary" data-bs-dismiss="modal">Submit</button>
          </form>
        </div>
      </div>
    </div>
  </div>

<!-- Edit Student Modal -->
<div class="modal fade" id="studentEditModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog" role="document">
      <div class="modal-content">
        <div class="modal-header">
          <h5 class="modal-title" id="exampleModalLabel">Add a new student</h5>
          <button type="button" class="close" data-bs-dismiss="modal" aria-label="Close">
            <span aria-hidden="true">&times;</span>
          </button>
        </div>
        <div class="modal-body">
          <form id="studentEditForm" action="">
              @csrf
              <input type="hidden" id="id" name="id">
              <div class="form-group">
                  <label for="firstname">First Name</label>
                  <input type="text" class="form-control" id="firstname2">
              </div>
              <div class="form-group">
                  <label for="lastname">Last Name</label>
                  <input type="text" class="form-control" id="lastname2">
              </div>
              <div class="form-group">
                  <label for="email">Email</label>
                  <input type="text" class="form-control" id="email2">
              </div>
              <div class="form-group">
                  <label for="phone">Phone</label>
                  <input type="text" class="form-control" id="phone2">
              </div><br>
              <button type="submit" class="btn btn-primary" data-bs-dismiss="modal">Submit</button>
          </form>
        </div>
      </div>
    </div>
  </div>

  <script>
      $("#studentForm").submit(function(e) {
        e.preventDefault()

        let firstname = $("#firstname").val()
        let lastname = $("#lastname").val()
        let email = $("#email").val()
        let phone = $("#phone").val()
        let _token = $("input[name=_token]").val()

        $.ajax({
            url: "{{route('student.add')}}",
            type: "POST"
        ,
        data:
        {
            firstname:firstname,
            lastname:lastname,
            email:email,
            phone:phone,
            _token:_token
        },
        success:function(response)
        {
            if(response)
            {
                $("#studentTable tbody").prepend('<tr><td>'+ response.firstname +'</td> <td>'+ response.lastname +'</td> <td>'+ response.email +'</td> <td> '+ response.phone +'</td> </tr>')
                $("#studentForm")[0].reset()
                // $("#studentModal").modal('toggle')
            }
        }
      })
      })
  </script>

  <script>
      function editStudents(id)
      {
        $.get('/student/' + id, function (student) {
            $('#id').val(student.id)
            $('#firstname2').val(student.firstname)
            $('#lastname2').val(student.lastname)
            $('#email2').val(student.email)
            $('#phone2').val(student.phone)
            $('#studentEditModal').modal('toggle')
        })
      }

      $('#studentEditForm').submit(function (e) {
        e.preventDefault()
        let id = $("#id").val()
        let firstname = $("#firstname2").val()
        let lastname = $("#lastname2").val()
        let email = $("#email2").val()
        let phone = $("#phone2").val()
        let _token = $("input[name=_token]").val()

        $.ajax({
            url: '{{ route('student.update') }}',
            type: 'PUT',
            data: {
                id:id,
                firstname:firstname,
                lastname:lastname,
                email:email,
                phone:phone,
                _token:_token
            },
            success:function(response){
                $('#sid' + response.id + ' td:nth-child(1)').text(response.firstname)
                $('#sid' + response.id + ' td:nth-child(2)').text(response.lastname)
                $('#sid' + response.id + ' td:nth-child(3)').text(response.email)
                $('#sid' + response.id + ' td:nth-child(4)').text(response.phone)
                $('#studentEditModal').modal('hide')
                $('#studentEditForm')[0].reset()
            }
        })
      })
  </script>

  <script>
      function deleteStudent(id)
      {
        if(confirm("Do you realy want to delete this record?")){
            $.ajax({
                url: '/destroy-student/' + id,
                type: 'DELETE',
                data:{
                    _token: $('input[name=_token').val()
                },
                success:function(response)
                {
                    $('#sid'+id).remove()
                }
            })
        }
      }
  </script>
  </body>
</html>
